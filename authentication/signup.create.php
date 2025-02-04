<?php

session_start();

require '../core/Database.php';
require '../includes/class/user.class.php';

$database = Database::getInstance();
$conn = $database->getConnection();
$user = new User($database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password =htmlspecialchars(trim ($_POST['password']));
    
    //password verification
    if($user->checkPasswordValidation($password) == "empty or less than 6"){
        $_SESSION['password_error'] = 'password cannot empty or at least 6 length!';
        header("Location: http://localhost:8000/authentication/signup.php");
    }
    else if($user->checkPasswordValidation($password) == "too large"){
        $_SESSION['password_error'] = 'password is too large!';
        header("Location: http://localhost:8000/authentication/signup.php");
    }

    //user name verification
    else if ($user->checkUsernameAlreadyExist($username) == true) {
        $_SESSION['username_error'] =  "username already exist!";    
        header("Location: http://localhost:8000/authentication/signup.php");
    }

    else if($user->predefineUsernameRules($username) ==  "one digit and one letter"){
        $_SESSION['username_error'] =  "username contains at least one digit and one letter!";
        header("Location: http://localhost:8000/authentication/signup.php");
    }
    else if($user->predefineUsernameRules($username) ==  "special character"){
        $_SESSION['username_error'] =  "username contains at least one special character!";
        header("Location: http://localhost:8000/authentication/signup.php");
    }

    //email verification 
    else if ($user->checkEmailAlreadyExist($email) == true) {
        $_SESSION['email_error'] =  "Email already exist!"; 
        header("Location: http://localhost:8000/authentication/signup.php");
    }
    else {
       
        $user->userRegister($username, $email, $password);
        header("Location: http://localhost:8000/authentication/login.php");
        exit();
    }
}
