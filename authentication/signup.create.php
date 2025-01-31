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
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    if ($user->checkUsernameAlreadyExist($username) == true) {
             
        header("Location: http://localhost:8000/authentication/signup.php");
    }
    
    else if ($user->checkEmailAlreadyExist($email) == true) {
        
        header("Location: http://localhost:8000/authentication/signup.php");
    }
    else {
       
        $user->userRegister($username, $email, $password);
        header("Location: http://localhost:8000/authentication/login.php");
        exit();
    }
}
