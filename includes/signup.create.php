<?php
session_start();

require '../core/Database.php';
require '../includes/class/user.class.php';

$database = new Database();
$conn = $database->getConnection();
$user = new User($database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo "This email is already registered.";
    } 
    
    else {

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);

        if ($stmt->rowCount() > 0) {
            echo "This username is already taken.";
        } else {
            $user->userRegister($username , $email , $password);
            header("Location: http://localhost:8000/authentication/login.php");
            exit();
        }
    }
}
?>
