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
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="container">
        <u id="firstlabel">
            Currency Converter
        </u><br>
        <strong class="labelforamount">Enter Amount:</strong>
        <input type="text" name="amount" id="amountfield" placeholder="0.00"><br><br>
        <label for="fromCountry" class="labels"><strong>From</strong></label>
        <select name="fromCountry" class="selectStyling" required>
            <?php foreach ($currencies as $currency) { ?>
                <option value="none" selected disabled hidden>Select Country</option> 
                <option value="<?php echo $currency->currency_code ?>">
                    <?php echo $currency->currency_code ?> - <?php echo $currency->country ?>
                </option>
            <?php } ?>
        </select  >
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
    <?php 
    
    if(isset($_REQUEST['btnsubmit'])){
        $enteredAmount=$_POST["amount"];
        if(empty($enteredAmount)){
            echo "field is empty";
        }
        
        else if (is_numeric($enteredAmount)){
            
        }
        else {
           echo $enteredAmount;
        }
    }
    ?>
</body>

</html>