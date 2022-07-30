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
    <title>Verification Code</title>
  </head>
    <?php
        //Import PHPMailer classes into the global namespace
        //These must be at the top of your script, not inside a function
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require '../public/PHPMailer/src/Exception.php';
        require '../public/PHPMailer/src/PHPMailer.php';
        require '../public/PHPMailer/src/SMTP.php';

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
            $mail->addAddress('farhan.k2005@gmail.com', 'Farhan User');  //Add a recipient

            //Content
            $mail->isHTML(true);                                         //Set email format to HTML
            $mail->Subject = 'Password Reset Verification Code';
            $mail->Body    = 'Your verfication code is: ' . $_SESSION['authCode'];
            $mail->AltBody = 'Your verfication code is: ' . $_SESSION['authCode'];

            $mail->send();
              echo "<script> alert('Email has been sent!');</script>";
        } catch (Exception $e) {
            echo "<script?alert('Email could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
        }        
        
        if(isset($_POST['verify'])){
          $input = intval(htmlspecialchars($_POST['input']));
          
          //if the code is correct, send to resetPass page
          if($input == $_SESSION['authCode']){
            setcookie('verified', true, time() + (3600), "/");
            header('Location: resetPass.php');
          } else{
              echo "<script> alert('Invalid code');</script>";
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
          <h2 class="title">Verification Code</h2>
          <div class="input-div one">
            <div class="i">
              <i class="fas fa-lock"></i>
            </div>
            <div class="div">
              <h5>Please enter the verification code that has been emailed to you</h5>
              <input
                type="text"
                name="input"
                class="input"
                autocomplete="off"
                required
                oninvalid="this.setCustomValidity('Please enter the valid verification code')"
                oninput="setCustomValidity('')"
              />
            </div>
          </div>
          <input type="submit" name="verify" class="btn" value="Verify" />
        </form>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
    <script src="../public/js/loginregister.js"></script>
  </body>
</html>
