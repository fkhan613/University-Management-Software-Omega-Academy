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
      $register_stmt->bind_param("sssssss", $fName, $lName, $dob, $phNum, $address, $email, $student_pass);
    ?>
    <canvas id="canvas"></canvas>
    <div class="container">
      <div class="img">
        <img src="../public/img/bg.svg" />
      </div>
      <div class="login-content">
        <form autocomplete="new-password">
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
                name="DOB"
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
                type="email"
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
          <input type="submit" name="register" class="btn" value="Register" />
        </form>
      </div>
    </div>
    <script src="../public/js/loginregister.js"></script>
  </body>
</html>
