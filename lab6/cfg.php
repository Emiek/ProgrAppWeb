<?php

function db_connect()
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'moja_strona_164333';


    $conn = new mysqli($hostname, $username, $password, $db);

    /* Set the desired charset after establishing a connection */
    $conn->set_charset('utf8mb4');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
/* You should enable error reporting for mysqli before attempting to make a connection */


