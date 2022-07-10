<?php include "../config/database.php" ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
      integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="../public/css/loginregister.css" />
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
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <title>Student Registration</title>
  </head>
  <body>
    <?php
      //prepared statement to add student to database
      $register_stmt = $conn->prepare("INSERT INTO students (first_name, last_name, dob, phone_number, address, email, student_pass) VALUES (?,?,?,?,?,?,?)");
      $register_stmt->bind_param("sssssss", $first_name, $last_name, $dob, $phNum, $address, $email, $student_pass);
      $checkEmail_stmt = $conn->prepare("SELECT * FROM students WHERE email = ?");
      $checkEmail_stmt->bind_param("s",$email);
      //check if form is submitted
      if (isset($_POST['register'])) {
        //assign variables
        $email = htmlspecialchars($_POST['email']);
        $student_pass = htmlspecialchars($_POST['password']);
        $confirm_password = htmlspecialchars($_POST['retypedPass']);
        $first_name = htmlspecialchars($_POST['firstName']);
        $last_name = htmlspecialchars($_POST['lastName']);
        $address = htmlspecialchars($_POST['address']);
        $phNum = htmlspecialchars($_POST['phoneNumber']);
        $dob = htmlspecialchars($_POST['dob']);

        //check if all fields are filled
        if (
          !empty($email) &&
          !empty($student_pass) &&
          !empty($confirm_password) &&
          !empty($first_name) &&
          !empty($last_name)
        ) {
          //check if passwords match
          if ($student_pass == $confirm_password) {
            //check if email is valid
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $checkEmail_stmt -> execute();
              $checkEmail_stmt -> store_result();
              //check if email already exists
              if ($checkEmail_stmt -> num_rows > 0) {
                echo "<script>alert('Email already exists')</script>";
              } else {
                  //insert user into database
                  $register_stmt -> execute();
                  $register_stmt -> store_result();
                  $_SESSION['email'] = $email;
                  echo ('<script> alert("Registration Successful"); window.location.href = "login.php"; </script>');
              }
            } else {
              echo "<script>alert('Invalid email')</script>";
            }
          } else {
            echo "<script>alert('Passwords do not match')</script>";
          }
        }
      }
    ?>
    <canvas id="canvas"></canvas>
    <div class="container">
      <div class="img">
        <img src="../public/img/bg.svg" />
      </div>
      <div class="login-content">
        <form autocomplete="off" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method="POST" enctype="multipart/form-data">
          <img src="../public/img/loginAvatar.svg" />
          <h2 class="title">Student Registration Portal</h2>
          <div class="input-div one">
            <div class="i">
              <i class="fas fa-user"></i>
            </div>
            <div class="div">
              <h5>First Name</h5>
              <input
                type="text"
                name="firstName"
                class="input"
                required
                autocomplete="new-password"
                oninvalid="this.setCustomValidity('Please enter your first name')"
                oninput="setCustomValidity('')"
              />
            </div>
          </div>
          <div class="input-div one">
            <div class="i">
              <i class="fas fa-user"></i>
            </div>
            <div class="div">
              <h5>Last Name</h5>
              <input
                type="text"
                name="lastName"
                class="input"
                required
                autocomplete="new-password"
                oninvalid="this.setCustomValidity('Please enter your last name')"
                oninput="setCustomValidity('')"
              />
            </div>
          </div>
          <div class="input-div one">
            <div class="i">
              <i class="fa-solid fa-calendar"></i>
            </div>
            <div class="div">
              <h5>Date of Birth</h5>
              <input
                type="date"
                name="dob"
                class="input date"
                required
                autocomplete="off"
                oninvalid="this.setCustomValidity('Please enter your date of birth')"
                oninput="setCustomValidity('')"
              />
            </div>
          </div>
          <div class="input-div one">
            <div class="i">
              <i class="fa-solid fa-house"></i>
            </div>
            <div class="div">
              <h5>Address</h5>
              <input
                type="text"
                name="address"
                class="input"
                required
                autocomplete="off"
                oninvalid="this.setCustomValidity('Please enter your address')"
                oninput="setCustomValidity('')"
              />
            </div>
          </div>
          <div class="input-div one">
            <div class="i">
              <i class="fa-solid fa-phone"></i>
            </div>
            <div class="div">
              <h5>Phone Number</h5>
              <input
                type="tel"
                name="phoneNumber"
                class="input"
                required
                autocomplete="new-password"
                oninvalid="this.setCustomValidity('Please enter your phone number')"
                oninput="setCustomValidity('')"
              />
            </div>
          </div>
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
                required
                autocomplete="false"

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
          <div class="input-div pass">
            <div class="i">
              <i class="fas fa-lock"></i>
            </div>
            <div class="div">
              <h5>Confirmed Password</h5>
              <input
                type="password"
                name="retypedPass"
                class="input"
                autocomplete="off"
                required
                oninvalid="this.setCustomValidity('Please re-enter your password')"
                oninput="setCustomValidity('')"
              />
            </div>
          </div>
          <input type="submit" name="register" class="btn" value="Register" />
        </form>
      </div>
    </div>
    <script src="../public/js/loginregister.js"></script>
  </body>
</html>
