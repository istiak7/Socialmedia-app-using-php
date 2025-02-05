<?php

session_start();

require_once __DIR__.'/../../core/Database.php';

$database = Database::getInstance();
$conn = $database->getConnection();

    try {

        $user_name = $_SESSION['name'];
        $user_id = $_SESSION['user_id'];
        //echo $user_id . "\n";die();
        $stmt = $conn->prepare(

           "SELECT users.username ,friend_requests.sender_id , friend_requests.receiver_id
            FROM users 
            INNER JOIN friend_requests 
            ON (friend_requests.receiver_id = :user_id) AND (users.id = sender_id)
            WHERE friend_requests.status = 'pending'

        ");
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
   <link rel="stylesheet" href="/poststyle/post_view.css">
</head>
<body>

<?php foreach ($posts as $post): ?>
    <div class="inner_post">
    <li>
        <?= htmlspecialchars($post['username']) ?>  
        <form action="acceptrequest.php" method="post">
            <input type="hidden" name="receiver_id" value="<?= htmlspecialchars($post['receiver_id']) ?>">
            <input type="hidden" name="sender_id" value="<?= htmlspecialchars($post['sender_id']) ?>">
            <button type="submit"class="addButton">Confirm</button>
        </form>
        <form action="declinerequest.php" method="post">
            <input type="hidden" name="receiver_id" value="<?= htmlspecialchars($post['receiver_id']) ?>">
            <input type="hidden" name="sender_id" value="<?= htmlspecialchars($post['sender_id']) ?>">
            <button type="submit"class="declineButton">Decline</button>
        </form>
    </li>
</div>

           
<?php endforeach; ?>

</body>
</html>