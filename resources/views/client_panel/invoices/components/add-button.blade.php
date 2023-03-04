<a href="{{ route('client.invoicesExcel') }}" type="button" class="btn btn-outline-success me-2" data-turbo="false">
    <i class="fas fa-file-excel me-1"></i>  {{__('messages.invoice.excel_export')}}
</a>
@if (false)
    <a href="{{ route('client.invoices.pdf') }}" type="button" class="btn btn-outline-info me-2" data-turbo="false">
        <i class="fas fa-file-pdf me-1"></i>  {{__('messages.pdf_export')}}
    </a>
@endif