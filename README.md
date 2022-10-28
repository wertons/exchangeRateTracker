**Exchange Rate Tracker**
A very simple currency rate tracker utilizing Laravel and MySQL pulling from CoinBase's API.

Data is simply pulled with a GET Curl request from `CurrencyRatesController.php`

And a endpoint exists to check whether a certain currency name exists within those give by the validCurrencies results but it can give false negatives as some names are not listed there at `api//isCurrencyValid/{currencyName}`

In order to have the schedule working use the following CRON config:
`*  *  *  *  * cd /path-to-installation && php artisan schedule:run >> /dev/null 2>&1`

You can get a list(albeit not complete) of currencies to query with `api/validCurrencies`

In order to query the currencies use the endpoint `api/snapshot/{currencyName}` or wait for the scheduled query to run.
To add a new currency to the scheduled tracking simply add the query to `app/Console/Kernel.php` inside the schedule method


[CoinBase's API](https://docs.cloud.coinbase.com/sign-in-with-coinbase/docs/api-exchange-rates)
[Laravel](https://laravel.com/)
[CRON](https://crontab.guru/)
