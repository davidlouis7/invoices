<div>
    <a href="{{ route('admin.quotesExcel') }}" type="button"
        class="btn btn-outline-success {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }} " data-turbo="false">
        <i class="fas fa-file-excel me-1"></i> {{__('messages.quote.excel_export')}}
    </a>
</div>
@if (false)
<div>
    <a href="{{ route('admin.quotes.pdf') }}" type="button"
        class="btn btn-outline-info {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}" data-turbo="false">
        <i class="fas fa-file-pdf me-1"></i> {{__('messages.pdf_export')}}
    </a>
</div>
@endif
<a href="{{ route('quotes.create') }}" data-turbo="false" class="btn btn-primary">{{__('messages.quote.new_quote')}}</a>
