<?php
$currencies = array(
  (object)[
    'currency_code' => 'Select',
    'country' => 'Country'
  ],
  (object) [
    'currency_code' => 'PKR',
    'country' => 'Pakistan'
  ],
  (object) [
    'currency_code' => 'INR',
    'country' => 'India'
  ],
  (object) [
    'currency_code' => 'BDT',
    'country' => 'Bangladesh'
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
