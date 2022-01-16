<!--  Cooper Coleman
    11/24/2020
    CSC390
    Project 4 -->
<?php
    session_start();
    include 'sqlConnect.php';
    include 'databaseAccess.php';
    if(isset($_POST['newTask']))
    {
        addTask($_POST['newTask'], $_GET['id']);
    }

    if(isset($_POST['delete']))
    {
        removeTask($_POST['delete']);
    }

    if(isset($_POST['complete']))
    {
        completeTask($_POST['complete']);
    }
    
    if(isset($_POST['logout']))
    {
        header('location: logout.php');
    }
    if(isset($_POST['viewLists']))
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
    <title>To-Do List</title>
</head>
<body>
    <div class='header'>
        <p>
           <h1>Project 4: To-Do List</h1>
        </p>
        <p>
            <h2>To-Do-List for: <?php echo $_SESSION['email']; ?> </h2>
            <p>
                <div style='text-align: center;'>
                    
                    <form method="post" >
                        <button class='myButton' name='logout'>Logout</button>
                        <button class='myButton' name='viewLists'>View Lists</button>
                    </form>
                </div>
            </p>
        </p>
    </div>
    <br>
    <div class='mainBody'>
            <h3 style='padding-left: 15px;'>Create new task:
                <form method="post">
                    <input type="text" name="newTask">
                    <button>Add Task</button>
                </form>
            </h3>
            <br>
            <?php echo '<h2>'.  $_GET['lname'] .'</h2>' ?>
            <div class="expandList">
                <table>
                    <tr>
                        <th>Task ID</th>
                        <th>Description</th>
                        <th>Date Created</th>
                        <th>Date Completed</th>
                        <th>Actions</th>
                    </tr>
                    <br>
                    <?php
                        $dbh = connectSQL();
                        $sql = 'SELECT * FROM task WHERE list_id = :ID';
                        $stmt = $dbh->prepare($sql);
                        $stmt->bindValue(':ID', $_GET['id']);

                        $success = $stmt->execute();
                        
                        if(!$success)
                        {
                            echo 'Showing Task Query Failed';
                            die; 
                        }
        
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                        {
                            echo '<tr>'; 
                            echo '<td>'. $row['task_id'] .'</td>';
                            echo '<td>'. $row['description'] .'</td>';
                            echo '<td>'. $row['date_created'] .'</td>';
                            echo '<td>'. $row['date_completed'] .'</td>';
                            echo '<td> 
                            <form method="post"> 
                                <button value="' . $row['task_id'] . ' " name="delete">Delete</button>
                                <button value="' . $row['task_id'] . ' " name="complete">Finish</button>
                            </form> </td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
</body>
</html>