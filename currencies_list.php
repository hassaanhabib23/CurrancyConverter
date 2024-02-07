<!DOCTYPE html>
<?php session_start() ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="currencies_list.css">
    <title>Currencies_list</title>
</head>

<body>
    <?php
    if (isset($_POST['logout'])) {
        echo "nghjnm";
        header("Location:http://localhost/CurrencyConverter/login.php");
        session_destroy();
        // header("Locat")
    }
    $server_name = "localhost";
    $user_name = "root";
    $password = "";
    $database_name = "currencies_db";
    $conn = new mysqli($server_name, $user_name, $password, $database_name);
    $sql = "SELECT * FROM currencies";
    $data = $conn->query($sql);
    $currencies_list = array();
    if ($data->num_rows > 0) {
        while ($output = mysqli_fetch_assoc($data)) {
            array_push($currencies_list, $output);
        }
    }
    ?>
    <form action="" method="post">
        <div class="headstyling">
            <span style="font-size: 18px;">loged with <span style="font-weight: bold; font-size:20px; padding-right:40px"><?php echo $_SESSION['username']; ?></span></span>
            <button name="logout" class="btnlogout"> logout</button>
        </div>
        <div class="container">
            <h3 style="margin-left: 179px; font-size: 52px">Currencies Detail</h3>
            <table style="width: 150%; height: 300px;">
                <tr>
                    <th>Id</th>
                    <th>Currency Code</th>
                    <th>Country Name</th>
                </tr>
                <?php foreach ($currencies_list as $input) { ?>
                    <tr>
                        <td><?php echo $input['currency_id'] ?></td>
                        <td><?php echo $input['currency_code'] ?></td>
                        <td><?php echo $input['country_name'] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </form>
</body>

</html>