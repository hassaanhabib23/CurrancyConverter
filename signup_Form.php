<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup_Style.css">
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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $passwords = $_POST['password'];
        $sql = "INSERT INTO registration_detail (first_name, last_name, email,passwords)
        VALUES ('$fname','$lname','$email','$passwords')";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        mysqli_close($conn);
    }
    ?>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="GFG">

            <label class="headingStyling">
                <h4>SignUp Form</h4>
            </label>
            <input type="text" placeholder="First Name" class="fieldStyling" name="fname"><br><br>
            <input type="text" placeholder="Last Name" class="fieldStyling" name="lname"><br><br>
            <input type="email" name="email" placeholder="Email" required class="fieldStyling"><br><br>
            <input type="password" name="password" placeholder="Password" required class="fieldStyling"><br><br>
            <!-- <a href="http://localhost/CurrencyConverter/login2.php" name="signup" class="signupbutton">SignUp</a> -->
            <Button type="submit" name="submitBtn" class="buttonStyling">SignUp</Button>
        </form>

    </div>
</body>

</html>