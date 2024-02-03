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
        <label id="firstlabel">
            <h2>Currency Converter</h2>
        </label><br>
        <label for="fromCountry" class="labels"><strong>From</strong></label>
        <select name="fromCountry" class="selectStyling">
            <option value="pakistan">Pakistan</option>
            <option value="indian">India</option>
            <option value="bangladesh">Bangladesh</option>
            <option value="saudia">Saudia</option>
            <option value="USdollar">US Dollar</option>
        </select>
        <label for="toCountry" class="labels"><strong>To</strong></label>
        <select name="toCountry" class="selectStyling">
            <option value="pakistan">Pakistan</option>
            <option value="indian">India</option>
            <option value="bangladesh">Bangladesh</option>
            <option value="saudia">Saudia</option>
            <option value="USdollar">US Dollar</option>
        </select><br><br><br>
        <strong class="labels">Enter Amount:</strong>
        <input type="text" name="amount" id="amountfield"><br><br>
        <input type="submit" name="btnsubmit" id="k">
    </div>
</body>

</html>