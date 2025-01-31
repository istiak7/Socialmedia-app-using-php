<?php 

session_start();

require '../core/Database.php';
require '../includes/class/user.class.php';

$database = new Database();
$conn = $database->getConnection();
$user = new User($database);

try{

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        if($user->userLogin($email,$password)){

                header("Location: http://localhost:8000");
            }

        else {
                header("Location: http://localhost:8000/authentication/login.php");
            }
        } 
}
catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

    
