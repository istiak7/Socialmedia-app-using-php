<?php $post_id = $_GET['post_id'];?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://matcha.mizu.sh/matcha.css">
    <title>signin</title>
</head>
<body>
    <h1 style="text-align:center">Comment on post</h1>
    <form action="../includes/comment.create.php" method="post">
    <input type="hidden" name="post_id" value="<?= $post_id; ?>">
        <textarea name="content" id=""></textarea>
        <button type="input">sent</button>
    </form>
</body>
</html>