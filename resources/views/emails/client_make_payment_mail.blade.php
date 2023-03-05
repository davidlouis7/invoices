@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{ asset(getLogoUrl()) }}" class="logo" alt="{{ getAppName() }}">
        @endcomponent
    @endslot

    {{-- Body --}}
    <div>
        <h2>{{__('Dear')}} {{ $adminName }},</h2>
        <h4 style="color: green">{{__('Payment received successfully for invoice')}} #{{ $invoiceNo }} ..!</h4>
        <p>{{__('Payment Date')}} : <strong>{{ $receivedDate }}</strong></p>
        <p>{{__('Received Payment Amount')}} : <strong>{{ $receivedAmount }}</strong> </p>
        <br>
        <p>{{__('This is a confirmation that amount has been successfully received.')}}</p>
        <div style="display: flex;justify-content: center">
            <a href="{{ route('invoices.show',['invoice'=>$invoiceId,'active'=>'paymentHistory']) }}"
               style="padding: 7px 15px;text-decoration: none;font-size: 14px;background-color: green ;font-weight: 500;border: none;border-radius: 8px;color: white">
                {{__('View Payment History')}}
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
