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
    <title>View All Transaction Page</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>  
    <div class ="main-pages">
        <div class="topnav">
            <a href="homePage.php">Home</a>
            <a href="addTransactionPage.php">Record Transaction</a>
            <a class="active" href="allTransactionsPage.php">View All Transactions</a>
            <a href="homePage.php?logout='1'" style="float: right;">Logout</a>
        </div> 
        
        <?php if (isset($_SESSION['username'])): ?>
            <br><br>
            <p style="color:white">Hello, <strong><?php echo $_SESSION["name"]; ?></strong>! Here are all your records of transactions:</p>
            <br><br>
        <?php endif ?>
        
        <span style="color:white" overflow-y: scroll;>
        <?php
            $query = "SELECT * FROM transactions WHERE userID='{$_SESSION['userID']}'";  
            $result = mysqli_query($db, $query);

                  
            echo "<table style='width:100%; text-align: center'>";
    
            echo "<tr><td style='color:gold'>Transaction Date (YYYY-MM-DD)<td style='color:gold'>";
            echo "Transaction Type</td><td style='color:gold'>";
            echo "Transaction Description</td><td style='color:gold'>";
            echo "Amount</td><td style='color:gold'>";
            echo "Previous Balance</td><td style='color:gold'>";
            echo "New Balance</td><td style='color:gold'>";
            echo "Delete</td></tr>";
        
            while($row = $result->fetch_assoc())
            {   //Creates a loop to loop through results
                echo "<tr><td>". $row['transactionDate'] . "</td><td>";
                echo $row['transactionType'] . "</td><td>";
                echo $row['transactionDescription'] . "</td><td>";
                echo $row['amount'] . "</td><td>";
                echo $row['previousBalance'] . "</td><td>";
                echo $row['newBalance'] . "</td><td>";
                ?>
                <a href="../delete.php?transactionID=<?php echo $row['transactionID']?>" style='color:white;'>Delete</a></td></tr>
            <?php
            }
            ?>

        <?php echo "</table>" ?>
        </span>  
    </div>

    
</body>
</html>
