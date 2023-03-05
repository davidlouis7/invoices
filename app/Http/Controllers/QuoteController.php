<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Quote;
use App\Models\Invoice;
use App\Models\Product;
use Laracasts\Flash\Flash;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\InvoiceItemTax;
use Illuminate\Http\JsonResponse;
use App\Exports\AdminQuotesExport;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\QuoteRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\CreateQuoteRequest;
use App\Http\Requests\UpdateQuoteRequest;
use Illuminate\Contracts\Foundation\Application;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class QuoteController extends AppBaseController
{
    /** @var QuoteRepository */
    public $quoteRepository;

    public function __construct(QuoteRepository $quoteRepo)
    {
        $this->quoteRepository = $quoteRepo;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        $statusArr = Quote::STATUS_ARR;
        $status = $request->status;

        return view('quotes.index', compact('statusArr', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $data = $this->quoteRepository->getSyncList();

        return view('quotes.create')->with($data);
    }

    /**
     * @param  CreateQuoteRequest  $request
     * @return JsonResponse
     */
    public function store(CreateQuoteRequest $request)
    {
        try {
            DB::beginTransaction();
            $request->status = Quote::DRAFT;
            $quote = $this->quoteRepository->saveQuote($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($quote, __('Quote saved successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Quote  $quote
     * @return Application|Factory|View
     */
    public function show(Quote $quote)
    {
        $quoteData = $this->quoteRepository->getQuoteData($quote);

        return view('quotes.show')->with($quoteData);
    }

    /**
     * @param  Quote  $quote
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(Quote $quote)
    {
        if ($quote->status == Quote::CONVERTED) {
            Flash::error(__('Converted quote can not editable.'));

            return redirect()->route('quotes.index');
        }
        $data = $this->quoteRepository->prepareEditFormData($quote);
        $data['selectedQuoteTaxes'] = $quote->quoteTaxes()->pluck('tax_id')->toArray();

        return view('quotes.edit', compact('quote'))->with($data);
    }

    /**
     * @param  UpdateQuoteRequest  $request
     * @param  Quote  $quote
     * @return JsonResponse
     */
    public function update(UpdateQuoteRequest $request, Quote $quote): JsonResponse
    {
        $input = $request->all();
        try {
            DB::beginTransaction();
            $quote = $this->quoteRepository->updateQuote($quote->id, $input);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($quote, __('Quote updated successfully.'));
    }

    /**
     * @param  Quote  $quote
     * @return JsonResponse
     */
    public function destroy(Quote $quote): JsonResponse
    {
        $quote->delete();

        return $this->sendSuccess(__('Quote Deleted successfully.'));
    }

    /**
     * @param $productId
     * @return JsonResponse
     */
    public function getProduct($productId): JsonResponse
    {
        $product = Product::pluck('unit_price', 'id')->toArray();

        return $this->sendResponse($product, __('Product Price retrieved successfully.'));
    }

    /**
     * @param  Quote  $quote
     * @return Response
     */
    public function convertToPdf(Quote $quote): Response
    {
        ini_set('max_execution_time', 36000000);
        $quote->load('client.user', 'invoiceTemplate', 'quoteItems.product', 'quoteItems');
        $quoteData = $this->quoteRepository->getPdfData($quote);
        $invoiceTemplate = $this->quoteRepository->getDefaultTemplate($quote);

        $pdf = PDF::loadView("quotes.quote_template_pdf.my_template", $quoteData);

        return $pdf->stream('quote.pdf');
    }

    /**
     * @param  Request  $request
     * @return mixed
     */
    public function convertToInvoice(Request $request)
    {
        $quoteId = $request->quoteId;
        $quote = Quote::whereId($quoteId)->firstOrFail();

        $quoteDatas = $this->quoteRepository->getQuoteData($quote);
        $quoteData = $quoteDatas['quote'];
        $quoteItems = $quoteDatas['quote']['quoteItems'];

        if (!empty(getInvoiceNoPrefix())) {
            $quoteData['quote_id'] = getInvoiceNoPrefix() . '-' . $quoteData['quote_id'];
        }
        if (!empty(getInvoiceNoSuffix())) {
            $quoteData['quote_id'] .= '-' . getInvoiceNoSuffix();
        }

        $invoice['invoice_id'] = $quoteData['quote_id'];
        $invoice['client_id'] = $quoteData['client_id'];
        $invoice['invoice_date'] = Carbon::parse($quoteData['quote_date'])->format(currentDateFormat());
        $invoice['due_date'] = Carbon::parse($quoteData['due_date'])->format(currentDateFormat());
        $invoice['amount'] = $quoteData['amount'];
        $invoice['final_amount'] = $quoteData['final_amount'];
        $invoice['discount_type'] = $quoteData['discount_type'];
        $invoice['discount'] = $quoteData['discount'];
        $invoice['note'] = $quoteData['note'];
        $invoice['term'] = $quoteData['term'];
        $invoice['template_id'] = $quoteData['template_id'];
        $invoice['recurring'] = $quoteData['recurring'];
        $invoice['status'] = Invoice::DRAFT;

        $invoice = Invoice::create($invoice);

        // Sync quote items
        foreach ($quoteItems as $quoteItem) {
            $invoiceItem = InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'product_id' => $quoteItem['product_id'],
                'product_name' => $quoteItem['product_name'],
                'quantity' => $quoteItem['quantity'],
                'price' => $quoteItem['price'],
                'total' => $quoteItem['total'],
            ]);
            // Sync quote item taxes
            foreach ($quoteItem->quoteItemTax as $quoteItemTax) {
                InvoiceItemTax::create([
                    'invoice_item_id' => $invoiceItem->id,
                    'tax_id' => $quoteItemTax->tax_id,
                    'tax' => $quoteItemTax->tax,
                ]);
            }
        }



        Quote::whereId($quoteId)->update(['status' => Quote::CONVERTED]);

        return $this->sendSuccess(__('Converted to Invoice successfully!'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportQuotesExcel(): BinaryFileResponse
    {
        return Excel::download(new AdminQuotesExport(), 'quote-excel.xlsx');
    }

    public function getPublicQuotePdf($quoteId)
    {
        $quote = Quote::whereQuoteId($quoteId)->firstOrFail();
        $quote->load('client.user', 'invoiceTemplate', 'quoteItems.product', 'quoteItems');

        $quoteData = $this->quoteRepository->getPdfData($quote);
        $invoiceTemplate = $this->quoteRepository->getDefaultTemplate($quote);
        $pdf = PDF::loadView("quotes.quote_template_pdf.$invoiceTemplate", $quoteData);

        return $pdf->stream('quote.pdf');
    }

    /**
     * @param $quoteId
     * @return Application|Factory|View
     */
    public function showPublicQuote($quoteId): View|Factory|Application
    {
        $quote = Quote::with('client.user')->whereQuoteId($quoteId)->firstOrFail();
        $quoteData = $this->quoteRepository->getQuoteData($quote);
        $quoteData['statusArr'] = Quote::STATUS_ARR;
        $quoteData['status'] = $quote->status;

        return view('quotes.public-quote.public_view')->with($quoteData);
    }

    /**
     * @return Response
     */
    public function exportQuotesPdf(): Response
    {
        $data['quotes'] = Quote::with('client.user')->orderBy('created_at', 'desc')->get();
        $quotesPdf = PDF::loadView('quotes.export_quotes_pdf', $data);

        return $quotesPdf->download('Quotes.pdf');
    }
}
