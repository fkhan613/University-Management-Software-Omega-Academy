<?php include "../config/database.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omega Academy</title>
</head>
<body>
    <?php
        if(!isset($_COOKIE['authenticated']) && !isset($_COOKIE['emailCookie']) && !isset($_COOKIE['passwordCookie'])){
            echo "<script>alert('NOT AUTHENTICATED'); window.location.href='login.php';</script>";
        }


        if(isset($_POST['logout'])){
            setcookie('emailCookie', '', time() - time(), '/'); // empty value and old timestamp
            setcookie('passwordCookie', '', time() - time(), '/'); 
            setcookie('authenticated', '', time() - time(), '/'); 
            session_unset();
            session_destroy();
            header("Location: login.php");
        }
    ?>
    <form action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF']))?>" method="POST">
    <input name="logout" type="submit" value="logout">
    </form>
</body>
</html>