<?php
    $serverName = "localhost";
    $dbUserName = "root";
    $dbPassword = "";
    $dbName = "tienda";

    $conn = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName);

    if (!$conn) {
        die("Conexion fallida: " . mysqli_connect_error());
    }
?>