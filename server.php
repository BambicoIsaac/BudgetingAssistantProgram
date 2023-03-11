<?php
    session_start();
    $name = "";
    $username = "";
    $transactionType = "";
    $transactionDescription = "";
    $transactionDate = "";
    $errors = array();

    //To connect to the database
    $db = mysqli_connect('localhost', 'root', '', 'budgetingassistanceprogram');

    //Add data to database when the register button is clicked
    if (isset($_POST['register']))
    {
        $name = mysqli_real_escape_string($db,$_POST['name']);
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $balance = mysqli_real_escape_string($db,$_POST['balance']);
        $password_1 = mysqli_real_escape_string($db,$_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db,$_POST['password_2']);  
        
        //Error Handling
        if (empty($name))
        {
            array_push($errors, "Name is required.");
        }

        if (empty($username))
        {
            array_push($errors, "Username is required.");
        }
        
        if (empty($password_1))
        {
            array_push($errors, "Password is required.");
        }

        if ($password_1 != $password_2)
        {
            array_push($errors, "Passwords do not match.");
        }

        if (is_numeric($balance) == false)
        {
            array_push($errors, "Please enter numeric value for Add Initial Balance field");
        }

        $query = "SELECT * FROM users WHERE username='$username'";       
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) > 0)
        {
            array_push($errors, "Sorry that username already exists.");
        }
        
        //If there are no errors, then we put the inputted data into the database and also logs in the registered user.
        if (count($errors) == 0)
        {
            $password = md5($password_1); //md5 is used to encrpyt the password
            $sql = "INSERT INTO users (username, name, balance, password)
                    VALUES ('$username', '$name', '$balance', '$password')";
            mysqli_query($db, $sql);

            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";       
            $result = mysqli_query($db, $query);
            $row = $result->fetch_assoc();

            $_SESSION['username'] = $username;
            $_SESSION['name'] = $name;
            $_SESSION['balance'] = $balance;
            $_SESSION['userID'] = $row['userID'];
            $_SESSION['success'] = "You are now logged in";

            header('location: ../Main/homePage.php');
        }
    }

    //Log User in from login page and direct to home page upon successful login.
    if (isset($_POST['login']))
    {
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $password = mysqli_real_escape_string($db,$_POST['password']);
    
        //Ensure that all fields have been filled in
        if (empty($username))
        {
            array_push($errors, "Username is required.");
        }
        
        if (empty($password))
        {
            array_push($errors, "Password is required.");
        }

        if (empty($password))
        {
            array_push($errors, "Password is required.");
        }

        if (count($errors) == 0)
        {
            $password = md5($password);
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";       
            $result = mysqli_query($db, $query);
            $row = $result->fetch_assoc();
                   
            if (mysqli_num_rows($result) == 1)
            {
                //Log User in
                $_SESSION['username'] = $username;
                $_SESSION['name'] = $row['name'];
                $_SESSION['balance'] = $row['balance'];
                $_SESSION['password'] = $password;
                $_SESSION['userID'] = $row['userID'];
                $_SESSION['success'] = "You are now logged in";                
                header('location: ../Main/homePage.php');
            }
            else
            {
                array_push($errors, "Wrong username/password combination.");    
            }  
       
        }
    }

    //Add record of transaction to the database
    if (isset($_POST['transactionSubmit']))
    {
        $transactionType = mysqli_real_escape_string($db,$_POST['transactionType']);
        $transactionDescription = mysqli_real_escape_string($db,$_POST['transactionDescription']);
        $transactionDate = date('Y-m-d', strtotime(mysqli_real_escape_string($db,$_POST['transactionDate'])));
        $amount = mysqli_real_escape_string($db,$_POST['amount']);
        $currentBalance = $_SESSION['balance'];
        
        
        //Ensure that all fields are filled up*/
        if (empty($transactionType))
        {
            array_push($errors, "Transaction Type is required.");
        }

        if (empty($transactionDescription))
        {
            array_push($errors, "Transaction Description is required.");
        }

        if (empty($transactionDate))
        {
            array_push($errors, "Transaction Date must be specified.");
        }

        if (empty($amount))
        {
            array_push($errors, "Amount is required.");
        }

        if (is_numeric($amount) == false)
        {
            array_push($errors, "Please enter numeric value for the amount.");
        }
        
        if ($transactionType == 'Cash-Out'){
            if ($currentBalance < $amount){
                array_push($errors, "I am sorry but we can not proceed with this transaction as doing so would put your balance below 0.");
            }            
        }

    
        //If there are no errors, then we put the inputted data into the database.
        if (count($errors) == 0)
        {
            $previousBalance = $currentBalance;
            if ($transactionType == 'Cash-In'){
                $newBalance = $currentBalance + $amount;
            }
            else if ($transactionType == 'Cash-Out'){
                $newBalance = $currentBalance - $amount;
            }

            $currentBalance = $newBalance;
            $previousBalancePasok = mysqli_real_escape_string($db,$previousBalance);
            $newBalancePasok = mysqli_real_escape_string($db,$newBalance);
            
            $sql = "INSERT INTO transactions (userID, transactionType, transactionDescription, transactionDate, amount, previousBalance, newBalance)
                    VALUES ('{$_SESSION['userID']}', '$transactionType', '$transactionDescription', '$transactionDate', '$amount', '$previousBalancePasok', '$newBalancePasok')";
  
            mysqli_query($db, $sql);

            $sql = "UPDATE users set balance = '{$currentBalance}' WHERE username = '{$_SESSION['username']}'";    
            mysqli_query($db, $sql);

            $_SESSION['balance'] = $currentBalance;
            $_SESSION['success'] = "Transaction has been successfully recorded";
            
            header('location: ../Main/homePage.php');
        }
    }
        


    //Upon Log-Out
    if (isset($_GET['logout']))
    {
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['name']);
        unset($_SESSION['userID']);
        header('location: ../Login/loginPage.php');
    }
    
?>