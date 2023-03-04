<?php

use App\Models\Currency;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Setting;
use App\Models\Tax;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;

/**
 * @return Authenticatable|null
 */
function getLogInUser()
{
    return Auth::user();
}

/**
 * @return mixed
 */
function getAppName()
{
    /** @var Setting $appName */
    static $appName;
    if (empty($appName)) {
        $appName = Setting::where('key', '=', 'app_name')->first();
    }

    return $appName->value;
}

/**
 * @return mixed
 */
function getLogoUrl()
{
    static $appLogo;

    if (empty($appLogo)) {
        $appLogo = Setting::where('key', '=', 'app_logo')->first();
    }

    return asset($appLogo->logo_url);
}

/**
 * @return string[]
 */
function getUserLanguages()
{
    $language = User::LANGUAGES;
    asort($language);

    return $language;
}

/**
 * @return mixed
 */
function getCurrentLanguageName()
{
    return Auth::user()->language;
}

/**
 * @return mixed
 */
function getManualPayment()
{
    static $manualPayment;

    if (empty($manualPayment)) {
        $manualPayment = Setting::where('key', '=', 'payment_auto_approved')->first()->value;
    }

    return $manualPayment;
}

/**
 * @param $invoiceId
 * @return float|int
 */
function getInvoicePaidAmount($invoiceId)
{
    $dueAmount = 0;
    $paid = 0;
    $invoice = Invoice::whereId($invoiceId)->with('payments')->firstOrFail();

    if ($invoice->status != Invoice::PAID) {
        foreach ($invoice->payments as $payment) {
            if ($payment->payment_mode == \App\Models\Payment::MANUAL && $payment->is_approved !== \App\Models\Payment::APPROVED) {
                continue;
            }
            $paid += $payment->amount;
        }
    } else {
        $paid += $invoice->final_amount;
    }

    return $paid;
}

/**
 * @param $invoiceId
 * @return float|\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|int|mixed|null
 */
function getInvoiceDueAmount($invoiceId)
{
    $dueAmount = 0;
    $paid = 0;
    $invoice = Invoice::whereId($invoiceId)->with('payments')->firstOrFail();

    foreach ($invoice->payments as $payment) {
        if ($payment->payment_mode == \App\Models\Payment::MANUAL && $payment->is_approved !== \App\Models\Payment::APPROVED) {
            continue;
        }
        $paid += $payment->amount;
    }

    return $invoice->status != \App\Models\Invoice::PAID ? $invoice->final_amount - $paid : 0;
}

/**
 * @return int
 */
function getLogInUserId()
{
    static $authUser;
    if (empty($authUser)) {
        $authUser = Auth::user();
    }

    return $authUser->id;
}

/**
 * @return string
 */
function getDashboardURL()
{
    return RouteServiceProvider::HOME;
}

/**
 * @return string
 */
function getClientDashboardURL()
{
    return RouteServiceProvider::CLIENT_HOME;
}

/**
 * @param $number
 * @return string|string[]
 */
function removeCommaFromNumbers($number)
{
    return (gettype($number) == 'string' && !empty($number)) ? str_replace(',', '', $number) : $number;
}

/**
 * @param $countryId
 * @return array
 */
function getStates($countryId)
{
    return \App\Models\State::where('country_id', $countryId)->toBase()->pluck('name', 'id')->toArray();
}

/**
 * @param $stateId
 * @return array
 */
function getCities($stateId): array
{
    return \App\Models\City::where('state_id', $stateId)->pluck('name', 'id')->toArray();
}

/**
 * @return mixed
 */
function getCurrentTimeZone()
{
    /** @var Setting $currentTimezone */
    static $currentTimezone;

    try {
        if (empty($currentTimezone)) {
            $currentTimezone = Setting::where('key', 'time_zone')->first();
        }
        if ($currentTimezone != null) {
            return $currentTimezone->value;
        } else {
            return null;
        }
    } catch (Exception $exception) {
        return 'Asia/Kolkata';
    }
}

/**
 * @return array
 */
function getCurrencies()
{
    return Currency::all();
}

/**
 * @return mixed
 */
function getCurrencySymbol()
{
    /** @var Setting $currencySymbol */
    static $currencySymbol;
    if (empty($currencySymbol)) {
        $currencySymbol = Currency::where('id', getSettingValue('current_currency'))->pluck('icon')->first();
    }

    return $currencySymbol;
}

/**
 * @return mixed
 */
function getInvoiceNoPrefix()
{
    /** @var Setting $invoiceNoPrefix */
    static $invoiceNoPrefix;
    if (empty($invoiceNoPrefix)) {
        $invoiceNoPrefix = Setting::where('key', '=', 'invoice_no_prefix')->first();
    }

    return $invoiceNoPrefix->value;
}

/**
 * @return mixed
 */
