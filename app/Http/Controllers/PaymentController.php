<?php

namespace App\Http\Controllers;

use App\Exports\AdminTransactionsExport;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Barryvdh\DomPDF\Facade as PDF;

class PaymentController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $paymentModeArr = Payment::PAYMENT_MODE;
        unset($paymentModeArr[Payment::ALL]);

        return view('transactions.index', compact('paymentModeArr'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportTransactionsExcel(): BinaryFileResponse
    {
        return Excel::download(new AdminTransactionsExport(), 'transaction.xlsx');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function showPaymentNotes($id): JsonResponse
    {
        $paymentNotes = Payment::where('id', $id)->first();

        return $this->sendResponse($paymentNotes->notes, 'Note retrieved successfully.');
    }

    /**
     * @param  Request  $request
     * @return mixed
     */
    public function changeTransactionStatus(Request $request): mixed
    {
        $input = $request->all();

        /** @var Payment $payment */
        $payment = Payment::whereId($input['id'])->wherePaymentMode(Payment::MANUAL)->with('invoice')->firstOrFail();

        if ($input['status'] == Payment::MANUAL) {
            $payment->update([
                'is_approved' => $input['status'],
            ]);
            $this->updatePayment($payment);

            return $this->sendSuccess('Manual Payment Approved successfully.');
        }

        $payment->update([
            'is_approved' => $input['status'],
        ]);
        $this->updatePayment($payment);

        return $this->sendSuccess('Manual Payment Denied successfully.');
    }

    /**
     * @param  Payment  $payment
     * @return void
     */
    private function updatePayment(Payment $payment): void
    {
        $paymentInvoice = $payment->invoice;
        $totalPayment = Payment::whereInvoiceId($paymentInvoice->id)->whereIsApproved(Payment::APPROVED)->sum('amount');
        $status = Invoice::PARTIALLY;
        if ($payment->amount == $paymentInvoice->final_amount || $totalPayment == $paymentInvoice->final_amount) {
            $status = $payment->is_approved == Payment::APPROVED ? Invoice::PAID : Invoice::UNPAID;
        } elseif ($totalPayment == 0) {
            $status = Invoice::UNPAID;
        }
        $paymentInvoice->update([
            'status' => $status,
        ]);
    }

    public function downloadAttachment($transactionId)
    {
        /** @var Payment $transaction */
        $transaction = Payment::with('media')->findOrFail($transactionId);
        $attachment = $transaction->media->first();

        if (getLogInUser()->hasrole(Role::CLIENT)) {
            if ($transaction->invoice->client->user_id !== getLogInUserId()) {
                Flash::error('Seems, you are not allowed to access this record.');

                return redirect()->back();
            }
        }

        if ($attachment) {
            return $attachment;
        }

        return null;
    }

    /**
     * @return Response
     */
    public function exportTransactionsPdf(): Response
    {
        $data['payments'] = Payment::with(['invoice.client.user'])->orderBy('created_at', 'desc')->get();
        $transactionsPdf = PDF::loadView('transactions.export_transactions_pdf', $data);
        
        return $transactionsPdf->download('Transactions.pdf');
    }
}
