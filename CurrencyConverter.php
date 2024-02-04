<?php include "app_constants.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
    <link rel="stylesheet" href="CurrencyConverter.css">
</head>
<body>
    <div class="container">
        <u id="firstlabel">
            Currency Converter
        </u><br>
        <strong class="labelforamount">Enter Amount:</strong>
        <input type="text" name="amount" id="amountfield" placeholder="0.00"><br><br>
        <label for="fromCountry" class="labels"><strong>From</strong></label>
        <select name="fromCountry" class="selectStyling">
            <?php foreach ($currencies as $currency) { ?>
                <option value="<?php echo $currency->currency_code ?>" placeholder="sdfdsgfd">
                    <?php echo $currency->currency_code ?> - <?php echo $currency->country ?>
                </option>
            <?php } ?>
        </select>
        <label for="toCountry" class="labels"><strong>To</strong></label>
        <select name="toCountry" class="selectStyling">
        <?php foreach ($currencies as $currency) { ?>
                <option value="<?php echo $currency->currency_code ?>">
                    <?php echo $currency->currency_code ?> - <?php echo $currency->country ?>
                </option>
            <?php } ?>
        </select><br><br><br>
        <div class="buttonStyling2">
        <button name="btnsubmit" class="buttonStyling">Convert</button>
        <button name="btnreset" class="buttonStyling">Reset</button>
        </div>
        
    </div>
</body>

</html>