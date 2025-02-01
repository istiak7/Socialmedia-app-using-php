<?php
session_start();
$sender_id = $_SESSION['user_id'];

$reciver_id = $_POST['reciver_id'];

require '../core/Database.php';
require '../includes/class/user.class.php';

$database = Database::getInstance();
$conn = $database->getConnection();
$user = new User($database);

    try {
        $sender_name = $_SESSION['name'];
        if($user->sendFriendRequest($sender_name , $sender_id , $reciver_id)){
            echo "successfully request sent!";
        }
        else {
            echo "friend request already exist!";
        }
        
    } 
    
    catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }