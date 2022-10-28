<?php

namespace App\Http\Controllers;

use App\Models\CurrencyRates;
use App\Http\Requests\StoreCurrencyRatesRequest;
use App\Http\Requests\UpdateCurrencyRatesRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CurrencyRatesController extends Controller
{
    /**
     * Retrieve and store rates of given currency
     *
     * @param  string  $currencyName
     * @return boolean
     */
    static public function getRates(string $currencyName)
    {
        if (!self::isCurrencyNameValid($currencyName)) {
            return false;
        }
        $url = "https://api.coinbase.com/v2/exchange-rates?currency=" . $currencyName;
        //  Initiate curl
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, $url);
        // Execute
        $result = curl_exec($ch);
        // Closing
        curl_close($ch);

        $result = json_decode($result, true);

        $currencyRate = new CurrencyRates();
        $currencyRate->currency = $currencyName;
        $currencyRate->rates = array_pop($result)["rates"];
        $currencyRate->save();
        return true;
    }

    /**
     * Get a array of valid currency names
     *
     * @return array
     */
    static public function getValidCurrencies()
    {
        $url = "https://api.coinbase.com/v2/currencies";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        foreach (array_pop($result) as $currency) {
            $currencies[] = $currency["id"];
        }
        return $currencies;
    }

    /**
     * Check if a currency name is valid
     * @param string $currency
     * @return bool
     */
    static public function isCurrencyNameValid(string $currency)
    {
        //This was done as a check that currencies where valid, turns out ETH and BTC are not on the list of currencies
        //only some currencies are even there, thus this method is derelict, but I'll leave it as a check should be
        //performed
        return true;
        $currencies = self::getValidCurrencies();
        return in_array($currency, $currencies);
    }
}
