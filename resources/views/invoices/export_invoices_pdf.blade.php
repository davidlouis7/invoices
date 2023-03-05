<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="icon" href="{{ asset('web/media/logos/favicon.ico') }}" type="image/png">
    <title>{{ getLogInUser()->hasRole('client') ? 'Client' : '' }} {{__('Invoices PDF')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <!-- General CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/invoice-pdf.css') }}" rel="stylesheet" type="text/css"/>
    <style>
        .custom-font-size-pdf {
            font-size: 10px !important;
        }

        .table thead th {
            font-size: 11px !important;
        }
    </style>
</head>
<body>
<div class="d-flex align-items-center justify-content-center mb-4">
    <h4 class="text-center">{{ getLogInUser()->hasRole('client') ? 'Client' : '' }} {{__('Invoices Export Data')}}</h4>
</div>
<table class="table table-bordered border-primary">
    <thead>
    <tr>
        <th style="width: 3%"><b>{{__('Invoice ID')}}</b></th>
        <th style="word-break: break-all;width: 10%"><b>{{__('Client Name')}}</b></th>
        <th style="width: 12%"><b>{{__('Invoice Date')}}</b></th>
        <th style="width: 15%"><b>{{__('Invoice Amount')}}</b></th>
        <th style="width: 17%"><b>{{__('Paid Amount')}}</b></th>
        <th style="width: 18%"><b>{{__('Due Amount')}}</b></th>
        <th style="white-space: nowrap;width: 20%"><b>{{__('Due Date')}}</b></th>
        <th style="width: 6%"><b>{{__('Status')}}</b></th>
    </tr>
    </thead>
    <tbody>
    @if(count($invoices) > 0)
        @foreach($invoices as $invoice)
            <tr class="custom-font-size-pdf">
                <td>{{ $invoice->invoice_id }}</td>
                <td>{{ $invoice->client->user->FullName }}</td>
                <td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->translatedFormat(currentDateFormat()) }}</td>
                <td>{{ getInvoiceCurrencyAmount($invoice->final_amount, $invoice->currency_id, true) }}</td>
                <td>{{ (getInvoicePaidAmount($invoice->id) != 0) ? getInvoiceCurrencyAmount(getInvoicePaidAmount($invoice->id), $invoice->currency_id, true) : '0.00' }}</td>
                <td>{{ (getInvoiceDueAmount($invoice->id) != 0 ) ? getInvoiceCurrencyAmount(getInvoiceDueAmount($invoice->id), $invoice->currency_id, true) : '0.00' }}</td>
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
            </tr>
        @endforeach
    @else
        <tr>
            <td class="text-center" colspan="8"></td>
        </tr>
    @endif
    </tbody>
</table>
</body>
</html>
