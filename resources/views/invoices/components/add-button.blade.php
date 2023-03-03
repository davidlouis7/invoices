<div>
    <a href="{{ route('admin.invoicesExcel') }}" type="button"
        class="btn btn-outline-success {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}" data-turbo="false">
        <i class="fas fa-file-excel me-1"></i> {{__('messages.invoice.excel_export')}}
    </a>
</div>
<div>
    <a href="{{ route('admin.invoices.pdf') }}" type="button"
        class="btn btn-outline-info {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}" data-turbo="false">
        <i class="fas fa-file-pdf me-1"></i> {{__('messages.pdf_export')}}
    </a>
</div>
<a href="{{ route('invoices.create') }}" data-turbo="false"
    class="btn btn-primary">{{__('messages.invoice.new_invoice')}}</a>
