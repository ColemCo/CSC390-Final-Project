<!--  Cooper Coleman
    11/24/2020
    CSC390
    Project 4 -->
    
    <?php
    session_start();
    include 'UserAuthenticator.php';
    if(isset($_SESSION['user_id']))
    {
        header('location: index.php');
    }
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class='header'>
        <p>
           <h1>Project 4: To-Do List</h1>
        </p>

    </div>
    <br>
    <div class="loginContainer">
        <h2>Login</h2>
        
        <?php
            if(isset($_POST['useremail']) && isset($_POST['password'])){
                $useremail = $_POST['useremail'];
                $password = $_POST['password'];
                $result = authenticate($useremail, $password);
        
                if($result)
                {
                    header("location: index.php");
                }
                else
                {
                    echo "<p style='color: red;'>Wrong email or password.</p>";
                }
            }
        ?>
        <form method="post">
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
            <button class="myButton">Login</button>
        </form>
        <p>
            <h2>If you dont have an account</h2>
            <a href="UserRegistration.php">Click here to register</a>
        </p>
    </div>    
</body>
</html>