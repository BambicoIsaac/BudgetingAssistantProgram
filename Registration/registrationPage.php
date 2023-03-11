<?php include('../server.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <div class="form-box">
        <h2>Register</h2>
        <form method="post" action="registrationPage.php">
            
        <!-- Display validation errors here -->
        <?php include('../errors.php'); ?>

        <div class="user-box">
            <input type="text" name="name" required="" value="<?php echo $name; ?>">
            <label>Name:</label>
        </div>

        <div class="user-box">
            <input type="text" name="username" required="" value="<?php echo $username; ?>">
            <label>Username:</label>
        </div>

        <div class="user-box">
            <input type="password" name="password_1" required="" id="password1">
            <label>Password:</label>
        </div>
        
        <div class="user-box">
            <input type="password" name="password_2" required="" id="password2">
            <label>Confirm Password:</label>
        </div>

        <div class="indent">
            <input type="checkbox" onclick="myFunction()">
            <label style="color:white;">Show Passwords</label>
        </div>

        <br><br>

        <div class="user-box">
                <input type="text" step="any" min="0" name="balance" required="" id="balance" onfocus="showWarning()" onblur="normalMessage()"/>
                <label id="warning">Add Initial Balance:</label>
        </div>

            <a href="#">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <input class="submit" type="submit" class="input" value="Register" name="register" />
            </a>         

        <script>
            function myFunction()
            {
                var x = document.getElementById("password1");
                var y = document.getElementById("password2");
                if (x.type === "password" && y.type === "password")  {
                    x.type = "text";
                    y.type = "text";
                    
                } else {
                    x.type = "password";
                    y.type = "password";
                }
            }

            function showWarning(){
                document.getElementById('warning').innerHTML = 'Add Initial Balance: (If you do not want to deposit an initial balance, simply type 0.)';        
            }

            function normalMessage(){
                document.getElementById('warning').innerHTML = 'Add Initial Balance:';
            }
        </script>

        <p>
            <a href="../Login/loginPage.php">Already have an Account? Click here to Log In.</a>
        </p>
        </form>
    </div>
</body>
</html>