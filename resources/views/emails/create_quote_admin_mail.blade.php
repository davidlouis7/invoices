@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{ asset(getLogoUrl()) }}" class="logo" alt="{{ getAppName() }}">
        @endcomponent
    @endslot

    {{-- Body --}}
    <div>
        <h2>{{__('Dear')}} {{ $clientName }}, <b></b></h2><br>
        <p>{{__('I hope you are well.')}}</p>
        <p>{{__('Please see attached the quote #:quote. The quote is due by :duedate.', ['quote' => $quoteNumber, 'duedate' => $dueDate])}}</p>
        <p>{{__('Please don\'t hesitate to get in touch if you have any questions or need clarifications.')}}</p><br>
        <div style="display: flex;justify-content: center">
            <a href="{{route('client.quotes.show', $quoteId)}}"
               style="padding: 7px 15px;text-decoration: none;font-size: 14px;background-color: #df4645;font-weight: 500;border: none;border-radius: 8px;color: white">
                {{__('View Quote')}}
            </a>
        </div>
    </div>

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <h6>© {{ date('Y') }} {{ getAppName() }}.</h6>
        @endcomponent
    @endslot
@endcomponent
