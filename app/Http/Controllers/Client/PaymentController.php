<?php

namespace App\Http\Controllers\Client;

use App\Exports\ClientTransactionsExport;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreatePaymentRequest;
use App\Models\Invoice;
use App\Models\Payment;
use App\Repositories\InvoiceRepository;
use App\Repositories\PaymentRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use PDF;

class PaymentController extends AppBaseController
{
    /** @var PaymentRepository */
    public $paymentRepository;

    public $invoiceRepository;

    /**
     * @param  PaymentRepository  $paymentRepo
     * @param  InvoiceRepository  $invoiceRepo
     */
    public function __construct(PaymentRepository $paymentRepo, InvoiceRepository $invoiceRepo)
    {
        $this->paymentRepository = $paymentRepo;
        $this->invoiceRepository = $invoiceRepo;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $paymentModeArr = Payment::PAYMENT_MODE;
        unset($paymentModeArr[Payment::ALL]);

        return view('client_panel.transactions.index', compact('paymentModeArr'));
    }

    /**
     * @param  CreatePaymentRequest  $request
     * @return mixed
     */
    public function store(CreatePaymentRequest $request): mixed
    {
        $input = $request->all();
        $input['payment_date'] = Carbon::now();
        $input['transaction_id'] = is_null($input['transaction_id']) ? substr(md5(microtime()), 0, 6) : $input['transaction_id'];

        if ($input['payment_type'] != Payment::FULLPAYMENT && $input['payable_amount'] < $input['amount']) {
            return $this->sendError(__('Partially Paid Amount is Always Less For Full Amount'));
        }

        if ($input['payment_type'] == Payment::FULLPAYMENT && $input['payable_amount'] != $input['amount']) {
            return $this->sendError(__('Enter only Payable Amount'));
        }

        /** @var Invoice $invoice */
        $invoice = Invoice::whereId($input['invoice_id'])->firstOrFail();
        $input['currency_id'] = $invoice->currency_id;
        $payment = $this->paymentRepository->store($input, $invoice);
        if ($payment) {
            $this->paymentRepository->saveNotification($input);
        }
        $data = [];
        $data['redirectUrl'] = route('client.invoices.index');

        if (!Auth::check()) {
            $data['redirectUrl'] = route('invoice-show-url', ['invoiceId' => $invoice->invoice_id]);
        }

        Flash::success(__('Payment successfully done.'));

        return $this->sendResponse($data, __('Payment successfully done.'));
    }

    /**
     * @param  Request  $request
     * @param  Invoice  $invoice
     * @return mixed
     */
    public function show(Request $request, Invoice $invoice)
    {
        if (getLogInUserId() != $invoice->client->user_id) {
            Flash::error(__('Seems, you are not allowed to access this record.'));

            return redirect()->back();
        }
        $totalPayable = $this->paymentRepository->getTotalPayable($invoice);
        $paymentType = Payment::PAYMENT_TYPE;
        $paymentMode = $this->invoiceRepository->getPaymentGateways();
        $stripeKey = getSettingValue('stripe_key');
        if (empty($stripeKey)) {
            $stripeKey = config('services.stripe.key');
        }

        if ($request->ajax()) {
            return $this->sendResponse($totalPayable, __('Invoice retrieved successfully.'));
        }

        return view(
            'client_panel.invoices.payment',
            compact('paymentType', 'paymentMode', 'totalPayable', 'stripeKey', 'invoice')
        );
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportTransactionsExcel(): BinaryFileResponse
    {
        return Excel::download(new ClientTransactionsExport(), 'transactions-excel.xlsx');
    }

    /**
     * @return Response
     */
    public function exportTransactionsPdf(): Response
    {
        $data['payments'] = Payment::with('invoice.client.user')->whereHas('invoice.client', function (Builder $q) {
            $q->where('user_id', getLogInUser()->client->user_id);
        })->orderBy('created_at', 'desc')->get();
        $clientTransactionsPdf = PDF::loadView('transactions.export_transactions_pdf', $data);

        return $clientTransactionsPdf->download('Client-Transactions.pdf');
    }
}
