<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('Invoice Excel')}}</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th style="width: 200%"><b>{{__('Invoice ID')}}</b></th>
        <th style="width: 200%"><b>{{__('Client Name')}}}}</b></th>
        <th style="width: 300%"><b>{{__('Client Email')}}}}</b></th>
        <th style="width: 150%"><b>{{__('Invoice Date')}}}}</b></th>
        <th style="width: 170%"><b>{{__('Invoice Amount')}}}}</b></th>
        <th style="width: 150%"><b>{{__('Paid Amount')}}}}</b></th>
        <th style="width: 150%"><b>{{__('Due Amount')}}}}</b></th>
        <th style="width: 150%"><b>{{__('Due Date')}}}}</b></th>
        <th style="width: 150%"><b>{{__('Status')}}}}</b></th>
        <th style="width: 500%"><b>{{__('Address')}}}}</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->invoice_id }}</td>
            <td>{{ $invoice->client->user->FullName }}</td>
            <td>{{ $invoice->client->user->email }}</td>
            <td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->translatedFormat(currentDateFormat()) }}</td>
            <td>{{ $invoice->final_amount }}</td>
            <td>{{ (getInvoicePaidAmount($invoice->id) != 0) ? getInvoicePaidAmount($invoice->id) : 0 }}</td>
            <td>{{ (getInvoiceDueAmount($invoice->id) != 0 ) ? getInvoiceDueAmount($invoice->id) : 0 }}</td>
            <td>{{ \Carbon\Carbon::parse($invoice->due_date)->translatedFormat(currentDateFormat()) }}</td>
            @if($invoice->status == \App\Models\Invoice::DRAFT)
                <td> {{__('Draft')}}</td>
            @elseif($invoice->status == \App\Models\Invoice::UNPAID)
                <td> {{__('Unpaid')}}</td>
            @elseif($invoice->status == \App\Models\Invoice::PAID)
                <td> {{__('Paid')}}</td>
            @elseif($invoice->status == \App\Models\Invoice::PARTIALLY)
                <td> {{__('Partially Paid')}}</td>
            @elseif($invoice->status == \App\Models\Invoice::OVERDUE)
                <td> {{__('Overdue')}}</td>
            @elseif($invoice->status == \App\Models\Invoice::PROCESSING)
                <td> {{__('Processing')}}</td>
            @endif
            <td>{{ $invoice->client->address ?? 'N/A' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
