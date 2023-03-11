<?php include('../server.php');

    //If the user is not logged in, they cannot access this page
    if (empty($_SESSION['username']))
    {
        header('location:../Login/loginPage.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>  
    
    <div class ="main-pages">
        <div class="topnav">
            <a class="active" href="homePage.php">Home</a>
            <a href="addTransactionPage.php">Record Transaction</a>
            <a href="allTransactionsPage.php">View All Transactions</a>
            <a href="homePage.php?logout='1'" style="float: right;">Logout</a>

        </div>

        <br><br><br>
        <?php if (isset($_SESSION['success'])): ?>
                <div class="error success">
                    <h3>
                        <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        ?>
                    </h3>
                </div>
        <?php endif ?>
        
        <?php if (isset($_SESSION['username'])): ?>
            <br><br>
            <p style="color:white">Welcome Back, <strong><?php echo $_SESSION["name"]; ?></strong>!</p>
            <p style="color:white">You currently have <span id="currentbalance" style="color:gold;font-weight:bold"><?php echo $_SESSION["balance"]; ?> pesos</span> in your account!</p>
            
        <?php endif ?>
    </div>

  

</body>
</html>
