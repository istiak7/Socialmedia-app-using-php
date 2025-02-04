<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://matcha.mizu.sh/matcha.css">
    <title>signup</title>
</head>

<body>
    <h1 style="text-align:center">Registration page</h1>
    <form action="signup.create.php" method="post">
        
        <input type="text" name="username" placeholder="Username">
        <?php if (isset($_SESSION['username_error'])) { ?>
            <p style="color: red;"><?php echo $_SESSION['username_error']; ?></p>
            <?php unset($_SESSION['username_error']) ?>
        <?php } ?>

        <input type="password" name="password" placeholder="Password">
        <?php if (isset($_SESSION['password_error'])) { ?>
            <p style="color: red;"><?php echo $_SESSION['password_error']; ?></p>
            <?php unset($_SESSION['password_error']) ?>
        <?php } ?>

        <input type="email" name="email" placeholder="E-mail">
        <?php if (isset($_SESSION['email_error'])) { ?>
            <p style="color: red;"><?php echo $_SESSION['email_error']; ?></p>
            <?php unset($_SESSION['email_error']) ?>
        <?php } ?>

        <button type="input">signup</button>
    </form>
</body>

</html>