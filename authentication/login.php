<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://matcha.mizu.sh/matcha.css">
    <title>signin</title>
</head>
<body>
    <h1 style="text-align:center">Login page</h1>
    <form action="login.create.php"  method="post">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="password">
        <?php if(isset($_SESSION['login_error'])){ ?>
           <p style="color: red;margin-bottom:0%"><?php echo $_SESSION['login_error']; 
           unset($_SESSION['login_error'])?></p>
      <?php }?>
        <button type="input">Submit</button>
        <div><span><a href="../authentication/signup.php">Create a account</a></span></div>
    </form>
</body>
</html>