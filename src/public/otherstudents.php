<?php include "../config/database.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Other Students Courses</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../public/css/mainpage.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
      integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" type="image/png" href="../public/img/loginAvatar.svg"/>
</head>
<body>
    <div class="spinner-container">
      <div class="spinner"></div>
    </div>
    <?php

        //authentication
        if(isset($_GET['guest'])){
          $_SESSION['user']['first_name'] = "Guest";
          $_SESSION['guest'] = true;
        }

        if(!isset($_COOKIE['authenticated']) && !isset($_COOKIE['emailCookie']) && !isset($_COOKIE['passwordCookie']) && !isset($_GET['guest'])){
            session_unset();
            session_destroy();
            echo "<script>alert('Session expired, please login again.'); window.location.href='login.php';</script>";
        }
        
        //prepared statement to query all the courses which have more than 0 seats
        $get_courses = $conn -> prepare("SELECT * FROM enrolled_students e JOIN students s ON s.student_id = e.student_id ");
        $get_courses->execute();
        $courses =  mysqli_fetch_all($get_courses->get_result(), MYSQLI_ASSOC);
    ?>
    <div class="container">
      <!--welcome section start-->
      <div class="welcome-section flex-column">
        <div class="header">
          <!--Content before waves-->
          <div class="inner-header">
            <marquee
              behavior="scroll"
              direction="right"
              scrollamount="14.5"
              width="100%"
              class="carousel"
              scrolldelay="0"
              ;
            >
              <img class="icon" loading="lazy" src="../public/img/icon1.svg" />
              <img class="icon" loading="lazy" src="../public/img/icon2.svg" />
              <img class="icon" loading="lazy" src="../public/img/icon3.svg" />
              <img class="icon" loading="lazy" src="../public/img/icon4.svg" />
              <img class="icon" loading="lazy" src="../public/img/icon5.svg" />
              <img class="icon" loading="lazy" src="../public/img/icon6.svg" />
              <img class="icon" loading="lazy" src="../public/img/icon7.svg" />
              <img class="icon" loading="lazy" src="../public/img/icon8.svg" />
              <img class="icon" loading="lazy" src="../public/img/icon9.svg" />
              <img class="icon" loading="lazy" src="../public/img/icon10.svg" />
              <img class="icon" loading="lazy" src="../public/img/icon11.svg" />
              <img class="icon" loading="lazy" src="../public/img/icon12.svg" />
              <img class="icon" loading="lazy" src="../public/img/icon13.svg" />
              <img class="icon" loading="lazy" src="../public/img/icon14.svg" />
              <img class="icon" loading="lazy" src="../public/img/icon15.svg" />
              <img class="icon" loading="lazy" src="../public/img/icon16.svg" />
              <img class="icon" loading="lazy" src="../public/img/icon17.svg" />
            </marquee>
            <h1
              class="title"
              id="title"
              data-aos="fade-right"
              data-aos-delay="1200"
              data-aos-duration="1250"
            >
              Welcome Back 
              <span
                class="txt-type"
                data-wait="2200"
                data-words='["<?php echo ($_SESSION['user']['first_name']); ?>", "Champion", "Winner", "Genius"]'
              ></span>
              |
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
      </div>
      <!--welcome section end-->

      <!--course section start-->
      <section class="menu" id="menu">
        <h1
          style="text-align: center; margin-bottom: 2em; margin-top: 1.8em"
          data-aos="fade-up"
          data-aos-duration="450"
          data-aos-easing="ease-in-out"
        >
        Other Students
        </h1>
        <div
          class="nav-container"
          data-aos="fade-up"
          data-aos-duration="450"
          data-aos-easing="ease-in-out"
        >
          <button onclick="location.href='omegaacademy.php'">
            <span class="text">Select Your Courses</span>
          </button>
          <button onclick="location.href='yourcourses.php'">
            <span class="text">View Your Courses</span>
          </button>
          <button onclick="location.href='#menu'">
            <span class="text">View Other Students Courses</span>
          </button>
        </div>

        <div class="box-container">
          <?php 

          if(empty($courses)){
              echo("<h2 style='  
                    font-weight: 400;
                    font-family: 'Lato', sans-serif;
                    color: black;
                    display: block;
                    text-align: center;
                    font-size: 2em;'>
                  No students have enrolled in any classes yet.</h2>");
            } else{
              foreach($courses as $course){
            
                $course_name = strval($course['course_name']);
                $course_code = strval($course['course_code']);
                $date_registered = strval($course['date_registered']);
                $student = strval($course['first_name']);

                echo(
                  "<div
                  class='card'
                  data-aos='fade-up'
                  data-aos-duration='450'
                  data-aos-delay='100'
                  data-aos-easing='ease-in-out'
                >
                  <div class='card-border-top'></div>
                  <span><p style='color:white;'>Student: $student</p></span>
                  <div class='img'></div>
                  <span><p style='color:white;'>$course_name</p></span>
                  <p class='job'>$course_code</p>
                  <p class='available_seats'>Date Registered: $date_registered</p>
                </div>");

             }
          }
          ?>
        </div>
            <div style="display:flex; justify-content:center; align-items:center; margin-bottom: 2em;">
              <a onclick="location.href='../config/database.php?logout=true'" style="text-align:center;" id="button">LOGOUT</a>
            </div>
        </div>
      </section>
      <!--course section end-->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
    <script src="../public/js/mainpage.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>
</html>