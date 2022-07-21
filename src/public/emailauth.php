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
    <title>Verify Email</title>
  </head>
  <?php
    //prepared statement to check valid login
    $check_email = $conn->prepare("SELECT * FROM students WHERE email = ?");
    $check_email->bind_param("s", $email);
    
    if(isset($_POST['send'])){
        //assign variables
        $email = htmlspecialchars($_POST['email']);

        //check if email and password are correct
        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $check_email->execute();
            $result = $check_email->get_result();
            
            if(mysqli_num_rows($result) > 0){ //email exists in database
              $_SESSION['email'] = $email;
              header('Location: verification.php');
            } else{
                echo "<script> alert('This email does not exist in our database');</script>";
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
          <h2 class="title">Authentication</h2>
          <div class="input-div one">
            <div class="i">
              <i class="fa-solid fa-at"></i>
            </div>
            <div class="div">
              <h5>Enter your email for a verification code</h5>
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
          <input type="submit" name="send" class="btn" value="Login" />
        </form>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
    <script src="../public/js/loginregister.js"></script>
  </body>
</html>
