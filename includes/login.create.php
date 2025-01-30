<?php 

session_start();

require '../core/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
   
    // Fetch user data from the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Authentication successful
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['username'];
        // echo "Login successful!";
        header("Location: http://localhost:8000");
    } else {
        // echo "Invalid email or password!";
        header("Location: http://localhost:8000/authentication/login.php");
    }
}
