<?php

session_start();

require '../core/Database.php';
require 'class/comment.class.php';

$db = Database::getInstance();
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
