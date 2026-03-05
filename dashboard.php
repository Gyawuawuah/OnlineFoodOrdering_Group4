<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Julee&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dash-main">
        <div class="dash-primary">
            <?php
                session_start();

                if (!isset($_SESSION['email'])) {
                    echo "Please login first.";
                    exit();
                }
                echo "Welcome To Your Dashboard" ."<br>";

                echo $_SESSION['name'] . "<br><br><br>";
                echo "<img src='" . $_SESSION['profile'] . "' width='500', border-radius='50%'><br>";
                echo "Email: " . $_SESSION['email'] . "<br>";
                echo "Where did you hear from us: " . $_SESSION['course'] . "<br>";
                echo "You have 0 food order"."<br>";
                echo "<a href='logout.php'>Logout</a>";
            ?>
        </div>
    </div>
</body>
</html>

