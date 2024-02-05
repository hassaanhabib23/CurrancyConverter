<?php
$currencies = array(
  (object) [
    'currency_code' => 'PKR',
    'country' => 'Pakistan',
    'currency_rate' => 279.65
  ],
  (object) [
    'currency_code' => 'INR',
    'country' => 'India',
    'currency_rate' => 83.00

  ],
  (object) [
    'currency_code' => 'BDT',
    'country' => 'Bangladesh',
    'currency_rate' => 109.77
  ],
  (object) [
    'currency_code' => 'USD',
    'country' => 'Dollar',
    'currency_rate' => 1.0
  ]
);
function printCurrencyOptions()
{
  global $currencies;
  foreach ($currencies as $currency) {
    // "{$currency->currency_code} - {$currency->country}"
    // echo '<option value="'.$currency->currency_code.'">'.$currency->currency_code.' - '.$currency->country.'</option>';
    echo "<option value='{$currency->currency_code}'>{$currency->currency_code} - {$currency->country}</option>";
  }
}
