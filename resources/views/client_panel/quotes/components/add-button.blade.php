<a href="{{ route('client.quotesExcel') }}" type="button" class="btn btn-outline-success me-2" data-turbo="false">
    <i class="fas fa-file-excel me-1"></i> {{__('messages.quote.excel_export')}}
</a>
<a href="{{ route('client.export.quotes.pdf') }}" type="button" class="btn btn-outline-info me-2" data-turbo="false">
    <i class="fas fa-file-pdf me-1"></i> {{__('messages.pdf_export')}}
</a>
<a href="{{ route('client.quotes.create') }}" data-turbo="false"
   class="btn btn-primary">{{__('messages.quote.new_quote')}}</a>
