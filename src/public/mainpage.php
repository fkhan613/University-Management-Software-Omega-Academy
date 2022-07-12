<?php include "../config/database.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/mainpage.css" />
</head>
<body>
    <div class="spinner-container">
      <div class="spinner"></div>
    </div>  
    <?php
        if(!$_SESSION['authenticated']){
            echo "<script>alert('NOT AUTHENTICATED'); window.location.href='login.php';</script>";
        } else{
            echo "<script>alert('AUTHENTICATED');</script>";
            if(!$_SESSION['rememberMe'] && !isset($_COOKIE['tempAuth'])){
                $_SESSION['authenticated'] = false;
            }
        }

        if(isset($_POST['logout'])){
            setcookie('emailCookie', '', time() - time(), '/'); // empty value and old timestamp
            setcookie('passwordCookie', '', time() - time(), '/'); 
            setcookie('tempAuth', '', time() - time(), '/'); 
            session_unset();
            session_destroy();
            header("Location: login.php");
        }
    ?>
    <form method="POST" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>>
    <input type="submit" value="Logout" name="logout">
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
    <script src="../public/js/mainpage.js"></script>
</body>
</html>