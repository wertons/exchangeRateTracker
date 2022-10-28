<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Weekly Currency Rates</title>
    </head>
    <body >
        @foreach ($weeklyRates as $rate)
            <div>Currency: {{$rate->currency}}</div>
            <div>Taken at: {{$rate->created_at}}</div>
            @foreach ($rate->rates as $curr => $exchange)
                {{$curr}} at {{$exchange}}
            @endforeach
            <br>
        @endforeach
    </body>
</html>
