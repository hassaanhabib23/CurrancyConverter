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
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "currencies_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT currency_id, currency_code,country_name  FROM currencies";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
    } else {
        echo "0 results";
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
            $fromrate;
            $torate;
            foreach ($currencies as $currency) {
                if ($fromCountry == $currency->currency_code) {
                    $fromrate = $currency->currency_rate;
                    break;
                }
            }
            foreach ($currencies as $currency1) {
                if ($toCountry == $currency1->currency_code) {
                    $torate = $currency1->currency_rate;
                    break;
                }
            }
            $results = $enteredAmount * ($torate / $fromrate);
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
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <option <?php echo $fromCountry ==  $row["currency_code"]  ? "selected" : ""; ?> value="<?php echo  $row["currency_code"] ?>">
                        <?php echo $row["currency_code"] ?> - <?php echo $row["country_name"] ?>
                    </option>
                <?php } ?>
            </select>
            <label for="toCountry" class="labels"><strong>To</strong></label>
            <select name="toCountry" class="selectStyling">
                <option value="" hidden>Select Country</option>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <option <?php echo $toCountry ==  $row["currency_code"]  ? "selected" : ""; ?> value="<?php echo  $row["currency_code"] ?>">
                        <?php echo $row["currency_code"] ?> - <?php echo $row["country_name"] ?>
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