<?php 
session_start();

$user_name = $_SESSION['name'];

require_once __DIR__ . '/../../core/Database.php';

$database = Database::getInstance();
$conn = $database->getConnection();

    try {  
        //"SELECT * FROM friend_requests WHERE (sender_id = :user_id OR receiver_id = :user_id) AND status = 'accepted'");

        $user_id = $_SESSION['user_id'];
        $stmt = $conn->prepare(
            "SELECT username FROM users
            INNER JOIN friend_requests ON
            friend_requests.sender_id = users.id AND friend_requests.receiver_id = :user_id
            OR
            friend_requests.receiver_id = users.id AND friend_requests.sender_id = :user_id

            WHERE friend_requests.status = 'accepted'
            ");
        // Bind the user_id parameter to the placeholder
         $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } 
    catch (PDOException $e) {

        die("Query failed: " . $e->getMessage());
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
   <link rel="stylesheet" href="./poststyle/post_view.css">
</head>
<body>

<?php foreach ($posts as $post): ?>

       <div class="inner_post">
                
                <?php

                //  if($post['sender_name'] != $user_name){
                //    echo $post['sender_name'];
                //  }
                //  else{
                //     echo $post['receiver_name']; 
                //  }
                 echo $post['username'];
                 ?> 
               
              
        </div>
           
<?php endforeach; ?>

</body>
</html>