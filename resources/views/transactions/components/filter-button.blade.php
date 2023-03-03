<div class="ms-0 ms-md-2" wire:ignore>
    <div class="dropdown d-flex align-items-center me-4 me-md-5">
        <button
                class="btn btn btn-icon btn-primary text-white dropdown-toggle hide-arrow ps-2 pe-0"
                type="button" data-bs-auto-close="outside"
                data-bs-toggle="dropdown" aria-expanded="false"
                id="transactionFilterBtn">
            <i class='fas fa-filter'></i>
        </button>
        <div class="dropdown-menu py-0" aria-labelledby="transactionFilterBtn">
            <div class="text-start border-bottom py-4 px-7">
                <h3 class="text-gray-900 mb-0">Filter Options</h3>
            </div>
            <div class="p-5">
                <div class="mb-10">
                    <label class="form-label fs-6 fw-bold">{{__('messages.payment.payment_method').':' }}</label>
                    {{ Form::select('payment_mode',$component->filterComponent[1],null, ['class' => 'form-select role-selector payment-mode-filter']) }}
                </div>
                <div class="mb-10">
                    <label class="form-label fs-6 fw-bold">{{ __('messages.common.status').':' }}</label>
                    <br>
                    {{ Form::select('is_approved',$component->filterComponent[2],null,['class'=>'form-select role-selector payment-status-filter']) }}
                </div>
                <div class="d-flex justify-content-end">
                    <button type="reset" id="transactionResetFilter" class="btn btn-secondary">{{ __('messages.common.reset') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

