<?php
$currencies = array(
  (object) [
    'currency_code' => 'PKR',
    'country' => 'Pakistan',
    'currency_rate'=> 280
  ],
  (object) [
    'currency_code' => 'INR',
    'country' => 'India'
  ],
  (object) [
    'currency_code' => 'BDT',
    'country' => 'Bangladesh'
  ],
  (object) [
    'currency_code' => 'US',
    'country' => 'Dollar',
    'currency_rate'=> 0.8
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
