<?php
session_start();

require '../core/Database.php';
$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo "This email is already registered.";
    } else {
        // Check if username exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            echo "This username is already taken.";
        } else {
            // No duplicate email or username, now insert the user
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $password]);

            // Redirect to login page after successful registration
            header("Location: http://localhost:8000/authentication/login.php");
            exit();
        }
    }
}
?>
