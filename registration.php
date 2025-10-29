<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./css/registration.css">
</head>

<body>
    <div class="register-container">
        <h2>Create Account</h2>
        <form method="post">
            <input type="text" name="txtname" placeholder="Enter Your Name" required>
            <input type="email" name="txtemail" placeholder="Enter Your Email" required>
            <input type="text" name="txtuser" placeholder="Enter Your Username" required>
            <input type="password" name="txtpass" placeholder="Enter Your Password" required>
            <input type="submit" name="btn" value="Register">
        </form>
        <a href="login.php">Already have an account? Login</a>

        <?php
        include "./DBConnection.php";

        if (isset($_POST["btn"])) {
            $name = $_POST["txtname"];
            $email = $_POST["txtemail"];
            $username = $_POST["txtuser"];
            $password = $_POST["txtpass"];

            $query = "INSERT INTO `registration`(`Name`, `Email`, `Username`, `passward`) 
                      VALUES ('$name','$email','$username','$password')";
            $result = mysqli_query($connection, $query);

            if ($result) {
                echo "<script>alert('Registration Successful!'); window.location.href='login.php';</script>";
            } else {
                echo "<div class='message'>Registration Failed! Please try again.</div>";
            }
        }
        ?>
    </div>


</body>

</html>