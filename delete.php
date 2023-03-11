<?php

include "server.php"; // Using database connection file here




$id = $_GET['transactionID']; 
$del = "SELECT * FROM transactions WHERE transactionID = '$id'";
$result = mysqli_query($db, $del);
$row = $result->fetch_assoc();
$currentBalance = $_SESSION['balance'];

if($del)
{
    if ($row['transactionType'] == "Cash-Out")
    {
        $currentBalance = $currentBalance + (FLOAT)$row['amount'];
    }
    
    if ($row['transactionType'] == "Cash-In")
    {
        $currentBalance = $currentBalance - (FLOAT)$row['amount'];
    }
    mysqli_query($db,"DELETE FROM transactions WHERE transactionID = '$id'"); 
    $sql = "UPDATE users set balance = '{$currentBalance}' WHERE username = '{$_SESSION['username']}'";    
    mysqli_query($db, $sql);
    $_SESSION['balance'] = $currentBalance;
    $_SESSION['success'] = "Transaction has been successfully deleted. Your balance has also been updated accordingly.";
    header('location:Main/homePage.php');
}



else
{
    echo "Error deleting record"; // display error message if not delete
}


?>