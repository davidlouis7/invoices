<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Tax;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Quote
 *
 * @property int $id
 * @property string $quote_id
 * @property int $client_id
 * @property string $quote_date
 * @property string $due_date
 * @property float|null $amount
 * @property float|null $final_amount
 * @property int $discount_type
 * @property float $discount
 * @property string|null $note
 * @property string|null $term
 * @property int|null $template_id
 * @property int $recurring
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdminPayment[] $AdminPayment
 * @property-read int|null $admin_payment_count
 * @property-read \App\Models\Client $client
 * @property-read string $status_label
 * @property-read \App\Models\InvoiceSetting|null $invoiceTemplate
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuoteItem[] $quoteItems
 * @property-read int|null $quote_items_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Quote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quote query()
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereFinalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereQuoteDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereQuoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereRecurring($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereTerm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Quote extends Model
{
    use HasFactory;

    const SELECT_DISCOUNT_TYPE = 0;

    const FIXED = 1;

    const PERCENTAGE = 2;

    const DISCOUNT_TYPE = [
        self::SELECT_DISCOUNT_TYPE => 'Select Discount Type',
        self::FIXED => 'Fixed',
        self::PERCENTAGE => 'Percentage',
    ];

    const DRAFT = 0;

    const CONVERTED = 1;

    const STATUS_ALL = 2;

    const STATUS_ARR = [
        self::DRAFT => 'Draft',
        self::CONVERTED => 'Converted',
        self::STATUS_ALL => 'All',
    ];

    const MONTHLY = 1;

    const QUARTERLY = 2;

    const SEMIANNUALLY = 3;

    const ANNUALLY = 4;

    const RECURRING_ARR = [
        self::MONTHLY => 'Monthly',
        self::QUARTERLY => 'Quarterly',
        self::SEMIANNUALLY => 'Semi Annually',
        self::ANNUALLY => 'Annually',
    ];

    protected $with = ['quoteItems.product'];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'client_id' => 'required',
        'quote_id' => 'nullable|unique:quotes,quote_id',
        'quote_date' => 'nullable',
        'due_date' => 'nullable',
    ];

    public static function messages()
    {
        return [
            'client_id.required' => __('The Client field is required.'),
            'quote_date.required' => __('The Quote date field is required.'),
            'due_date' => __('The Quote Due date field is required.'),
        ];
    }

    public $table = 'quotes';

    public $appends = ['status_label'];

    public $fillable = [
        'client_id',
        'quote_date',
        'due_date',
        'quote_id',
        'amount',
        'discount_type',
        'discount',
        'final_amount',
        'note',
        'term',
        'template_id',
        'status',
    ];

    protected $casts = [
        'client_id' => 'integer',
        'quote_date' => 'date',
        'due_date' => 'date',
        'quote_id' => 'string',
        'amount' => 'double',
        'discount_type' => 'integer',
        'discount' => 'double',
        'final_amount' => 'double',
        'note' => 'string',
        'term' => 'string',
        'template_id' => 'integer',
        'status' => 'integer',
        'recurring' => 'integer',
    ];

    public function getStatusLabelAttribute(): string
    {
        return __(self::STATUS_ARR[$this->status]);
    }

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function quoteItems(): HasMany
    {
        return $this->hasMany(QuoteItem::class);
    }

    /**
     * @return string
     */
    public static function getNewQuoteId(): string
    {
        $lastQuote = self::whereNotNull('quote_id')->orderBy('quote_id', 'DESC')->first();
        if (!$lastQuote || !$lastQuote->quote_id) {
            return '0001';
        } else {
            return str_pad(intval($lastQuote->quote_id) + 1, 4, '0', STR_PAD_LEFT);
        }
    }

    /**
     * @return string
     */
    public static function generateUniqueQuoteId(): string
    {
        $quoteId = mb_strtoupper(Str::random(6));
        while (true) {
            $isExist = self::whereQuoteId($quoteId)->exists();
            if ($isExist) {
                self::generateUniqueQuoteId();
            }
            break;
        }

        return $quoteId;
    }

    /**
     * @return BelongsTo
     */
    public function invoiceTemplate(): BelongsTo
    {
        return $this->belongsTo(InvoiceSetting::class, 'template_id', 'id');
    }

    /**
     * @param $value
     */
    public function setQuoteDateAttribute($value)
    {
        $this->attributes['quote_date'] = Carbon::createFromFormat(currentDateFormat(), $value)->translatedFormat('Y-m-d');
    }

    /**
     * @param $value
     */
    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = Carbon::createFromFormat(currentDateFormat(), $value)->translatedFormat('Y-m-d');
    }

    /**
     * @return BelongsToMany
     */
    public function quoteTaxes(): BelongsToMany
    {
        return $this->belongsToMany(Tax::class, 'quote_taxes');
    }
}
