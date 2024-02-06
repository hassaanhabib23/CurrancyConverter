<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="loginStyle.css">
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "registration_db";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT email,passwords FROM registration_detail";
    $data = $conn->query($sql);
    $userdetails = array();
    if ($data->num_rows > 0) {
        while ($rows = mysqli_fetch_assoc($data)) {
            array_push($userdetails, $rows);
        }
    }
    $conn->close();
    $email = "";
    $password = "";
    echo $_SERVER["REQUEST_METHOD"];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['emailfield'];
        $password = $_POST['passfield'];
        if (empty($email) && empty($password)) {
            $prompt = "Enter Email and Password";
        } else if (empty($email)) {
            $prompt = "Enter Email first";
        } else if (empty($password)) {
            $prompt = "Enter Password first";
        } else {
            foreach ($userdetails as $value) {
                if ($email == $value['email'] && $password == $value['passwords']) {
                    $prompt = "Login Successfully";
                } else {
                    $prompt = "Email or password incorrect";
                }
            }
        }
    }
    ?>
    <div class="container">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2 class="loginheading">Sign In Form</h2>
            <h3 style="color: red"><?php if (isset($prompt)) {
                                        echo $prompt;
                                    } ?></h3>
            <input type="email" name="emailfield" placeholder="Email" class="fieldStyling" autocomplete="off" value="<?php echo $email ?>"><br><br>
            <input type="password" name="passfield" placeholder="Password" class="fieldStyling" value="<?php echo $password ?>"><br><br>
            <button class="buttonStyling" name="btnlogin"><strong>Login</strong></button><br><br>
            <p style="display:inline;">Not a member?</p>
            <a href="http://localhost/CurrencyConverter/signupForm.php">SignUp now</a>
        </form>
    </div>
</body>

</html>