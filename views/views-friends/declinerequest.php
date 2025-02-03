<?php

$sender_id = $_POST['sender_id'];;

$receiver_id = $_POST['receiver_id'];

// echo $sender_id . " " . $receiver_id ."\n";
// die();

require_once __DIR__. '/../../core/Database.php';
require_once __DIR__.'/../../includes/class/user.class.php';

$database = Database::getInstance();
$conn = $database->getConnection();
$user = new User($database);

    try {
        if($user->declineFriendRequest($sender_id , $receiver_id)){
            echo "successfully request decline!";
            header("Location: http://localhost:8000/views/views-friends/seefriendrequest.php");
        }
    } 
    
    catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }