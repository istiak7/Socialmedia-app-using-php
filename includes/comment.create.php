<?php

session_start();

require '../core/Database.php';
require 'comment.class.php';

$db = new Database();
$comment = new Comment($db);

try {
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $user_id = $_SESSION['user_id'];
        $content = htmlspecialchars($_POST['content']);
        $post_id =  htmlspecialchars($_POST['post_id']);
        
        $comment->createComment($user_id , $post_id , $content);

        header("Location: http://localhost:8000");

    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
