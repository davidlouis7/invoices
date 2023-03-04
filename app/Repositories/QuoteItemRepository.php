<?php

namespace App\Repositories;

use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\QuoteItemTax;

/**
 * Class QuoteItemRepository
 *
 * @version February 24, 2020, 5:57 am UTC
 */
class QuoteItemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'quantity',
        'price',
        'tax',
        'total',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return QuoteItem::class;
    }

    /**
     * @param  array  $quoteItemInput
     * @param $quoteId
     */
    public function updateQuoteItem(array $quoteItemInput, $quoteId)
    {
        /** @var Quote $quote */
        $quote = Quote::find($quoteId);
        $quoteItemIds = [];

        foreach ($quoteItemInput as $key => $data) {
            if (isset($data['id']) && !empty($data['id'])) {
                $quoteItemIds[] = $data['id'];
                $this->update($data, $data['id']);

                $tax = ($data['tax'] != 0) ? $data['tax'] : $data['tax'] = [0 => null];
                $taxIds = ($data['tax_id'] != 0) ? $data['tax_id'] : $data['tax_id'] = [0 => 0];
                $this->addQuoteItemTax($data['id'], $tax, $taxIds, true);
                $this->removeQuoteItemTax($data['id'], $taxIds);
            } else {
                /** @var QuoteItem $quoteItem */
                $quoteItem = new QuoteItem($data);
                $quoteItem = $quote->quoteItems()->save($quoteItem);

                $tax = ($data['tax'] != 0) ? $data['tax'] : $data['tax'] = [0 => null];
                $taxIds = ($data['tax_id'] != 0) ? $data['tax_id'] : $data['tax_id'] = [0 => 0];
                $this->addQuoteItemTax($quoteItem->id, $tax, $taxIds);

                $quoteItemIds[] = $quoteItem->id;
            }
        }

        if (!(isset($quoteItemIds) && count($quoteItemIds))) {
            return;
        }

        QuoteItem::whereNotIn('id', $quoteItemIds)->whereQuoteId($quote->id)->delete();
    }

    /**
     * @param $quoteItemId
     * @param $tax
     * @param $taxIds
     * @param  false  $checkDifference
     * @return bool|void
     */
    public function addQuoteItemTax($quoteItemId, $tax, $taxIds, $checkDifference = false)
    {
        if (!$checkDifference) {
            foreach ($taxIds as $index => $value) {
                $quoteItemTax = QuoteItemTax::create([
                    'quote_item_id' => $quoteItemId,
                    'tax_id' => $value,
                    'tax' => $tax[$index],
                ]);
            }

            return true;
        }
        $quoteItemTaxIds = QuoteItemTax::whereQuoteItemId($quoteItemId)->pluck('tax_id')->toArray();
        $taxDifference = array_diff($taxIds, $quoteItemTaxIds);
        if (!is_null($taxDifference)) {
            foreach ($taxDifference as $index => $value) {
                $quoteItemTax = QuoteItemTax::create([
                    'quote_item_id' => $quoteItemId,
                    'tax_id' => $value,
                    'tax' => $tax[$index],
                ]);
            }
        }
    }

    /**
     * @param $quoteItemId
     * @param $taxIds
     */
    public function removeQuoteItemTax($quoteItemId, $taxIds)
    {
        $quoteItemTaxIds = QuoteItemTax::whereQuoteItemId($quoteItemId)->pluck('tax_id')->toArray();
        $taxDifference = array_diff($quoteItemTaxIds, $taxIds);
        foreach ($taxDifference as $index => $value) {
            QuoteItemTax::whereQuoteItemId($quoteItemId)->whereTaxId($value)->delete();
        }
    }
}
