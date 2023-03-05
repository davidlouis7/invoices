<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('Client Quote Excel')}}</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th style="width: 200%"><b>{{__('Quote ID')}}</b></th>
        <th style="width: 150%"><b>{{__('Quote Date')}}</b></th>
        <th style="width: 170%"><b>{{__('Amount')}}</b></th>
        <th style="width: 150%"><b>{{__('Due Date')}}</b></th>
        <th style="width: 150%"><b>{{__('Status')}}</b></th>
        <th style="width: 500%"><b>{{__('Address')}}</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($quotes as $quote)
        <tr>
            <td>{{ $quote->quote_id }}</td>
            <td>{{ \Carbon\Carbon::parse($quote->quote_date)->translatedFormat(currentDateFormat()) }}</td>
            <td>{{ getCurrencyAmount($quote->final_amount, true) }}</td>
            <td>{{ \Carbon\Carbon::parse($quote->due_date)->translatedFormat(currentDateFormat()) }}</td>
            @if($quote->status == \App\Models\Quote::DRAFT)
                <td> {{__('Draft')}}</td>
            @elseif($quote->status == \App\Models\Quote::CONVERTED)
                <td> {{__('Converted')}}</td>
            @endif
            <td>{{ $quote->client->address ?? 'N/A' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
