<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('Payment Excel')}}</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th style="width: 170%"><b>{{__('Payment Date')}}</b></th>
        <th style="width: 170%"><b>{{__('Invoice ID')}}</b></th>
        <th style="width: 180%"><b>{{__('Client Name')}}</b></th>
        <th style="width: 180%"><b>{{__('Payment Amount')}}</b></th>
        <th style="width: 150%"><b>{{__('Payment Mode')}}</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($adminPayments as $payment)
        <tr>
            <td>{{ Carbon\Carbon::parse($payment->payment_date)->format(currentDateFormat()) }}</td>
            <td>{{ $payment->invoice->invoice_id }}</td>
            <td>{{ $payment->invoice->client->user->full_name }}</td>
            <td>{{ $payment->amount }}</td>
            @if($payment->payment_mode == \App\Models\Payment::CASH)
                <td> {{__('Cash')}} </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
