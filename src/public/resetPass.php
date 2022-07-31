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
    <title>Reset Password</title>
  </head>
    <?php
        //check if the user is verified to be here
        if(!isset($_COOKIE['verified'])){
          echo "<script> alert('You are unauthorized to be here!'); window.location.href = 'login.php';</script>";
        }

        $updatePass = $conn->prepare("UPDATE students SET student_pass = ? WHERE student_id = ?");
        $updatePass->bind_param("ss", $newPass, $_SESSION['user']['student_id']);

        if(isset($_POST['reset'])){
          $newPass = htmlspecialchars($_POST['newPass']);
          $confirmedPass = htmlspecialchars($_POST['confirmedPass']);

          if(!empty($newPass) && !empty($confirmedPass) && $newPass == $confirmedPass){
            //update password
            $updatePass->execute();
            echo "<script> alert('Password Updated!'); window.location.href = 'login.php';</script>";
          } else{
            echo "<script> alert('Please ensure the two passwords match');</script>";
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
        <form autocomplete="off" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method="POST">
          <img src="../public/img/loginAvatar.svg" loading="lazy"/>
          <h2 class="title">Reset Password</h2>
          <div class="input-div one">
            <div class="i">
              <i class="fas fa-lock"></i>
            </div>
            <div class="div">
              <h5>Enter your new password</h5>
              <input
                type="text"
                name="newPass"
                class="input"
                autocomplete="off"
                required
                oninvalid="this.setCustomValidity('Please enter a new password')"
                oninput="setCustomValidity('')"
              />
            </div>
          </div>
            <div class="input-div one">
                <div class="i">
                <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                <h5>Confirm your new password</h5>
                <input
                    type="text"
                    name="confirmedPass"
                    class="input"
                    autocomplete="off"
                    required
                    oninvalid="this.setCustomValidity('Please re-enter your password')"
                    oninput="setCustomValidity('')"
                />
                </div>
          </div>
          <input type="submit" name="reset" class="btn" value="reset" />
        </form>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
    <script src="../public/js/loginregister.js"></script>
  </body>
</html>
