<!DOCTYPE html>
<?php include "app_constants.php" ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup_style.css">
    <title>SignUp Form</title>

</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "currencies_db";


    $fname = "";
    $lname = "";
    $email = "";
    $passwords = "";
    $confirmpassword = "";
    $errors = array();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $passwords = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        $is_valid = true;
        if (!empty($email)) {
            if (strpos($email, ".") == false && strpos($email, "@") == false) {
                $is_valid = false;
                array_push($errors, "Invalid Email");
            }
        }
        if (empty($fname)) {
            $is_valid = false;
            array_push($errors, "Enter First Name");
        }
        if (empty($lname)) {
            $is_valid = false;
            array_push($errors, "Enter last Name");
        }
        if (empty($email)) {
            $is_valid = false;
            array_push($errors, "Enter email ");
        }
        if (empty($passwords)) {
            $is_valid = false;
            array_push($errors, "Enter password");
        }
        if (!empty($password)) {
            if (strlen(trim($password) < 4)) {
                array_push($errors, "Password must have more than 4 character");
            }
        }
        if (empty($confirmpassword)) {
            $is_valid = false;
            array_push($errors, "Enter Confirm Password");
        }
        if ($passwords != $confirmpassword) {
            $is_valid = false;
            array_push($errors, "Password doesnot match");
        }
        if ($is_valid == true) {
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            $sql = "SELECT * FROM registration_detail WHERE email = " . "'$email'";
            $data = $conn->query($sql);

            if (!$data->num_rows > 0) {
                $sql = "INSERT INTO registration_detail (first_name, last_name, email,passwords)
                VALUES ('$fname','$lname','$email','$passwords')";
                if ($conn->query($sql) === TRUE) {
                    if (!headers_sent($file, $line)) {
                        header("Location: $base_url/login.php", true);
                    }
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                mysqli_close($conn);
            } else {
                array_push($errors, "Email exist Already");
            }
        }
    }
    ?>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="text-align:center">

            <label class="headingStyling">
                <h4>SignUp Form</h4>
            </label>

            <input type="text" placeholder="First Name" class="fieldStyling" name="fname" value="<?php echo $fname ?>" autocomplete="off"><br><br>
            <input type="text" placeholder="Last Name" class="fieldStyling" name="lname" value="<?php echo $lname ?>" autocomplete="off"><br><br>
            <input type="text" name="email" placeholder="Email" class="fieldStyling" autocomplete="off" value="<?php echo $email ?>"><br><br>
            <input type="password" name="password" placeholder="Password" class="fieldStyling" value="<?php echo $passwords ?>"><br><br>
            <input type="password" name="confirmpassword" placeholder="ConfirmPassword" class="fieldStyling" value=""><br><br>
            <Button type="submit" name="submitBtn" class="buttonStyling">SignUp</Button>
        </form>
        <div style="padding:5px;">
            <ul style="color:red; "><?php
                                    foreach ($errors as $error) { ?>
                    <li><?php echo $error ?></li>
                <?php } ?>
            </ul>
        </div>
    </div>

</body>

</html>
