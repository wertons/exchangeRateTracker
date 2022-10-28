<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Weekly Currency Rates</title>
</head>

<body>
    @foreach ($weeklyRates as $rate)
        <div style="font-size: 2em">
            <div>Currency: {{ $rate->currency }}</div>
            <div>Taken at: {{ $rate->created_at }}</div>
        </div>
        @php
           $counter = 0;
        @endphp
        <div id="rateContainers" style="display:flex;flex-wrap:wrap">
        @foreach ($rate->rates as $curr => $exchange)
            @if ($counter % 8 == 0)
                <br>
            @endif
            <span style="border:1px solid black;margin:5px;padding:1px;min-width:200px"><strong>{{ $curr }}</strong> at {{ round($exchange, 5) }}</span>
            @php
                $counter ++;
            @endphp
        @endforeach
        </div>
        <br>
    @endforeach
</body>

</html>
