<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signupStyle.css">
    <title>SignUp Form</title>

</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "registration_db";


    $fname = "";
    $lname = "";
    $email = "";
    $passwords = "";
    echo $_SERVER["REQUEST_METHOD"];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $passwords = $_POST['password'];
        if (empty($fname) && empty($lname) && empty($email) && empty($passwords)) {
            $prompt = "Empty Fields Exists";
            $bool = false;
        } else if (empty($fname)) {
            $prompt = "Empty First Name field";
            $bool = false;
        } else if (empty($lname)) {
            $prompt = "Empty last Name field";
            $bool = false;
        } else if (empty($email)) {
            $prompt = "Empty Email field";
            $bool = false;
        } else if (empty($passwords)) {
            $prompt = "Empty Password field";
            $bool = false;
        } else {
            $bool = true;
            $sql = "INSERT INTO registration_detail (first_name, last_name, email,passwords)
        VALUES ('$fname','$lname','$email','$passwords')";
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            mysqli_close($conn);
        }
    }
    ?>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <label class="headingStyling">
                <h4>SignUp Form</h4>
            </label>
            <h3 style="color: red"><?php if (isset($prompt)) {
                                        echo $prompt;
                                    } ?></h3>
            <input type="text" placeholder="First Name" class="fieldStyling" name="fname"><br><br>
            <input type="text" placeholder="Last Name" class="fieldStyling" name="lname"><br><br>
            <input type="email" name="email" placeholder="Email" required class="fieldStyling"><br><br>
            <input type="password" name="password" placeholder="Password" required class="fieldStyling"><br><br>

            <a href="" name="signup" type="submit" class="signupbutton">SignUp</a>

        </form>
    </div>
</body>

</html>