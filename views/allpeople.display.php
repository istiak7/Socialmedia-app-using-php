<?php 
session_start();

require '../core/Database.php';

$database = Database::getInstance();
$conn = $database->getConnection();

    try {

        $user_name = $_SESSION['name'];
        //echo $user_name . "\n";
        $stmt = $conn->prepare("SELECT username , id FROM users WHERE username != :user_name");
        $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR); 
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
                 <li><?= htmlspecialchars($post['username']) ?> 
                 <form action="friendrequest.php" method="post">
                 <input type="hidden" name="reciver_id" value="<?= $post['id'] ?>">
                 <button type="input">Add</button>
                 </form>
                
                </li>
        </div>
           
<?php endforeach; ?>

</body>
</html>