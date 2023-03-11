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
    <title>Record Transaction Page</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>  
    <div class ="main-pages">
        <div class="topnav">
            <a href="homePage.php">Home</a>
            <a class="active" href="addTransactionPage.php">Record Transaction</a>
            <a href="allTransactionsPage.php">View All Transactions</a>
            <a href="homePage.php?logout='1'" style="float: right;">Logout</a>
        </div> 

        <div class="form-box">
            <form method="post" action="addTransactionPage.php">
                    
            <!-- Display validation errors here -->
            <?php include('../errors.php'); ?>

            <div class="user-box">
                <label for="transactionType">Transaction Type:</label><br><br>
                <select name="transactionType" id="transactionType">
                    <option value="Cash-In">Cash-In</option>
                    <option value="Cash-Out">Cash-Out</option>
                </select> 
            </div>
            <br><br>

            <div class="user-box">
                <input type="text" name="transactionDescription" required="" value="<?php echo $transactionDescription; ?>">
                <label>Transaction Description/Name:</label>
            </div>

            <span style="color:white">
                <label>Transaction Date:</label>
                <input type="date" name="transactionDate" required="" placeholder="MM-DD-YYYY" value="<?php echo $transactionDate; ?>">                
            </span> 
            <br><br>

            <div class="user-box">
                <input type="text" name="amount" required="" id="amount">
                <label>Amount:</label>
            </div>

            <a href="#">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <input class="submit" type="submit" class="input" value="Record Transaction" name="transactionSubmit" />
            </a>         
        </form>
    </div>

            

    </div>

</body>
</html>
