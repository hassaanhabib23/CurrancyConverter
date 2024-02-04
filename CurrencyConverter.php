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
<?php 
    $enteredAmount='';
    $fromCountry='';

    if(isset($_REQUEST['btnsubmit'])){
        $enteredAmount=$_POST["amount"];
        if(!empty($enteredAmount)){
            if (is_numeric($enteredAmount)){
                $fromCountry=$_POST["fromCountry"];
                $toCountry=$_POST["toCountry"];
                global $fromrate;
                global $torate;
                foreach ($currencies as $currency) {
                    if ($fromCountry==$currency->currency_code){
                    $fromrate=$currency->currency_rate;
                    break;
                }
            }
                foreach ($currencies as $currency1) {
                    if ($toCountry==$currency1->currency_code){
                    $torate=$currency1->currency_rate;
                    break;
                }
            }
            $result=$enteredAmount*($torate/$fromrate);    
        }
     }
 }
    ?>
    <p><?php if(isset($result)){
        echo $result;
    }
    ?></p>
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="container">
        <u id="firstlabel">
            Currency Converter
        </u><br>
        <strong class="labelforamount">Enter Amount:</strong>
        <input type="text" name="amount"value="<?php echo $enteredAmount;?>" id="amountfield" placeholder="0.00"><br><br>
        <label for="fromCountry" class="labels"><strong>From</strong></label>
        <select name="fromCountry" class="selectStyling" required>
            <?php foreach ($currencies as $currency) { ?>
                <option value="none" selected disabled hidden>Select Country</option> 
                <option value="<?php echo $currency->currency_code ?>">
                    <?php echo $currency->currency_code ?> - <?php echo $currency->country ?>
                </option>
            <?php } ?>
        </select>
        <label for="toCountry" class="labels"><strong>To</strong></label>
        <select name="toCountry" class="selectStyling" required>
        <?php foreach ($currencies as $currency) { ?>
            <option value="none" selected disabled hidden>Select Country</option> 
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
    </form> 
</body>

</html>