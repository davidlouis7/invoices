<a href="{{ route('client.quotesExcel') }}" type="button"
    class="btn btn-outline-success {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}" data-turbo="false">
    <i class="fas fa-file-excel {{ app()->getLocale() == 'ar' ? 'ms-1' : 'me-1' }}"></i>
    {{__('messages.quote.excel_export')}}
</a>
<a href="{{ route('client.export.quotes.pdf') }}" type="button"
    class="btn btn-outline-info {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}" data-turbo="false">
    <i class="fas fa-file-pdf {{ app()->getLocale() == 'ar' ? 'ms-1' : 'me-1' }}"></i> {{__('messages.pdf_export')}}
</a>
<a href="{{ route('client.quotes.create') }}" data-turbo="false"
    class="btn btn-primary">{{__('messages.quote.new_quote')}}</a>