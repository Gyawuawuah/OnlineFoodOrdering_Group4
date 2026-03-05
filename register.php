<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Julee&display=swap" rel="stylesheet">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html{
            font-size: 62.5%;
        }
        body{
            font-family: sans-serif;
            font-size: 2.4rem;
            line-height: 1.4;
            font-weight: 400;
            color: #fff;
            background-color: #073b4c;
        }
        .register{
            height: 100vh;
            width: 100vw;
            display: grid;
            place-content: center;
        }
        .register-text{
            font-size: 6.4rem;
            font-weight: 800;
            font-family: "Julee",sans-serif;
            transition: all, 0.3s;
        }
        .register-text:hover{
            color: #f8b229;
        }
        .log-link:visited, .log-link:link{
            color: #F94144;
            display: inline-block;
            text-decoration: none;
            font-size: 2.8rem;
        }
        .log-link:hover,.log-link:active{
            color: #f8b229;
        }
    </style>
</head>
<body>
    <div class="register">
        <h1 class="register-text"> 
    <?php
    session_start(); // Start session

    // =====================
    // 1. COLLECT FORM DATA
    // =====================
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $passwordtwo = $_POST['password2'];
    $course   = $_POST['course'];

    $profile  = $_FILES['profile'];
    $document = $_FILES['document'];

    // =====================
    // 2. VALIDATION (if–elseif)
    // =====================
    if (empty($name) || empty($email) || empty($password) || empty($passwordtwo)) {
        echo "All fields are required.";
        exit();
    } elseif (strlen($password) < 6) {
        echo "Password must be at least 6 characters.";
        exit();
    }elseif($password != $passwordtwo){
        echo "Password doesn't match";
        exit();
    }elseif (isset($_POST['register'])) {

    // $email = $_POST['email'];
    // $password = $_POST['password'];

    // Save registration details into session
    // $_SESSION['registered_email'] = $email;
    // $_SESSION['registered_password'] = $password;

    // echo "Registration successful! <br>";
    // echo "<a href='login.php'>Go to Login</a>";
    }
    // =====================
    // 3. VALIDATE PROFILE IMAGE
    // =====================
    $allowedImages = ['image/jpeg', 'image/png'];
    

    if ($profile['error'] !== 0) {
        echo "Error uploading profile image.";
        exit();
    }

    if (!in_array($profile['type'], $allowedImages)) {
        echo "Only JPG/PNG allowed.";
        exit();
    }

    // =====================
    // 4. VALIDATE DOCUMENT
    // =====================
    $allowedDocs = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];

    if ($document['error'] !== 0) {
        echo "Error uploading document.";
        exit();
    }

    if (!in_array($document['type'], $allowedDocs)) {
        echo "Only PDF/DOC/DOCX allowed.";
        exit();
    }

    // =====================
    // 5. MOVE FILES
    // =====================
    $profileName = time() . "_" . $profile['name'];
    $profilePath = "profiles/" . $profileName;

    move_uploaded_file($profile['tmp_name'], $profilePath);

    $docName = time() . "_" . $document['name'];
    $docPath = "uploads/" . $docName;

    move_uploaded_file($document['tmp_name'], $docPath);

    // =====================
    // 6. STORE COOKIE
    // =====================
    setcookie("student_name", $name, time() + 3600, "/");

    // =====================
    // 7. STORE SESSION DATA
    // =====================
    $_SESSION['name']    = $name;
    $_SESSION['email']   = $email;
    $_SESSION['course']  = $course;
    $_SESSION['password'] = $password;
    $_SESSION['profile'] = $profilePath;

    // =====================
    // 8. DISPLAY COURSE (switch)
    // =====================
    switch ($course) {
        case "ff":
            $courseName = "Friends and family";
            break;
        case "yv":
            $courseName = "YouTube video";
            break;
        case "eng":
            $courseName = "Facebook ad";
            break;
        default:
            $courseName = "Unknown";
    }

    // =====================
    // OUTPUT
    // =====================
    // echo "Registration Successful!<br>";
    echo "$name<br> your Registration was Successful✅";
    // echo "Course: $courseName<br>";

    // echo "<img src='$profilePath' width='120'><br>";

    // echo "<a href='dashboard.php'>Proceed to Login</a>";
    ?>
        </h1>
        <br><br>
        <a class="log-link" href='login.php'>Proceed to Login</a>
    </div>
    
</body>
</html>
