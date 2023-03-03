<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class paymentGatewayRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'stripe_key',
        'stripe_secret',
        'paypal_client_id',
        'paypal_secret',
        'razorpay_key',
        'razorpay_secret',
    ];

    protected $availableKeys = [
        'stripe_key',
        'stripe_secret',
        'paypal_client_id',
        'paypal_secret',
        'razorpay_key',
        'razorpay_secret',
        'stripe_enabled',
        'paypal_enabled',
        'razorpay_enabled',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model()
    {
        return Setting::class;
    }

    /**
     * @param $input
     * @return bool
     */
    public function store($input): bool
    {
        $input['stripe_enabled'] = (! isset($input['payment_gateway']['stripe_enabled'])) ? 0 : 1;
        $input['paypal_enabled'] = (! isset($input['payment_gateway']['paypal_enabled'])) ? 0 : 1;
        $input['razorpay_enabled'] = (! isset($input['payment_gateway']['razorpay_enabled'])) ? 0 : 1;
        $this->checkPaymentValidation($input);
        $InputArray = Arr::only($input, $this->availableKeys);
        foreach ($InputArray as $key => $value) {
            $value = $value ?? '';
            Setting::where('key', '=', $key)->first()->update(['value' => $value]);
        }

        return true;
    }

    /**
     * @return array
     */
    public function edit(): array
    {
        foreach ($this->availableKeys as $key) {
            $setting = Setting::where('key', $key)->first();
            $data[$key] = isset($setting) ? $setting->value : null;
        }

        return $data;
    }

    /**
     * @param $input
     */
    private function checkPaymentValidation($input): void
    {
        if ($input['stripe_enabled'] === 1 &&
            (empty($input['stripe_key']) || empty($input['stripe_secret']))) {
            throw new UnprocessableEntityHttpException('Please fill up all value for stripe payment gateway.');
        }
        if ($input['paypal_enabled'] === 1 &&
            (empty($input['paypal_client_id']) || empty($input['paypal_secret']))) {
            throw new UnprocessableEntityHttpException('Please fill up all value for paypal payment gateway.');
        }
        if ($input['razorpay_enabled'] === 1 &&
            (empty($input['razorpay_key']) || empty($input['razorpay_secret']))) {
            throw new UnprocessableEntityHttpException('Please fill up all value for razorpay payment gateway.');
        }
    }
}
