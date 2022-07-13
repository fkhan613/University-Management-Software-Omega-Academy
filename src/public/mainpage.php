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
   <div class="container flex">
      <!--welcome section start-->
      <section class="welcome-section">
        <div class="header">
          <!--Content before waves-->
          <div class="inner-header flex">
            <h1>
              Welcome to The
              <span
                class="txt-type"
                data-wait="1000"
                data-words='["Omega Academy", "Best Academy", "Place Where Students Strive"]'
              ></span>
            </h1>
          </div>

          <!--Waves Container-->
          <div>
            <svg
              class="waves"
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              viewBox="0 24 150 28"
              preserveAspectRatio="none"
              shape-rendering="auto"
            >
              <defs>
                <path
                  id="gentle-wave"
                  d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"
                />
              </defs>
              <g class="parallax">
                <use
                  xlink:href="#gentle-wave"
                  x="48"
                  y="0"
                  fill="rgba(255,255,255,0.7"
                />
                <use
                  xlink:href="#gentle-wave"
                  x="48"
                  y="3"
                  fill="rgba(255,255,255,0.5)"
                />
                <use
                  xlink:href="#gentle-wave"
                  x="48"
                  y="5"
                  fill="rgba(255,255,255,0.3)"
                />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
              </g>
            </svg>
          </div>
          <!--Waves end-->
        </div>
        <!--Header ends-->
      </section>
      <!--welcome section end-->
    </div>
    <link rel="stylesheet" href="../public/css/mainpage.css" />
    <script src="https://unpkg.com/typeit@8.6.6/dist/index.umd.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
    <script src="../public/js/mainpage.js"></script>
</body>
</html>