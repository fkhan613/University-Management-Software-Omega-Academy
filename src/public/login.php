<?php include "../config/database.php"?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../public/css/loginregister.css" />
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
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <title>Student Login Portal</title>
  </head>
  <?php
    //prepared statement to check valid login
    $login_stmt = $conn->prepare("SELECT * FROM students WHERE email = ?");
    $login_stmt->bind_param("s", $email);

    //if user logged in in the past 1 and 30 minutes
    if(isset($_COOKIE['authenticated'])){
      header("Location: omegaacademy.php");
    }
    
    //if not logged in in the past 1 and 30 minutes, check cookies 
    elseif (isset($_COOKIE['emailCookie']) && isset($_COOKIE['passwordCookie'])){
          $login_stmt->bind_param("s", $_COOKIE['emailCookie']);
          $login_stmt->execute();
          $result = $login_stmt->get_result();

          if(mysqli_num_rows($result) > 0){

            //check if the password still matches
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $row;
            
            if($result['student_pass'] == $_COOKIE['passwordCookie']){
              setCookie("authenticated", true, time() + (3600 * 1.5), "/");
              header("Location: omegaacademy.php");
            }
          } 
    }

    if(isset($_POST['login'])){
        //assign variables
        $email = htmlspecialchars($_POST['email']);
        $pass = htmlspecialchars($_POST['password']);

        //check if email and password are correct
        if(!empty($email) && !empty($pass) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $login_stmt->execute();
            $result = $login_stmt->get_result();
            
            if(mysqli_num_rows($result) > 0){ //email correct

              //check if password is correct
              $row = mysqli_fetch_assoc($result);
              if($row['student_pass'] == $pass){

                //login successful
                setCookie("authenticated", true, time() + (3600 * 1.5), "/");
                $_SESSION['user'] = $row;

                if(isset($_POST['rememberMe'])){
                    //set cookies
                    setCookie("emailCookie", $email, time() + (86400 * 5), "/");
                    setCookie("passwordCookie", $pass, time() + (86400 * 5), "/");
                    $_SESSION['rememberMeChecked'] = true;
                } 

                //send to main page
                header("Location: omegaacademy.php");
              } else{
                echo "<script> alert('Incorrect email or password');</script>";
              }
            } else {
                echo "<script> alert('Incorrect email or password');</script>";
            }
        }
    } 
?>
  <body>
    <div class="spinner-container">
      <div class="spinner"></div>
    </div>
    <canvas id="canvas"></canvas>
    <div class="container" id=cont>
      <div class="img animate__animated animate__fadeInLeft">
        <img src="../public/img/bg.svg" loading="lazy"/>
      </div>
      <div class="login-content animate__animated animate__fadeInRight">
        <form autocomplete="off" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method="POST" enctype="multipart/form-data">
          <img src="../public/img/loginAvatar.svg" loading="lazy"/>
          <h2 class="title">Student Login Portal</h2>
          <div class="input-div one">
            <div class="i">
              <i class="fa-solid fa-at"></i>
            </div>
            <div class="div">
              <h5>Email</h5>
              <input
                type="email"
                name="email"
                class="input"
                autocomplete="off"
                required
                oninvalid="this.setCustomValidity('Please enter a valid email')"
                oninput="setCustomValidity('')"
              />
            </div>
          </div>
          <div class="input-div pass">
            <div class="i">
              <i class="fas fa-lock"></i>
            </div>
            <div class="div">
              <h5>Password</h5>
              <input
                type="password"
                name="password"
                class="input"
                autocomplete="off"
                required
                oninvalid="this.setCustomValidity('Please enter a valid password')"
                oninput="setCustomValidity('')"
              />
            </div>
          </div>
          <input type = "checkbox" name = "rememberMe" class="rememberMe"/>
          <label for="rememberMe" class="control-label" style="color: rgba(53, 52, 52, 0.719);font-size: 0.9rem;font-weight: bold;transition: 0.3s;">Remember me for 5 days</label>
          <input type="submit" name="login" class="btn" value="Login" />
          
          <div class="a-container" 
                style="display: flex;
                  flex-direction: row;
                  justify-content: space-around;
                  align-items: center;
                  flex-wrap: wrap;
                  gap: 2em;
                  padding-top: 0.5em;">
              <a href="omegaacademy.php?guest=true" class="a" style="text-decoration: none;">Log in as Guest</a>
              <a
                href="register.php"
                class="a"
                style="text-decoration: none; "
              >Create an account</a>
              <a href="emailauth.php" class="a" style="text-decoration: none;">Forgot Password?</a>
          </div>
        </form>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
    <script src="../public/js/loginregister.js"></script>
  </body>
</html>