function getInvoiceNoSuffix()
{
    /** @var Setting $invoiceNoSuffix */
    static $invoiceNoSuffix;
    if (empty($invoiceNoSuffix)) {
        $invoiceNoSuffix = Setting::where('key', '=', 'invoice_no_suffix')->first();
    }

    return $invoiceNoSuffix->value;
}

function getDefaultTax()
{
    return Tax::where('is_default', '=', '1')->first()->id ?? null;
}

//Stripe Payment

function setStripeApiKey()
{
    $stripeSecretKey = config('services.stripe.secret_key');

    $stripeSecret = getSettingValue('stripe_secret');
    isset($stripeSecret) ? Stripe::setApiKey($stripeSecret) : Stripe::setApiKey($stripeSecretKey);
}

// current date format
/**
 * @return mixed
 */
function currentDateFormat(): mixed
{
    /** @var Setting $dateFormat */
    static $dateFormat;
    if (empty($dateFormat)) {
        $dateFormat = Setting::where('key', 'date_format')->first();
    }

    return $dateFormat->value;
}

/**
 * @return string
 */
function momentJsCurrentDateFormat(): string
{
    $key = Setting::DateFormatArray[currentDateFormat()];

    return $key;
}

/**
 * @param  array  $data
 */
function addNotification($data)
{
    $notificationRecord = [
        'type' => $data[0],
        'user_id' => $data[1],
        'title' => $data[2],
    ];

    if ($user = User::find($data[1])) {
        Notification::create($notificationRecord);
    }
}

/**
 * @return Collection
 */
function getNotification()
{
    /** @var Setting $notification */
    static $notification;
    if (empty($notification)) {
        $notification = Notification::whereUserId(Auth::id())->where(
            'read_at',
            null
        )->orderByDesc('created_at')->toBase()->get();
    }

    return $notification;
}

/**
 * @param  array  $data
 * @return array
 */
function getAllNotificationUser($data)
{
    return array_filter($data, function ($key) {
        return $key != getLogInUserId();
    }, ARRAY_FILTER_USE_KEY);
}

/**
 * @param $notificationType
 * @return string|void
 */
function getNotificationIcon($notificationType)
{
    switch ($notificationType) {
        case 1:
        case 2:
            return 'fas fa-file-invoice';
        case 3:
            return 'fas fa-wallet';
    }
}

/**
 * @return User|Builder|Model|object|null
 */
function getAdminUser()
{
    /** @var User $user */
    static $user;
    if (empty($user)) {
        $user = User::with([
            'roles' => function ($q) {
                $q->where('name', 'Admin');
            },
        ])->first();
    }

    return $user;
}

/**
 * @param  array  $models
 * @param  string  $columnName
 * @param  int  $id
 * @return bool
 */
function canDelete(array $models, string $columnName, int $id)
{
    foreach ($models as $model) {
        $result = $model::where($columnName, $id)->exists();

        if ($result) {
            return true;
        }
    }

    return false;
}

function numberFormat(float $num, int $decimals = 2)
{
    /** @var Setting $decimal_separator */
    /** @var Setting $thousands_separator */
    static $decimal_separator;
    static $thousands_separator;
    if (empty($decimal_separator) || empty($thousands_separator)) {
        $decimal_separator = getSettingValue('decimal_separator');
        $thousands_separator = getSettingValue('thousand_separator');
    }

    return number_format($num, $decimals, $decimal_separator, $thousands_separator);
}

if (!function_exists('getSettingValue')) {
    /**
     * @param $keyName
     * @return mixed
     */
    function getSettingValue($keyName)
    {
        $key = 'setting' . '-' . $keyName;
        static $settingValues;

        if (isset($settingValues[$key])) {
            return $settingValues[$key];
        }
        /** @var Setting $setting */
        $setting = Setting::where('key', '=', $keyName)->first();
        $settingValues[$key] = $setting->value;

        return $setting->value;
    }
}

function getPaymentGateway($keyName)
{
    $key = $keyName;
    static $settingValues;

    if (isset($settingValues[$key])) {
        return $settingValues[$key];
    }
    /** @var Setting $setting */
    $setting = Setting::where('key', '=', $keyName)->first();

    if ($setting->value !== '') {
        $settingValues[$key] = $setting->value;
    } else {
        $settingValues[$key] = (env($key) !== '') ? env($key) : '';
    }

    return $setting->value;
}

/**
 * @return mixed
 */
function getCurrencyCode()
{
    $currencyId = Setting::where('key', 'current_currency')->value('value');
    $currencyCode = Currency::whereId($currencyId)->first();

    return $currencyCode->code;
}

/**
 * @param $currencyId
 * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed
 */
function getInvoiceCurrencyCode($currencyId)
{
    $invoiceCurrencyCode = Currency::whereId($currencyId)->first();

    return $invoiceCurrencyCode->code;
}

