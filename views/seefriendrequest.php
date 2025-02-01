<?php

session_start();

require '../core/Database.php';

$database = Database::getInstance();
$conn = $database->getConnection();

    try {

        $user_name = $_SESSION['name'];
        $user_id = $_SESSION['user_id'];
        //echo $user_id . "\n";die();
        $stmt = $conn->prepare("SELECT sender_name,sender_id , receiver_id FROM friend_requests WHERE receiver_id = :user_id AND status = 'pending'");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR); 
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
    <li>
        <?= htmlspecialchars($post['sender_name']) ?>  
        <form action="acceptrequest.php" method="post">
            <input type="hidden" name="receiver_id" value="<?= htmlspecialchars($post['receiver_id']) ?>">
            <input type="hidden" name="sender_id" value="<?= htmlspecialchars($post['sender_id']) ?>">
            <button type="submit">Confirm</button>
        </form>
    </li>
</div>

           
<?php endforeach; ?>

</body>
</html>