<?php

require './core/Database.php';
$database = Database::getInstance();
$conn = $database->getConnection();

try {

    $limit = 3; // per page number of post
    $result = $conn->query("SELECT COUNT(post_id) AS total FROM posts");
    $row = $result->fetch();
    $total_post = $row['total'];

    $total_pages = ceil($total_post / $limit);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;


    $stmt = $conn->prepare("SELECT posts.post_id,posts.content,posts.created_at,users.username
        FROM posts
        INNER JOIN users ON posts.user_id = users.id 
        LIMIT $start, $limit");
    $stmt->execute();
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
            <?= htmlspecialchars($post['content']) ?>
            <br>
            <strong>Author:</strong> <?= htmlspecialchars($post['username']) ?>
            <br>
            <strong>Created at:</strong> <?= htmlspecialchars($post['created_at']) ?>
            <br><br>
            <span class="comment"><a href="views/comment.view.php?post_id=<?= $post['post_id']; ?>">Comment</a></span>

            <span class="comment"> <a href="views/display.comment.php?post_id=<?= $post['post_id']; ?>">see all comments</a></span>
        </div>
        <br><br>
    <?php endforeach; ?>



    <?php if ($page > 1) { ?>
        <a href="?page=<?php echo $page - 1; ?>">Previous</a>
    <?php } ?>

    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'style="font-weight: bold;"'; ?>>
            <?php echo $i; ?>
        </a>
    <?php } ?>

    <?php if ($page < $total_pages) { ?>
        <a href="?page=<?php echo $page + 1; ?>">Next</a>
    <?php } ?>


</body>
</html>
