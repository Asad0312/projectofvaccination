<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Health Center</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Enter Username" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <select name="role" required>
                <option value="">-- Select Account Type --</option>
                <option value="admin">Admin</option>
                <option value="hospital">Hospital</option>
                <option value="patient">Patient</option>
            </select>
            <input type="submit" name="login" value="Login">
            <p class="register-link">Don’t have an account? <a href="Register.php">Register</a></p>
        </form>
    </div>

    <?php
    session_start();
    include "./DBConnection.php";

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM `registration` WHERE username='$username' AND passward='$password'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] === 'admin') {
                header("Location: Admin/dashboard.php");
            } elseif ($row['role'] === 'hospital') {
                header("Location: Hospital/index.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
    echo "<script>alert('Invalid username or password!');</script>";
        }
    }
    ?>
</body>
</html>
