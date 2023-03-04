<?php

namespace App\Repositories;

use Exception;
use Carbon\Carbon;
use App\Models\Tax;
use App\Models\User;
use App\Models\Quote;
use App\Models\Client;
use App\Models\Product;
use App\Models\Setting;
use App\Models\QuoteItem;
use Illuminate\Support\Arr;
use App\Models\Notification;
use App\Models\QuoteItemTax;
use App\Models\InvoiceSetting;
use Illuminate\Support\Facades\DB;
use App\Mail\QuoteCreateClientMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class QuoteRepository
 */
class QuoteRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    public $fieldSearchable = [];

    /**
     * @return array|string[]
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * @return string
     */
    public function model(): string
    {
        return Quote::class;
    }

    /**
     * @return mixed
     */
    public function getProductNameList()
    {
        /** @var Product $product */
        static $product;

        if (!isset($product) && empty($product)) {
            $product = Product::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        }

        return $product;
    }

    /**
     * @param  array  $quote
     * @return QuoteItem
     */
    public function getQuoteItemList($quote = [])
    {
        /** @var QuoteItem $quoteItems */
        static $quoteItems;

        if (!isset($quoteItems) && empty($quoteItems)) {
            $quoteItems = QuoteItem::when($quote, function ($q) use ($quote) {
                $q->whereQuoteId($quote[0]->id);
            })->whereNotNull('product_name')->pluck('product_name', 'product_name')->toArray();
        }

        return $quoteItems;
    }

    /**
     * @return array
     */
    public function getSyncList($quote = [])
    {
        $data['products'] = $this->getProductNameList();
        if (!empty($quote)) {
            $data['productItem'] = $this->getQuoteItemList();
            $data['products'] = $data['products'] + $data['productItem'];
        }
        $data['associateProducts'] = $this->getAssociateProductList($quote);
        $data['clients'] = User::whereHas('client')->get()->pluck('full_name', 'id')->toArray();
        $data['discount_type'] = Quote::DISCOUNT_TYPE;
        $quoteStatusArr = Arr::only(Quote::STATUS_ARR, Quote::DRAFT);
        $quoteRecurringArr = Quote::RECURRING_ARR;
        $data['statusArr'] = $quoteStatusArr;
        $data['recurringArr'] = $quoteRecurringArr;
        $data['template'] = InvoiceSetting::pluck('template_name', 'id');
        $data['taxes'] = $this->getTaxNameList();
        $data['defaultTax'] = getDefaultTax();
        $data['associateTaxes'] = $this->getAssociateTaxList();

        return $data;
    }

    /**
     * @return array
     */
    public function getAssociateTaxList(): array
    {
        $result = $this->getTaxNameList();
        $taxes = [];
        foreach ($result as $item) {
            $taxes[] = [
                'id' => $item->id,
                'name' => $item->name,
                'value' => $item->value,
                'is_default' => $item->is_default,
            ];
        }

        return $taxes;
    }

    /**
     * @return mixed
     */
    public function getTaxNameList()
    {
        /** @var Tax $tax */
        static $tax;

        if (!isset($tax) && empty($tax)) {
            $tax = Tax::all();
        }

        return $tax;
    }

    /**
     * @return array
     */
    public function getAssociateProductList($quote = []): array
    {
        $result = $this->getProductNameList();
        if (!empty($quote)) {
            $quoteItem = $this->getQuoteItemList();
            $result = $result + $quoteItem;
        }
        $products = [];
        foreach ($result as $key => $item) {
            $products[] = [
                'key' => $key,
                'value' => $item,
            ];
        }

        return $products;
    }

    /**
     * @param  array  $input
     * @return Quote
     */
    public function saveQuote(array $input)
    {
        try {
            DB::beginTransaction();
            $input['final_amount'] = $input['amount'];
            $input['tax_id'] = json_decode($input['tax_id']);
            $input['tax'] = json_decode($input['tax']);
            $input['template_id'] = InvoiceSetting::first()?->id;
            if ($input['final_amount'] == 'NaN') {
                $input['final_amount'] = 0;
            }
            $quoteItemInputArray = Arr::only($input, ['product_id', 'quantity', 'price']);
            $quoteItemInput = $this->prepareInputForQuoteItem($quoteItemInputArray);
            $total = [];
            foreach ($quoteItemInput as $key => $value) {
                $total[] = $value['price'] * $value['quantity'];
            }
            if (!empty($input['discount'])) {
                if (array_sum($total) <= $input['discount']) {
                    throw new UnprocessableEntityHttpException('Discount amount should not be greater than sub total.');
                }
            }

            /** @var Quote $quote */
            $input['client_id'] = Client::whereUserId($input['client_id'])->first()->id;
            $input = Arr::only($input, [
                'client_id', 'quote_id', 'quote_date', 'due_date', 'discount_type', 'discount', 'final_amount',
                'note', 'term', 'template_id', 'status', 'tax', 'tax_id'
            ]);


            $lastQuote = Quote::whereNotNull('quote_id')->orderBy('quote_id', 'DESC')->first();
            if (!$lastQuote || !$lastQuote->quote_id) {
                $input['quote_id'] = '0001';
            } else {
                $input['quote_id'] = str_pad(intval($lastQuote->quote_id) + 1, 4, '0', STR_PAD_LEFT);
            }

            $input['quote_date'] = Carbon::today()->toDateString();
            $input['due_date'] = Carbon::today()->toDateString();

            $quote = Quote::create($input);
            $totalAmount = 0;
            foreach ($quoteItemInput as $key => $data) {
                $validator = Validator::make($data, QuoteItem::$rules, QuoteItem::$messages);

                if ($validator->fails()) {
                    throw new UnprocessableEntityHttpException($validator->errors()->first());
                }
                $data['product_name'] = is_numeric($data['product_id']);
                if ($data['product_name'] == true) {
                    $data['product_name'] = null;
                } else {
                    $data['product_name'] = $data['product_id'];
                    $data['product_id'] = null;
                }
                $data['amount'] = $data['price'] * $data['quantity'];

                $data['total'] = $data['amount'];
                $totalAmount += $data['amount'];

                /** @var QuoteItem $quoteItem */
                $quoteItem = new QuoteItem($data);

                $quoteItem = $quote->quoteItems()->save($quoteItem);

                $quoteItemTaxIds = ($input['tax_id'][$key] != 0) ? $input['tax_id'][$key] : $input['tax_id'][$key] = [0 => 0];
                $quoteItemTaxes = ($input['tax'][$key] != 0) ? $input['tax'][$key] : $input['tax'][$key] = [0 => null];
                foreach ($quoteItemTaxes as $index => $tax) {
                    QuoteItemTax::create([
                        'quote_item_id' => $quoteItem->id,
                        'tax_id' => $quoteItemTaxIds[$index],
                        'tax' => $tax,
                    ]);
                }
            }

            $quote->amount = $totalAmount;
            $quote->save();

            DB::commit();
            if (getSettingValue('mail_notification')) {
                $input['quoteData'] = $quote;
                $input['clientData'] = $quote->client->user;
                Mail::to($input['clientData']['email'])->send(new QuoteCreateClientMail($input));
            }

            return $quote;
        } catch (Exception $exception) {
            throw new UnprocessableEntityHttpException($exception->getMessage());
        }
    }

    /**
     * @param $quoteId
     * @param $input
     * @return Quote|Builder|Builder[]|Collection|Model
     */
    public function updateQuote($quoteId, $input)
    {
        try {
            DB::beginTransaction();
            $input['tax_id'] = json_decode($input['tax_id']);
            $input['tax'] = json_decode($input['tax']);

            if (isset($input['discount_type']) && $input['discount_type'] == 0) {
                $input['discount'] = 0;
            }
            $input['final_amount'] = $input['amount'];
            $inputQuoteTaxes = isset($input['taxes']) ? $input['taxes'] : [];
            $quoteItemInputArr = Arr::only($input, ['product_id', 'quantity', 'price', 'tax', 'tax_id', 'id']);
            $quoteItemInput = $this->prepareInputForQuoteItem($quoteItemInputArr);
            $total = [];
            foreach ($quoteItemInput as $key => $value) {
                $total[] = $value['price'] * $value['quantity'];
            }
            if (!empty($input['discount'])) {
                if (array_sum($total) <= $input['discount']) {
                    throw new UnprocessableEntityHttpException('Discount amount should not be greater than sub total.');
                }
            }

            /** @var Quote $quote */
            $input['client_id'] = Client::whereUserId($input['client_id'])->first()->id;
            $quote = $this->update(Arr::only(
                $input,
                [
                    'client_id', 'quote_date', 'due_date', 'discount_type', 'discount', 'final_amount', 'note',
                    'term', 'template_id', 'price',
                    'status',
                ]
            ), $quoteId);
            $quote->quoteTaxes()->detach();
            if (count($inputQuoteTaxes) > 0) {
                $quote->quoteTaxes()->attach($inputQuoteTaxes);
            }

            $totalAmount = 0;

            foreach ($quoteItemInput as $key => $data) {
                $validator = Validator::make($data, QuoteItem::$rules, QuoteItem::$messages);
                if ($validator->fails()) {
                    throw new UnprocessableEntityHttpException($validator->errors()->first());
                }
                $data['product_name'] = is_numeric($data['product_id']);
                if ($data['product_name'] == true) {
                    $data['product_name'] = null;
                } else {
                    $data['product_name'] = $data['product_id'];
                    $data['product_id'] = null;
                }
                $data['amount'] = $data['price'] * $data['quantity'];
                $data['total'] = $data['amount'];
                $totalAmount += $data['amount'];
                $quoteItemInput[$key] = $data;
            }
            /** @var QuoteItemRepository $quoteItemRepo */
            $quoteItemRepo = app(QuoteItemRepository::class);
            $quoteItemRepo->updateQuoteItem($quoteItemInput, $quote->id);
            $quote->amount = $totalAmount;
            $quote->save();
            DB::commit();

            return $quote;
        } catch (Exception $exception) {
            throw new UnprocessableEntityHttpException($exception->getMessage());
        }
    }

    /**
     * @param $quote
     * @return array
     */
    public function getPdfData($quote): array
    {
        $data = [];
        $data['quote'] = $quote;
        $data['client'] = $quote->client;
        $quoteItems = $quote->quoteItems;
        $data['invoice_template_color'] = $quote->invoiceTemplate?->template_color;
        $data['setting'] = Setting::pluck('value', 'key')->toArray();

        return $data;
    }

    /**
     * @param $quote
     * @return mixed
     */
    public function getDefaultTemplate($quote)
    {
        $data['invoice_template_name'] = $quote->invoiceTemplate?->key;

        return $data['invoice_template_name'];
    }

    /**
     * @param  array  $input
     * @return array
     */
    public function prepareInputForQuoteItem(array $input): array
    {
        $items = [];
        foreach ($input as $key => $data) {
            foreach ($data as $index => $value) {
                $items[$index][$key] = $value;
                if (!(isset($items[$index]['price']) && $key == 'price')) {
                    continue;
                }
                $items[$index]['price'] = removeCommaFromNumbers($items[$index]['price']);
            }
        }

        return $items;
    }

    /**
     * @param  array  $input
     */
    public function saveNotification($input, $quote = null): void
    {
        $userId = $input['client_id'];
        $input['quote_id'] = $quote->quote_id;
        $title = 'New Quote created #' . $input['quote_id'] . '.';
        if ($input['status'] != Quote::DRAFT) {
            addNotification([
                Notification::NOTIFICATION_TYPE['Quote Created'],
                $userId,
                $title,
            ]);
        }
    }

    /**
     * @param $quote
     * @param $input
     * @param  array  $changes
     */
    public function updateNotification($quote, $input, array $changes = [])
    {
        $quote->load('client.user');
        $userId = $quote->client->user_id;
        $title = 'Your Quote #' . $quote->quote_id . ' was updated.';
        if ($input['status'] != Quote::DRAFT) {
            if (isset($changes['status'])) {
                $title = 'Status of your Quote #' . $quote->quote_id . ' was updated.';
            }
            addNotification([
                Notification::NOTIFICATION_TYPE['Quote Updated'],
                $userId,
                $title,
            ]);
        }
    }

    /**
     * @param $quote
     * @return array
     */
    public function getQuoteData($quote): array
    {
        $data = [];

        $quote = Quote::with([
            'client' => function ($query) {
                $query->select(['id', 'user_id', 'address']);
                $query->with([
                    'user' => function ($query) {
                        $query->select(['first_name', 'last_name', 'email', 'id']);
                    },
                ]);
            },
            'quoteItems',
            'quoteItems' => function ($query) {
                $query->with(['product', 'quoteItemTax']);
            },
            'quoteTaxes'
        ])->whereId($quote->id)->firstOrFail();

        $data['quote'] = $quote;
        $quoteItems = $quote->quoteItems;

        $data['totalTax'] = [];

        foreach ($quoteItems as $item) {
            $totalTax = $item->quoteItemTax->sum('tax');
            $data['totalTax'][] = $item['quantity'] * $item['price'] * $totalTax / 100;
        }


        return $data;
    }

    /**
     * @param $quote
     * @return array
     */
    public function prepareEditFormData($quote): array
    {
        /** @var Quote $quote */
        $quote = Quote::with([
            'quoteItems' => function ($query) {
                $query->with(['quoteItemTax']);
            },
            'client',
        ])->whereId($quote->id)->firstOrFail();

        $data = $this->getSyncList([$quote]);
        $data['client_id'] = $quote->client->user_id;
        $data['$quote'] = $quote;

        $quoteItems = $quote->quoteItems;

        $data['selectedTaxes'] = [];
        foreach ($quoteItems as $quoteItem) {
            $quoteItemTaxes = $quoteItem->quoteItemTax;
            foreach ($quoteItemTaxes as $quoteItemTax) {
                $data['selectedTaxes'][$quoteItem->id][] = $quoteItemTax->tax_id;
            }
        }

        return $data;
    }
}
