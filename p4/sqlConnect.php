<!--  Cooper Coleman
    11/24/2020
    CSC390
    Project 4 -->
<?php

function connectSQL()
{
    $SQLuser = 'root'; //fa20_390_colemco
    $SQLpass = ''; //VljUtuYVLx9C
    $db_host = '127.0.0.1';
    $db_name = 'test';
    static $dbh;

    $dbh = new PDO('mysql:host=localhost;dbname=test', $SQLuser, $SQLpass);

    return $dbh;
}