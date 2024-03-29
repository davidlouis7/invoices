<!DOCTYPE html>
<html>

<head>
    <title>عرض سعر</title>
    <style>
        body {
            font-family: 'almarai';
            direction: rtl;
            font-size: 27px;
        }

        .invoice-number {
            font-family: sans-serif;
            position: absolute;
            top: 68mm;
            right: 57mm;
            width: 38mm;
            text-align: center;
            color: #FFF;
        }

        .invoice-date {
            position: absolute;
            top: 67mm;
            right: 146.5mm;
            width: 51mm;
            text-align: center;
            color: #FFF;
            font-size: 17px;
        }

        p {
            font-family: sans-serif;
            padding: 0;
            margin: 0;
        }

        .client-name {
            position: absolute;
            top: 88.8mm;
            right: 58mm;
            width: 140mm;
            text-align: center;
            color: #FFF;
            font-size: 22px;
        }

        .table-top {
            position: absolute;
            top: 126mm;
            right: 0;
            width: 210mm;
            height: 5mm;
            background: url("{{ asset('/templates/top.png') }}") top center no-repeat;
            background-size: 100% 100%;
        }

        .table-bottom {
            position: absolute;
            right: 0;
            width: 210mm;
            height: 5mm;
            background: url("{{ asset('/templates/bottom.png') }}") top center no-repeat;
            background-size: 100% 100%;
        }

        .row-odd {
            position: absolute;
            right: 0;
            width: 210mm;
            height: 8mm;
            background: url("{{ asset('/templates/odd.png') }}") top center no-repeat;
            background-size: 100% 100%;
        }

        .row-even {
            position: absolute;
            right: 0;
            width: 210mm;
            height: 8mm;
            background: url("{{ asset('/templates/even.png') }}") top center no-repeat;
            background-size: 100% 100%;
        }

        .index {
            position: absolute;
            right: 45px;
            width: 14.5mm;
            height: 8mm;
            font-size: 17px;
            text-align: center;
            font-family: sans-serif;
        }

        .desc {
            position: absolute;
            right: 35mm;
            width: 74mm;
            height: 8mm;
            font-size: 17px;
        }

        .price {
            position: absolute;
            right: 114mm;
            width: 24mm;
            text-align: center;
            height: 8mm;
            font-size: 18px;
            font-family: sans-serif;
        }

        .count {
            position: absolute;
            right: 140.1mm;
            width: 29mm;
            text-align: center;
            height: 8mm;
            font-size: 18px;
            font-family: sans-serif;
        }

        .total {
            position: absolute;
            right: 170.8mm;
            width: 26.5mm;
            text-align: center;
            height: 8mm;
            font-size: 18px;
            font-family: sans-serif;
        }
        .table-total {
            position: absolute;
            right: 0;
            width: 210mm;
            height: 10mm;
            background: url("{{ asset('/templates/total.png') }}") top center no-repeat;
            background-size: 100% 100%;
        }
        .total-num-written {
            font-size: 17px;
            font-weight: bold;
            position: absolute;
            right: 13mm;
            width: 156mm;
            text-align: center
        }
        .total-num {
            font-size: 17px;
            font-weight: bold;
            position: absolute;
            right: 170mm;
            width: 28mm;
            text-align: center
        }

        .notes {
            font-size: 14px;
            position: absolute;
            width: 100mm;
            text-align: right;
            top: 235mm;
            right: 13.5mm;
            line-height: 5.6mm;
        }
    </style>
</head>

<body>
    <div style="position: absolute; left:0; right: 0; top: 0; bottom: 0;">
        <img src="{{ asset('/templates/quote.jpg') }}" style="width: 210mm; height: 297mm; margin: 0;">
    </div>

    <!-- Invoice Number -->
    <div class="invoice-number">{{ $quote->quote_id }}</div>

    <!-- Invoice Date -->
    <div class="invoice-date">
        <p>{{ \Alkoumi\LaravelHijriDate\Hijri::Date('Y-m-d', $quote->quote_date) }} <span>هـ</span></p>
        <p>{{ \Carbon\Carbon::parse($quote->quote_date)->translatedFormat(currentDateFormat()) }} <span>م</span></p>
    </div>

    <!-- Client name -->
    <div class="client-name">{{ $quote->client->user->full_name }}</div>


    <!-- Items Table -->
    <div class="table-top"></div>
    @foreach ($quote->quoteItems as $i => $quoteItem)
        <!-- Quote item -->
        @if (($i+1) % 2)
            <div class="row-odd" style="top: {{ strval(123.5 + (($i+1) * 7.5)) }}mm;"></div>
        @else
            <div class="row-even" style="top: {{ strval(123.5 + ((($i+1) * 7.5))) }}mm;"></div>
        @endif
        <div class="index" style="top: {{ strval(124.5 + (($i+1) * 7.5)) }}mm;">{{ ($i+1) }}
        </div>
        <div class="desc" style="top: {{ strval(124.5 + (($i+1) * 7.5)) }}mm;">{{isset($quoteItem->product->name)?$quoteItem->product->name:$quoteItem->product_name??'N/A'}}</div>
        <div class="price" style="top: {{ strval(124.5 + (($i+1) * 7.5)) }}mm;">{{isset($quoteItem->price) ? $quoteItem->price : 'N/A'}}</div>
        <div class="count" style="top: {{ strval(124.5 + (($i+1) * 7.5)) }}mm;">{{$quoteItem->quantity}}</div>
        <div class="total" style="top: {{ strval(124.5 + (($i+1) * 7.5)) }}mm;">{{$quoteItem->price * $quoteItem->quantity}}</div>
        @if (($i+1) == count($quote->quoteItems))
            <div class="table-bottom" style="top: {{ strval(131 + (($i+1) * 7.5)) }}mm;"></div>

            <div class="table-total" style="top: {{ strval(138 + (($i+1) * 7.5)) }}mm;"></div>
            <div class="total-num-written" style="font-weight: light; top: {{ strval(140 + (($i+1) * 7.5)) }}mm;">ضريبة القيمة المضافة</div>
            <div class="total-num" style="font-weight: light; top: {{ strval(140 + (($i+1) * 7.5)) }}mm;">
            {{ $quote->quoteItems->reduce(function($carry, $item) {
                $taxes = 0;
                foreach ($item->quoteItemTax as $quoteItemTax) {
                    $taxes += ($item->quantity * (($quoteItemTax->tax / 100) * $item->price));
                }
                return $carry + $taxes;
            }, 0) }}
            </div>

            <div class="table-total" style="top: {{ strval(150 + (($i+1) * 7.5)) }}mm;"></div>
            <div class="total-num-written" style="top: {{ strval(152 + (($i+1) * 7.5)) }}mm;">{{\Alkoumi\LaravelArabicNumbers\Numbers::TafqeetMoney($quote->final_amount)}}</div>
            <div class="total-num" style="top: {{ strval(152 + (($i+1) * 7.5)) }}mm;">{{$quote->final_amount}}</div>

            @endif
            @endforeach
    <div class="notes">
        {!! nl2br($quote->note) !!}
    </div>

    <!-- The rest will margin top a calculated space and be a relative positioning -->


</body>

</html>
