<?php
require '../core/Database.php';
$database = new Database();
$conn = $database->getConnection();

    try {
        
        $stmt = $conn->prepare("SELECT comments.post_id,comments.content,comments.created_at,users.username
        FROM comments
        INNER JOIN users ON comments.user_id = users.id");
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
    <link rel="stylesheet" href="../poststyle/post_view.css">
    <title>Posts</title>
</head>
<body>
<?php $flag = false?>
<?php foreach ($posts as $post): ?>
        <?php if($post['post_id'] ==  $_GET['post_id']): ?>
           <?php $flag = true ?>
       <div class="inner_post">
              <?= htmlspecialchars($post['content'])?>
                <br>
                <strong>Author:</strong> <?= htmlspecialchars($post['username']) ?> 
                <br>
                <strong>Created at:</strong> <?= htmlspecialchars($post['created_at']) ?>
                <br><br>
          </div>
          <br><br> 
        <?php endif;?>   
<?php endforeach; ?>
<?php if($flag == false) echo "No Existing Comment!"?>
</body>
</html>