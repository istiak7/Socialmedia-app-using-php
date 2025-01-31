<?php 
session_start();

require '../core/Database.php';

$database = new Database();
$conn = $database->getConnection();

    try {

        $user_id = $_SESSION['user_id'];
        $stmt = $conn->prepare("SELECT users.username
        FROM users
        INNER JOIN friendships ON friendships.receiver_id = users.id");
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
                 <li><?= htmlspecialchars($post['username']) ?> </li>
        </div>
           
<?php endforeach; ?>

</body>
</html>