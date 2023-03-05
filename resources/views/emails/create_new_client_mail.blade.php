@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{ asset(getLogoUrl()) }}" class="logo" alt="{{ getAppName() }}">
        @endcomponent
    @endslot

    {{-- Body --}}
    <div>
        <h2>{{__('Welcome')}} {{ $clientName }}, <b></b></h2><br>
        <p>{{__('Your account has been successfully created on')}} {{ getAppName() }}</p>
        <p>{{__('Your email address is')}} <strong>{{ $userName }}</strong></p>
        <p>{{__('Your account password is')}} <strong>{{ $password  }}</strong></p>
        <p>{{__('In')}} {{ getAppName() }}, {{__('you can manage all of your invoices.')}}</p>
        <p>{{__('Thank for joining and have a great day!')}}</p><br>
        <div style="display: flex;justify-content: center">
            <a href="{{ route('login') }}"
               style="padding: 7px 15px;text-decoration: none;font-size: 14px;background-color: #df4645;font-weight: 500;border: none;border-radius: 8px;color: white">
                {{__('login to')}} {{ getAppName() }}
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
