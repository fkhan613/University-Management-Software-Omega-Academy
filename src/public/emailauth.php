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
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../public/PHPMailer/src/Exception.php';
    require '../public/PHPMailer/src/PHPMailer.php';
    require '../public/PHPMailer/src/SMTP.php';
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
              $_SESSION['user'] = mysqli_fetch_assoc($result);
              $_SESSION['authCode'] = rand(100000, 999999);
              
              //Create an instance; passing `true` enables exceptions
              $mail = new PHPMailer(true);
              
              //send email to user with the verification code
              try {
                  //Server settings
                  //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
                  $mail->isSMTP();                                            //Send using SMTP
                  $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
                  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                  $mail->Username   = 'omegaacademcy@gmail.com';              //SMTP username
                  $mail->Password   = 'zbvsiqetbskwwguf';                     //SMTP password
                  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                  $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                  
                  //Recipients
                  $mail->setFrom('omegaacademcy@gmail.com', 'Omega Academy');
                  $mail->addAddress($_SESSION['user']['email'], $_SESSION['user']['first_name'] . " " .  $_SESSION['user']['last_name']);  //Add a recipient

                  //Content
                  $mail->isHTML(true);                                         //Set email format to HTML
                  $mail->Subject = 'Password Reset Verification Code';
                  $mail->Body    = 'Your verfication code is: ' . $_SESSION['authCode'] . "<br>If you did not intend to change your password, please ignore this email.";
                  $mail->AltBody = 'Your verfication code is: ' . $_SESSION['authCode'] . "<br>If you did not intend to change your password, please ignore this email.";

                  $mail->send();
                    echo "<script> alert('Email has been sent!'); window.location.href = 'verification.php';</script>";
              } catch (Exception $e) {
                  echo "<script?alert('Email could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
              }        
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
          <input type="submit" name="send" class="btn" value="send" />
        </form>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
    <script src="../public/js/loginregister.js"></script>
  </body>
</html>
