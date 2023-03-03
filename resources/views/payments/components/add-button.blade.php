<div class="me-4">
    <a href="{{ route('admin.paymentsExcel') }}" data-turbo="false" type="button" class="btn btn-outline-success me-2"
       target="_blank">
        <i class="fas fa-file-excel me-1"></i> {{__('messages.invoice.excel_export')}}
    </a>
</div>
<div class="me-4">
    <button type="button" class="btn btn-primary addPayment">
        {{ __('messages.payment.add_payment') }}
    </button>
</div>

