<?php

namespace App\Http\Controllers;

use App\Currency;

trait CurrencyConversion
{

    public function convertCurrencyToUSD($currency_iso, $price)
    {
        $currency = Currency::where('iso', $currency_iso)->first();
        if (!$currency) return -1;

        return $price / $currency->value; // e.g. 3.28 PEN / 3.28 = 1 USD
    }

    public function convertUSDToCurrency($currency_iso, $price)
    {
        $currency = Currency::where('iso', $currency_iso)->first();
        if (!$currency) return -1;

        return $price * $currency->value; // e.g. 1 USD * 3.28 = 3.28 PEN
    }

}