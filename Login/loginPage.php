<?php include('../server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <div class="form-box">
        <h2>Login</h2>
        <form method="post" action="loginPage.php">
            <!-- Display validation errors here -->
            <?php include('../errors.php'); ?>

            <div class="user-box">
                <input type="text" name="username" required="">
                <label>Username</label>
            </div>
            
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>

            <a href="#">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <input class="submit" type="submit" class="input" value="LOGIN" name="login" />
            </a>

            <p>
            <a href="../Registration/registrationPage.php">Don't have an Account? Click here to Register.</a>
            </p>
        </form>
    </div>
</body>
</html>
