@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{ asset(getLogoUrl()) }}" class="logo" alt="{{ getAppName() }}">
        @endcomponent
    @endslot

    {{-- Body --}}
    <div>
        <h2>Dear {{ $clientName }}, <b></b></h2><br>
        <p>I hope you are well.</p>
        <p>Please see attached the invoice #{{ $invoiceNumber }}. The invoice is due by {{ $dueDate }}.</p>
        <p>Please don't hesitate to get in touch if you have any questions or need clarifications.</p>
        <p>Also you can see the attachment invoice PDF.</p><br>
        <div style="display: flex;justify-content: center">
            <a href="{{route('client.invoices.show',['invoice'=>$invoiceId])}}"
               style="padding: 7px 15px;text-decoration: none;font-size: 14px;background-color: #df4645;font-weight: 500;border: none;border-radius: 8px;color: white">
                View Invoice
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
