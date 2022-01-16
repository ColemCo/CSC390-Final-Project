<!--  Cooper Coleman
    11/24/2020
    CSC390
    Project 4 -->
<?php
session_start();
include 'UserAuthenticator.php';
include 'databaseAccess.php';

if(!isset($_SESSION['user_id']))
{
    header('location: login.php');
}

if(isset($_POST['newList']))
{
    $listName = $_POST['newList'];
    createList($listName);
}

if(isset($_GET['delete']))
{
    deleteList($_GET['delete']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
    <title>To-Do List</title>
</head>
<body>
    <div class='wholePage'>
        <div class='header'>
            <p>
            <h1>Project 4: To-Do List</h1>
            </p>
            <p>
                <h2>To-Do-List for: <?php echo $_SESSION['email']; ?> </h2>

                <form method="get" action='logout.php'>
                    <button class='myButton' type='submit'>Logout</button>
                </form>
            </p>
        </div>
        <br>
        <div class='mainBody'>
            <h3 style='padding-left: 15px;'>Create new list:
                <form method="post">
                    <input type="text" name="newList">
                    <button>Add List</button>
                </form>
            </h3>
            <br>
            <div class="showList">
                    <?php
                        $dbh = connectSQL();
                        $sql = 'SELECT * FROM list WHERE user_id = :ID';
                        $stmt = $dbh->prepare($sql);
                        $stmt->bindValue(':ID', $_SESSION['user_id']);

                        $success = $stmt->execute();
                        
                        if(!$success)
                        {
                            echo 'Showing List Query Failed';
                            die; 
                        }

                        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                        {
                            echo '<div class="list">';
                            echo '<h2>' . $row['title'] . '</h2>';
                            echo '<hr>';
                            echo '<p> Created on ' . $row['date_created'] . '</p>';
                            echo '<h3><a href="viewList.php?id='. $row['list_id'] . '&lname= '. $row['title'] .'"> Go to list</a>   &nbsp&nbsp   <a href="deleteList.php?id='. $row['list_id'] . '"> Delete</a> </h3>';
                           
                            echo '</div>';
                            echo '<br>'; 
                        }
                    
                    ?>
            </div>
        </div>
    </div>
</body>
</html>