<?php include "../config/database.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(!$_SESSION['authenticated']){
            echo "<script>alert('NOT AUTHENTICATED'); window.history.back();</script>";
        } else{
            echo "<script>alert('AUTHENTICATED');</script>";
        }

        if(isset($_POST['logout'])){
            session_unset();
            session_destroy();
            header("Location: login.php");
        }
    ?>

    <form method="POST" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>>
    <input type="submit" value="Logout" name="logout">
    </form>
</body>
</html>