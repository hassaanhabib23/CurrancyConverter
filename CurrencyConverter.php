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
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "currencies_db";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT currency_id, currency_code,country_name  FROM currencies";
    $result = $conn->query($sql);
    $currencies = array();
    if ($result->num_rows > 0) {
        while ($rows = mysqli_fetch_object($result)) {
            array_push($currencies, $rows);
        }
    }
    $conn->close();
    $enteredAmount = '';
    $fromCountry = '';
    $toCountry = '';
    if (isset($_REQUEST['btnsubmit'])) {
        $fromCountry = $_POST["fromCountry"];
        $toCountry = $_POST["toCountry"];
        $enteredAmount = $_POST["amount"];
        if (empty($enteredAmount) && empty($fromCountry) && empty($toCountry)) {
            $prompt = "Fields are Empty";
        } else if (empty($enteredAmount)) {
            $prompt = "Enter amount first";
        } else if (!is_numeric($enteredAmount)) {
            $prompt = "Field accept only Integer";
        } else if (empty($fromCountry)) {
            $prompt = "Please select Country first (From dropdown)";
        } else if (empty($toCountry)) {
            $prompt = "Please select Country first (To dropdown)";
        } else if ($fromCountry == $toCountry) {
            $prompt = "Countries cannot same";
        } else {
            $url = "https://wise.com/rates/history+live?source=$fromCountry&target=$toCountry&length=1";
            $reponse = file_get_contents($url);
            $rates = json_decode($reponse, true);
            foreach ($rates as $element) {
                $rate = $element['value'];
            }
            $results = $enteredAmount * $rate;
        }
    }
    ?>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="container">
            <u id="firstlabel">
                Currency Converter
            </u><br>
            <strong class="labelforamount">Enter Amount:</strong>
            <input type="number" name="amount" value="<?php echo $enteredAmount; ?>" autocomplete="off" id="amountfield" placeholder="0.00" min=0><br><br>
            <label for="fromCountry" class="labels"><strong>From</strong></label>
            <select name="fromCountry" class="selectStyling">
                <option value="" hidden>Select Country</option>
                <?php foreach ($currencies as $currency) { ?>
                    <option <?php echo $fromCountry == $currency->currency_code ? "selected" : ""; ?> value="<?php echo $currency->currency_code ?>">
                        <?php echo $currency->currency_code ?> - <?php echo $currency->country_name ?>
                    </option>
                <?php } ?>
            </select>
            <label for="toCountry" class="labels"><strong>To</strong></label>
            <select name="toCountry" class="selectStyling">
                <option value="" hidden>Select Country</option>
                <?php foreach ($currencies as $currency) { ?>
                    <option <?php echo $toCountry == $currency->currency_code ? "selected" : ""; ?> value="<?php echo $currency->currency_code ?>">
                        <?php echo $currency->currency_code ?> - <?php echo $currency->country_name ?>
                    </option>
                <?php } ?>
            </select>
            <p style="color: red; font-size: 20px;"><?php
                                                    if (isset($prompt)) {
                                                        echo $prompt;
                                                    }
                                                    ?></p>
            <div class="buttonStyling2">
                <button name="btnsubmit" class="buttonStyling">Convert</button>
                <button name="btnreset" class="buttonStyling">Reset</button>
            </div>
            <p style="font-size: 25px;"><?php if (isset($results)) { ?>
                    <strong><?php echo "Amount is : " . $results; ?></strong>
                <?php } ?>
            </p>
        </div>
    </form>
</body>
</html>