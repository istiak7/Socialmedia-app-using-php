<?php
session_start();
$user_name = $_SESSION['name'];

if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost:8000/authentication/login.php"); // Redirect to login page if not authenticated
    exit();
}
$heading = "Friendlist";
require "views/friends.view.php";