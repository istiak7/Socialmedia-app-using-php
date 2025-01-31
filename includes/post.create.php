<?php
session_start();

require 'class/post.class.php';
require '../core/Database.php';

$database = new Database();
$post = new Post($database);

try {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $user_id = $_SESSION['user_id'];
        $content = htmlspecialchars($_POST['content']);
        $post->createPost($user_id,$content);  // method call in Post class 
        header("Location: http://localhost:8000");
         
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
