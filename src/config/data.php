<?php
include "database.php";

//********LOGIN FORM********//
if(isset($_POST['login'])){
    //assigne variables
    $email = htmlspecialchars($_REQUEST['email']);
    $pass = htmlspecialchars($_REQUEST['password']);
    //prepared statement to check valid login
    $login_stmt = $conn->prepare("SELECT * FROM students WHERE email = ? AND student_pass = ?");
    $login_stmt->bind_param("ss", $email, $pass);

    //check if email and password are correct
    if(!empty($email) && !empty($pass) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $login_stmt->execute();
        $login_stmt->store_result();

        if($login_stmt->num_rows == 1){
            //login success
            echo "LOGIN SUCCESSFUL";
        } else{
            echo "LOGIN FAILURE";
        }
    }
}

//********REGISTER FORM********//

?>