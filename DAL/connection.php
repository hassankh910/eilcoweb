<?php
//Opening a connection to MySQL
function openConnection() {
    require 'config.php';
    try {
        $conn = new mysqli($servername, $username, $password, $dbname) or die("Conn failed: %s\n" . $conn->error);
//        echo "Connected successfully. <br>";
        return $conn;
    } catch (PDOException $ex) {
        echo "Connection failed: " . $ex->getMessage();
    }
}

//Closing a connection to MySQL
function closeConnection($conn) {
    $conn->close();
}

?>