<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transactions Excel</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th style="width: 170%"><b>Transaction ID</b></th>
        <th style="width: 170%"><b>Payment Date</b></th>
        <th style="width: 170%"><b>Invoice ID</b></th>
        <th style="width: 180%"><b>Client Name</b></th>
        <th style="width: 180%"><b>Payment Amount</b></th>
        <th style="width: 160%"><b>Payment Mode</b></th>
        <th style="width: 160%"><b>Payment Status</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($payments as $payment)
        <tr>
            <td>{{ $payment->transaction_id }}</td>
            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->translatedFormat(currentDateFormat()) }}</td>
            <td>{{ $payment->invoice->invoice_id }}</td>
            <td>{{ $payment->invoice->client->user->full_name }}</td>
            <td>{{ $payment->amount }}</td>
            @if($payment->payment_mode == \App\Models\Payment::MANUAL)
                <td> Manual</td>
            @elseif($payment->payment_mode == \App\Models\Payment::STRIPE)
                <td> Stripe</td>
            @elseif($payment->payment_mode == \App\Models\Payment::PAYPAL)
                <td> Paypal</td>
            @elseif($payment->payment_mode == \App\Models\Payment::RAZORPAY)
                <td> Razorpay</td>
            @elseif($payment->payment_mode == \App\Models\Payment::CASH)
                <td> Cash</td>
            @endif
            @if($payment->is_approved == \App\Models\Payment::APPROVED && $payment->payment_mode == 1)
                <td>{{\App\Models\Payment::PAID}}</td>
            @elseif($payment->is_approved == \App\Models\Payment::PENDING && $payment->payment_mode == 1)
                <td>{{\App\Models\Payment::PROCESSING}}</td>
            @elseif($payment->is_approved == \App\Models\Payment::REJECTED && $payment->payment_mode == 1)
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