/**
 * @param $currencyId
 * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed
 */
function getInvoiceCurrencyIcon($currencyId)
{
    $invoiceCurrencyCode = Currency::whereId($currencyId)->first();

    return $invoiceCurrencyCode->icon ?? '₹';
}

/**
 * @return mixed
 */
function getCurrentVersion()
{
    $composerFile = file_get_contents('../composer.json');
    $composerData = json_decode($composerFile, true);
    $currentVersion = $composerData['version'];

    return $currentVersion;
}

/**
 * @param $totalAmount
 * @param  int  $precision
 */
function formatTotalAmount($totalAmount, $precision = 2)
{
    if ($totalAmount < 900) {
        // 0 - 900
        $numberFormat = number_format($totalAmount, $precision);
        $suffix = '';
    } else {
        if ($totalAmount < 900000) {
            // 0.9k-850k
            $numberFormat = number_format($totalAmount / 1000, $precision);
            $suffix = 'K';
        } else {
            if ($totalAmount < 900000000) {
                // 0.9m-850m
                $numberFormat = number_format($totalAmount / 1000000, $precision);
                $suffix = 'M';
            } else {
                if ($totalAmount < 900000000000) {
                    // 0.9b-850b
                    $numberFormat = number_format($totalAmount / 1000000000, $precision);
                    $suffix = 'B';
                } else {
                    // 0.9t+
                    $numberFormat = number_format($totalAmount / 1000000000000, $precision);
                    $suffix = 'T';
                }
            }
        }
    }

    // Remove unnecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
    // Intentionally does not affect partials, eg "1.50" -> "1.50"
    if ($precision > 0) {
        $dotZero = '.' . str_repeat('0', $precision);
        $numberFormat = str_replace($dotZero, '', $numberFormat);
    }

    return $numberFormat . $suffix;
}

/**
 * @param $amount
 * @param  false  $formatting
 * @return string
 */
function getCurrencyAmount($amount, $formatting = false)
{
    static $currencyPosition;
    if (empty($currencyPosition)) {
        $currencyPosition = getSettingValue('currency_after_amount');
    }

    $currencySymbol = getCurrencySymbol();
    $formattedAmount = $formatting ? numberFormat($amount) : formatTotalAmount($amount);
    if ($currencyPosition) {
        return $formattedAmount . ' ' . $currencySymbol;
    }

    return $currencySymbol . ' ' . $formattedAmount;
}

/**
 * @param $amount
 * @param $currencyId
 * @param  false  $formatting
 * @return string
 */
function getInvoiceCurrencyAmount($amount, $currencyId, $formatting = false): string
{
    static $currencyPosition;
    if (empty($currencyPosition)) {
        $currencyPosition = getSettingValue('currency_after_amount');
    }

    static $currencySymbols;
    if (isset($currencySymbols[$currencyId])) {
        $currencySymbol = ($currencySymbols[$currencyId]);
    } else {
        $currencySymbol = Currency::whereId($currencyId)->pluck('icon')->first();
        $currencySymbols[$currencyId] = $currencySymbol;
    }

    $formattedAmount = $formatting ? numberFormat($amount) : formatTotalAmount($amount);
    if ($currencyPosition) {
        return $formattedAmount . ' ' . $currencySymbol;
    }

    return $currencySymbols[$currencyId] . ' ' . $formattedAmount;
}

function checkContactUniqueness($value, $regionCode, $exceptId = null): bool
{
    $recordExists = User::where('contact', $value)->where('region_code', $regionCode);
    if ($exceptId) {
        $recordExists = $recordExists->where('id', '!=', $exceptId);
    }
    if ($recordExists->exists()) {
        return true;
    }

    return false;
}

/**
 * @return array
 */
function getPayPalSupportedCurrencies(): array
{
    return [
        'AUD', 'BRL', 'CAD', 'CNY', 'CZK', 'DKK', 'EUR', 'HKD', 'HUF', 'ILS', 'JPY', 'MYR', 'MXN', 'TWD', 'NZD', 'NOK',
        'PHP', 'PLN', 'GBP', 'RUB', 'SGD', 'SEK', 'CHF', 'THB', 'USD',
    ];
}


function priceWithTaxes($quoteItem, $count = 1)
{
    $price = $quoteItem->price;

    $taxes = 0;
    foreach ($quoteItem->quoteItemTax as $quoteItemTax) {
        $taxes += ($count * (($quoteItemTax->tax / 100) * $price));
    }

    return $price + $taxes;
}

function invoicePriceWithTaxes($invoiceItem, $count = 1)
{
    $price = $invoiceItem->price;

    $taxes = 0;
    foreach ($invoiceItem->invoiceItemTax as $invoiceItemTax) {
        $taxes += ($count * (($invoiceItemTax->tax / 100) * $price));
    }

    return $price + $taxes;
}
