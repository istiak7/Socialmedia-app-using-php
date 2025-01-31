<?php

require './core/Database.php';
$database = new Database();
$conn = $database->getConnection();

    // Fetch user data from database
    try {
        // Prepare and execute query
        $stmt = $conn->prepare("SELECT posts.post_id,posts.content,posts.created_at,users.username
        FROM posts
        INNER JOIN users ON posts.user_id = users.id");
        $stmt->execute();
       
        
        // Fetch all rows as associative array
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        

    } catch (PDOException $e) {
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
                 <?= htmlspecialchars($post['content'])?>
                <br>
                <strong>Author:</strong> <?= htmlspecialchars($post['username']) ?> 
                <br>
                <strong>Created at:</strong> <?= htmlspecialchars($post['created_at']) ?>
                <br><br>
                <span class="comment"><a href="views/comment.view.php?post_id=<?= $post['post_id']; ?>">Comment</a></span>

                <span class="comment"> <a href="views/display.comment.php?post_id=<?= $post['post_id']; ?>" >see all comments</a></span>
          </div>
          <br><br> 
           
<?php endforeach; ?>

</body>
</html>