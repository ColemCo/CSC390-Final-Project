<?php

include 'databaseAccess.php';
include 'sqlConnect.php';

deleteList($_GET['id']);

header('location: index.php');