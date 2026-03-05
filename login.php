<?php
session_start();

if (isset($_POST['login'])) {

    $login_email = $_POST['email'];
    $login_password = $_POST['password'];

    // Check if user registered first
    if (!isset($_SESSION['email']) || 
        !isset($_SESSION['password'])) {

        echo "No registered user found!";
        exit(); // ❌ Stop process
    }

    // Compare login details with registration details
    if ($login_email !== $_SESSION['email'] || 
        $login_password !== $_SESSION['password']) {

        echo "Email or Password does not match registration details!";
        exit(); // ❌ STOP PROCESS HERE
    }

    // If everything matches
    echo "Login Successful!";
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Julee&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main-section">

        <div class="logo">
            <h1 class="text-logo">
                Group 4
            </h1>
        </div>

        <div class="forms">

            <p class="main-text">
                Login In Your Account 
            </p>

            <form method="POST">
                Email: <br>
                <input type="email" name="email"><br><br>
                Password: <br>
                <input type="password" name="password"><br><br>

                <input class="btn--form" type="submit" value="Login" name="login">
            </form>

            <div class="main-line">
                <div class="line2"></div>
                <p class="or">Or</p>
                <div class="line3"></div>
            </div>
                
            <p class="log">Don't Have An Account? <a class="log-link" href="http://localhost/GROUP4/#RegistrationSS">Register</a></p>
        </div>
    </div>

</body>
</html>

