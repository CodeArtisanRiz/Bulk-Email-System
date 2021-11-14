<?php

function dbConnection() {
    $conn = mysqli_connect("localhost", "root", "", "bulk_db");
	//$conn = mysqli_connect("localhost", "u478474012_bulk_mail", "Brainkraft1@", "u478474012_bulk_db");
    if (mysqli_errno($conn) > 0) {
        die("hey! you just killed the connection to the database");
    }
    return $conn;
}
?>