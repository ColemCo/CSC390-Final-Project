<!--  Cooper Coleman
    11/24/2020
    CSC390
    Project 4 -->
    
    <?php
    include 'sqlConnect.php';

function isLoggedIn()
{
    if(!isset($_SESSION['user_id']))
    {
        redirectToLogin();
    }
    else
        return true;
    
}

function authenticate($useremail, $password)
{
    $dbh = connectSQL();

    $sql = "
    SELECT * FROM `user` WHERE `email` = :e ";

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':e', $useremail);

    $success = $stmt->execute();
    $user = $stmt->fetch();

    if(!$success)
    {
        echo 'Didnt work';
        exit;
        return false;
    }

    if(!boolval($user))
    {
        return false;
    }

    if(password_verify($password, $user['password_hash']))
    {
        logUserIn($user['user_id'], $useremail);
        
        return true;
    }
    else
    {
        return false;
    }

}

function addUser($name, $email, $pass)
{
    $dbh = connectSQL();

    $sql = "
    INSERT INTO user (name, email, password_hash)
    VALUES (:name, :email, :password_hash) ";

    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password_hash', password_hash($pass, PASSWORD_DEFAULT));

    $success = $stmt->execute();

    if($success)
    {
        header('Location: login.php');
    }
    else
    {
        echo 'That didnt work lmao';
    }
}


function logUserIn($userID, $userEmail)
{
    $_SESSION['user_id'] = $userID;
    $_SESSION['email'] = $userEmail;
}


function logout()
{
    session_destroy();
    redirectToLogin();
}

function redirectToLogin()
{
    header("location:login.php");
}