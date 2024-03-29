@extends('layouts.app')
@section('title')
{{ __('messages.setting.invoice_settings') }}
@endsection
@section('content')
<div class="container-fluid">
    @include('flash::message')
    <div class="card">
        <div class="card-body">
            <div class="alert alert-danger display-none hide" id="validationErrorsBox"></div>
            {{ Form::open(['route' => ['settings.update'], 'method' => 'post']) }}
            <div class="row">
                <div class="form-group col-sm-6 mb-5">
                    <input type="hidden" name="invoice_settings" value="1">
                    {{ Form::label('current_currency', __('messages.setting.currencies').':', ['class' => 'form-label
                    required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    <select id="currencyType" data-show-content="true" class="form-select " name="current_currency">
                        @foreach(getCurrencies() as $key => $currency)
                        <option value="{{ $currency['id'] }}" {{ getSettingValue('current_currency')==$currency['id']
                            ? 'selected' : '' }}>
                            {{$currency['icon']}}&nbsp;&nbsp;&nbsp; {{$currency['name']}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('currency_after_amount', __('messages.setting.currency_position').':', ['class' =>
                    'form-label required fw-bolder mb-3']) }}
                    <label class="form-check form-switch form-check-custom mt-3">
                        <input class="form-check-input currencyAfterAmount" type="checkbox" name="currency_after_amount"
                            id="currencyAfterAmount"
                            {{$settings['currency_after_amount']==\App\Models\Setting::CURRENCY_AFTER_AMOUNT ? "checked"
                            : "" }}>
                        <span class="form-check-label text-gray-600" for="currencyAfterAmount">{{
                            __('messages.setting.show_currency_behind') }}</span>&nbsp;&nbsp;
                    </label>
                </div>
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('Invoice No Prefix', __('messages.setting.invoice_no_prefix').':', ['class' =>
                    'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('invoice_no_prefix', $settings['invoice_no_prefix'], ['class' => 'form-control'
                    ,'placeholder' => __('messages.setting.invoice_no_prefix'),'maxlength'=> "50"]) }}
                </div>
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('decimal_separator', __('messages.setting.decimal_separator').':', ['class' =>
                    'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    <div class="radio-button-group">
                        <div class="btn-group btn-group-toggle m-0" data-toggle="buttons">
                            <input type="radio" class="decimal_separator-0" name="decimal_separator"
                                id="decimal_separator-0" value="." {{ ($settings['decimal_separator']=='.' ) ? 'checked'
                                : '' }}>
                            <label for="decimal_separator-0" class="me-2" role="button">DOT(.)</label>

                            <input type="radio" class="decimal_separator-1" name="decimal_separator"
                                id="decimal_separator-1" value="," {{ ($settings['decimal_separator']==',' ) ? 'checked'
                                : '' }}>
                            <label for="decimal_separator-1" role="button">COMMA(,)</label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('Invoice No Suffix', __('messages.setting.invoice_no_suffix').':', ['class' =>
                    'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('invoice_no_suffix', $settings['invoice_no_suffix'], ['class' =>
                    'form-control','placeholder' => __('messages.setting.invoice_no_suffix'),'maxlength'=> "50"]) }}
                </div>
                <div class="form-group col-sm-6 mb-5">
                    {{ Form::label('thousand_separator', __('messages.setting.thousand_separator').':', ['class' =>
                    'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                    <div class="radio-button-group">
                        <div class="btn-group btn-group-toggle m-0" data-toggle="buttons">
                            <input type="radio" name="thousand_separator" id="thousand_separator-0" value="." {{
                                ($settings['thousand_separator']=='.' ) ? 'checked' : '' }}>
                            <label for="thousand_separator-0" class="me-2" role="button">DOT(.)</label>

                            <input type="radio" name="thousand_separator" id="thousand_separator-1" value="," {{
                                ($settings['thousand_separator']==',' ) ? 'checked' : '' }}>
                            <label for="thousand_separator-1" role="button">COMMA(,)</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="float-end d-flex mt-5">
                    @if (app()->getLocale() == 'ar')
                    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary ms-3']) }}
                    @else
                    {{ Form::submit(__('messages.common.save'), ['class' => app()->getLocale() == 'ar' ? 'btn btn-primary ms-3' : 'btn btn-primary me-3']) }}
                    @endif
                    {{ Form::reset(__('messages.common.cancel'), ['class' => 'btn btn-secondary btn-active-light-primary
                    me-3']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
