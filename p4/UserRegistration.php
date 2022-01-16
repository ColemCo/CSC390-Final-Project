<!--  Cooper Coleman
    11/24/2020
    CSC390
    Project 4 -->
<?php
    session_start();
    include 'UserAuthenticator.php';

    if(isset($_POST['useremail']) && isset($_POST['password']) && isset($_POST['passwordConfirm']) && isset($_POST['name']))
    {
        $user = $_POST['useremail'];
        $pass = $_POST['password'];
        $confpass = $_POST['passwordConfirm'];

        if($pass !== $confpass)
        {
            echo 'Passwords need to match!';
        }
        else
        {
            addUser($_POST['name'] ,$user, $pass);
        }
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Create an Account</title>
</head>
<body >
    <div class='header'>
        <p>
           <h1>Project 4: To-Do List</h1>
        </p>
    </div>
    <br>
    <div class='loginContainer'>
        <form method="post">
            <p>
                Name:
                <br>
                <input type="text" name='name'>
            </p>
            <p>
                Email:
                <br>
                <input type="text" name="useremail">
            </p>
            <p>
                Password:
                <br>
                <input type="password" name="password">
            </p>
            <p>
                Confirm Password:
                <br>
                <input type="password" name="passwordConfirm">    
            </p>
                <button class="myButton">Create Account</button>
        </form>
        <br>
    </div>
</body>
</html>