<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'يجب قبول :attribute.',
    'active_url' => ':attribute ليست عنوان URL صالحًا.',
    'after' => 'يجب أن تكون :attribute تاريخًا بعد: التاريخ.',
    'after_or_equal' => 'يجب أن تكون :attribute تاريخًا بعد: التاريخ أو مساويًا له.',
    'alpha' => 'لا يجوز أن تحتوي :attribute إلا على أحرف.',
    'alpha_dash' => 'لا يجوز أن تحتوي :attribute إلا على أحرف وأرقام وشرطات وشرطات سفلية.',
    'alpha_num' => 'لا يجوز أن تحتوي :attribute إلا على أحرف وأرقام.',
    'array' => 'يجب أن تكون :attribute مصفوفة.',
    'before' => 'يجب أن تكون :attribute تاريخًا قبل: التاريخ.',
    'before_or_equal' => 'يجب أن تكون :attribute تاريخًا قبل: التاريخ أو مساويًا له.',
    'between' => [
        'numeric' => 'يجب أن تكون :attribute بين: min و: max.',
        'file' => 'يجب أن تكون :attribute بين: min و: max كيلوبايت.',
        'string' => 'يجب أن تكون :attribute بين: min و: max من الأحرف.',
        'array' => 'يجب أن تحتوي :attribute على ما بين: min و: max items.',
    ],
    'boolean' => 'يجب أن يكون حقل :attribute صحيحًا أو خطأ.',
    'confirmed' => 'قيمة التأكيد غير متطابقة.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => ':attribute ليست تاريخًا صالحًا.',
    'date_equals' => 'يجب أن تكون :attribute تاريخ يساوي: date.',
    'date_format' => ':attribute لا تتوافق مع التنسيق: التنسيق.',
    'different' => 'يجب أن تكون :attribute و: أخرى مختلفة.',
    'digits' => 'يجب أن تكون :attribute أرقام أرقام.',
    'digits_between' => 'يجب أن تكون :attribute بين: min و: max أرقام.',
    'dimensions' => ':attribute لها أبعاد صورة غير صالحة.',
    'distinct' => 'يحتوي حقل :attribute على قيمة مكررة.',
    'email' => 'يجب أن تكون :attribute عنوان بريد إلكتروني صالح.',
    'ends_with' => 'يجب أن تنتهي: :attribute بأحد ما يلي: القيم.',
    'exists' => ':attribute المحددة غير صالحة.',
    'file' => 'يجب أن تكون :attribute ملفًا.',
    'filled' => 'يجب أن يحتوي حقل :attribute على قيمة.',
    'gt' => [
        'numeric' => 'يجب أن تكون :attribute أكبر من: القيمة.',
        'file' => 'يجب أن تكون :attribute أكبر من: القيمة كيلوبايت.',
        'string' => 'يجب أن تكون :attribute أكبر من: أحرف القيمة.',
        'array' => 'يجب أن تحتوي :attribute على أكثر من: عناصر القيمة.',
    ],
    'gte' => [
        'numeric' => 'يجب أن تكون :attribute أكبر من أو تساوي: value.',
        'file' => 'يجب أن تكون :attribute أكبر من أو تساوي: القيمة كيلوبايت.',
        'string' => 'يجب أن تكون :attribute أكبر من أو تساوي: أحرف القيمة.',
        'array' => 'يجب أن تحتوي :attribute على عناصر قيمة أو أكثر.',
    ],
    'image' => 'يجب أن تكون :attribute صورة.',
    'in' => ':attribute المحددة غير صالحة.',
    'in_array' => 'حقل :attribute غير موجود في: أخرى.',
    'integer' => 'يجب أن تكون :attribute عددًا صحيحًا.',
    'ip' => 'يجب أن تكون :attribute عنوان IP صالحًا.',
    'ipv4' => 'يجب أن تكون :attribute عنوان IPv4 صالحًا.',
    'ipv6' => 'يجب أن تكون :attribute عنوان IPv6 صالحًا.',
    'json' => 'يجب أن تكون :attribute سلسلة JSON صالحة.',
    'lt' => [
        'numeric' => 'يجب أن تكون :attribute أقل من: القيمة.',
        'file' => 'يجب أن تكون :attribute أقل من: value كيلوبايت.',
        'string' => 'يجب أن تكون :attribute أقل من: أحرف القيمة.',
        'array' => 'يجب أن تحتوي :attribute على أقل من: عناصر القيمة.',
    ],
    'lte' => [
        'numeric' => 'يجب أن تكون :attribute أقل من أو تساوي: القيمة.',
        'file' => 'يجب أن تكون :attribute أقل من أو تساوي: value كيلوبايت.',
        'string' => 'يجب أن تكون :attribute أقل من أو تساوي: أحرف القيمة.',
        'array' => 'يجب ألا تحتوي :attribute على أكثر من: عناصر القيمة.',
    ],
    'max' => [
        'numeric' => 'لا يجوز أن تكون :attribute أكبر من: max.',
        'file' => 'لا يجوز أن تكون :attribute أكبر من: أقصى كيلوبايت.',
        'string' => 'لا يجوز أن تكون :attribute أكبر من: max حرفًا.',
        'array' => 'لا يجوز أن تحتوي :attribute على أكثر من: max items.',
    ],
    'mimes' => 'يجب أن تكون :attribute ملفًا من النوع: القيم.',
    'mimetypes' => 'يجب أن تكون :attribute ملفًا من النوع: القيم.',
    'min' => [
        'numeric' => 'يجب أن تكون :attribute min.',
        'file' => 'يجب ألا تقل :attribute عن: دقيقة كيلوبايت.',
        'string' => 'يجب ألا تقل :attribute عن: min حرفًا.',
        'array' => 'يجب أن تحتوي :attribute على الأقل على: min من العناصر.',
    ],
    'multiple_of' => 'يجب أن تكون :attribute من مضاعفات: القيمة.',
    'not_in' => ':attribute المحددة: غير صالحة.',
    'not_regex' => 'تنسيق :attribute غير صالح.',
    'numeric' => 'يجب أن تكون :attribute رقمًا.',
    'password' => 'كلمة المرور غير صحيحة.',
    'present' => 'يجب أن يكون حقل :attribute موجودًا.',
    'regex' => 'تنسيق :attribute غير صالح.',
    'required' => 'حقل :attribute مطلوب.',
    'required_if' => 'يكون حقل :attribute مطلوبًا عندما: الآخر هو: القيمة.',
    'required_unless' => 'حقل :attribute مطلوب إلا إذا كان الآخر في: القيم.',
    'required_with' => 'حقل :attribute مطلوب عندما: القيم موجودة.',
    'required_with_all' => 'يكون حقل :attribute مطلوبًا عندما تكون: القيم موجودة.',
    'required_without' => 'حقل :attribute مطلوب عندما: القيم غير موجودة.',
    'required_without_all' => 'يكون حقل :attribute مطلوبًا في حالة عدم وجود أي من قيم:.',
    'prohibited' => ': حقل :attribute محظور.',
    'prohibited_if' => 'يُحظر: حقل :attribute عندما: الآخر هو: القيمة.',
    'prohibited_unless' => 'يُحظر: حقل :attribute ما لم: الآخر في: القيم.',
    'same' => 'قيمة التأكيد غير متطابقة',
    'size' => [
        'numeric' => 'يجب أن تكون :attribute الحجم.',
        'file' => 'يجب أن تكون :attribute الحجم كيلوبايت.',
        'string' => 'يجب أن تكون :attribute حجم الأحرف.',
        'array' => 'يجب أن تحتوي :attribute على عناصر الحجم.',
    ],
    'starts_with' => 'يجب أن تبدأ :attribute بأحد القيم التالية:',
    'string' => 'يجب أن تكون :attribute سلسلة.',
    'timezone' => 'يجب أن تكون :attribute منطقة صالحة.',
    'unique' => 'تم بالفعل استخدام :attribute.',
    'uploaded' => 'فشل تحميل :attribute.',
    'url' => 'تنسيق :attribute غير صالح.',
    'uuid' => 'يجب أن تكون :attribute UUID صالحًا.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'رسالة مخصصة',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
