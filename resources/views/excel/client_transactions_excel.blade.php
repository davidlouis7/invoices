<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('Client Transaction Excel')}}</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th style="width: 170%"><b>{{__('Payment Date')}}</b></th>
        <th style="width: 170%"><b>{{__('Invoice ID')}}</b></th>
        <th style="width: 180%"><b>{{__('Payment Amount')}}</b></th>
        <th style="width: 160%"><b>{{__('Payment Mode')}}</b></th>
        <th style="width: 160%"><b>{{__('Payment Status')}}</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td>{{ \Carbon\Carbon::parse($transaction->payment_date)->translatedFormat(currentDateFormat())  }}</td>
            <td>{{ $transaction->invoice->invoice_id }}</td>
            <td>{{ $transaction->amount }}</td>
            @if($transaction->payment_mode == \App\Models\Payment::MANUAL)
                <td> {{__('Manual')}}</td>
            @elseif($transaction->payment_mode == \App\Models\Payment::STRIPE)
                <td> {{__('Stripe')}}</td>
            @elseif($transaction->payment_mode == \App\Models\Payment::PAYPAL)
                <td> {{__('Paypal')}}</td>
            @elseif($transaction->payment_mode == \App\Models\Payment::RAZORPAY)
                <td> {{__('Razorpay')}}</td>
            @elseif($transaction->payment_mode == \App\Models\Payment::CASH)
                <td> {{__('Cash')}}</td>
            @endif
            @if($transaction->is_approved == \App\Models\Payment::APPROVED && $transaction->payment_mode == 1)
                <td>{{\App\Models\Payment::PAID}}</td>
            @elseif($transaction->is_approved == \App\Models\Payment::PENDING && $transaction->payment_mode == 1)
                <td>{{\App\Models\Payment::PROCESSING}}</td>
            @elseif($transaction->is_approved == \App\Models\Payment::REJECTED && $transaction->payment_mode == 1)
                <td>{{\App\Models\Payment::DENIED}}</td>
            @else
                <td>{{\App\Models\Payment::PAID}}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
