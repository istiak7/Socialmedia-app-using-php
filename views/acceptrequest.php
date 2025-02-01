<?php

$sender_id = $_POST['sender_id'];;

$receiver_id = $_POST['receiver_id'];

// echo $sender_id . " " . $receiver_id ."\n";
// die();

require '../core/Database.php';
require '../includes/class/user.class.php';

$database = Database::getInstance();
$conn = $database->getConnection();
$user = new User($database);

    try {
        if($user->acceptFriendRequest($sender_id , $receiver_id)){
            echo "successfully request Accepted!";
            header("Location: http://localhost:8000/views/seefriendrequest.php");
        }
    } 
    
    catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }