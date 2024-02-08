<?php include('app_constants.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login Form </title>
    <link rel="stylesheet" href="login_style.css">
</head>

<body>
    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "currencies_db";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $email = "";
    $password = "";
    $login_errors = array();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['emails'];
        $password = $_POST['passwords'];

        $is_valid = true;
        if (!empty($email)) {
            if (strpos($email, ".") == false && strpos($email, "@") == false) {
                $is_valid = false;
                array_push($login_errors, "Invalid Email");
            }
        }
        if (empty($email)) {
            $is_valid = false;
            array_push($login_errors, "Enter Email first");
        }
        if (empty($password)) {
            $is_valid = false;
            array_push($login_errors, "Enter Password first");
        }

        if ($is_valid == true) {
            $sql = "SELECT * FROM registration_detail WHERE  email='$email'AND passwords='$password'";
            $data = $conn->query($sql);
            if ($data->num_rows == 1) {
                array_push($login_errors, "Login Successfully");
                session_start();
                $_SESSION['username'] = $email;
                $_SESSION['login_time_stamp'] = time();
                // echo $_SESSION['login_time_stamp'];
                header("Location:$base_url/currencies_list.php");
            } else {
                array_push($login_errors, "Email or password incorrect");
            }
            $conn->close();
        }
    }
    ?>
    <div class="container">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="text-align:center">
            <h2 class="loginheading">Sign In Form</h2>
            <input type="text" name="emails" placeholder="Email" class="fieldStyling" autocomplete="off" value="hassiii547@gmail.com"><br><br>
            <input type="password" name="passwords" placeholder="Password" class="fieldStyling" value="4545"><br><br>
            <button class="buttonStyling" name="btnlogin"><strong>Login</strong></button><br><br>
            <p style="display:inline;">Not a member?</p>
            <a href="<?php echo $base_url; ?>/signup_Form.php">SignUp now</a>
        </form>
        <ul style="color: red"><?php foreach ($login_errors as $errors) { ?>
                <li><?php echo $errors ?></li>
            <?php } ?>
        </ul>
    </div>
</body>

</html>