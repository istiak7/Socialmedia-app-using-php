<?php
session_start();
$sender_id = $_SESSION['user_id'];
$receiver_id = $_POST['receiver_id'];
$sender_name = $_SESSION['name'];
$receiver_name = $_POST['receiver_name'];

 //echo $receiver_name ." " . $sender_name;die();
require_once __DIR__. '/../../core/Database.php';
// require '.../includes/class/user.class.php';
require_once __DIR__.'/../../includes/class/user.class.php';

$database = Database::getInstance();
$conn = $database->getConnection();
$user = new User($database);

    try {
       
        if($user->sendFriendRequest($sender_id , $receiver_id) == "sent request"){
            echo "successfully request sent!";
        }
        else if($user->sendFriendRequest($sender_id , $receiver_id) == 'already friend'){
            echo "you are already friend!";
        }
        else {
            echo "friend request already exist!";
        }
        
    } 
    
    catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }