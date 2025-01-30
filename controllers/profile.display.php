
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./poststyle/post_view.css">
    <title>Document</title>
</head>
<body>
<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    <div class="inner_post">
                <strong>Username:</strong> <?= htmlspecialchars($_SESSION['name']) ?> 
                <br>
                <strong>Email:</strong> <?= htmlspecialchars($_SESSION['email']) ?>
          </div>
    </div>
  </main>
</body>
</html>