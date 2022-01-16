<!--  Cooper Coleman
    11/24/2020
    CSC390
    Project 4 -->
<?php
function createList($listName)
{
    $dbh = connectSQL();
    date_default_timezone_set('America/Chicago');
    $createdDate = date('Y-m-d h:m:s');

    $sql = '
    INSERT INTO `list` (user_id, date_created, title)
    VALUES (:user_id, NOW(), :title)
    ';

    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':user_id', $_SESSION['user_id']);
    $stmt->bindValue(':title', $listName);

    $success = $stmt->execute();

    if(!$success)
    {
        echo 'Adding to List failed';
        die;
    }

}

function deleteList($id)
{
    $dbh = connectSQL();

    $sql = '
    DELETE FROM `task` WHERE list_id = :id
    ';

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id);
   
    $success = $stmt->execute();

    $sql = '
    DELETE FROM `list` WHERE list_id = :id
    ';

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id);
   
    $success2 = $stmt->execute();


    if(!$success || !$success2)
    {
        var_dump($success);
        var_dump($success2);
        echo 'Deleting list failed';
        die;
    }

}

function addTask($description, $listID)
{
    $dbh = connectSQL();

    $sql = '
    INSERT INTO `task` (description, date_created, list_id)
    VALUES (:desc, NOW(), :id)
    ';

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':desc', $description);
    $stmt->bindValue(':id', $listID);

    $success = $stmt->execute();

    if(!$success)
    {
        echo 'Adding Task Failed';
        die;
    }

}

function removeTask($id)
{
    $dbh = connectSQL();
    
    $sql = '
    DELETE FROM `task` WHERE task_id = :id
    ';

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id);

    $success = $stmt->execute();

    if(!$success)
    {
        echo 'Deleting task failed';
        die;
    }
}

function completeTask($id)
{
    $dbh = connectSQL();

    $sql = '
    UPDATE `task` SET `date_completed` = NOW() WHERE `task_id` = :id
    ';

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id);

    $success = $stmt->execute();

    if(!$success)
    {
        echo 'Completing Task Failed';
        die;
    }
}