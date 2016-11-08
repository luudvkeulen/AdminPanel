<?php
$servername = "localhost";
$username = "takilife";
$password = "123";
$dbname = "arma3life";

try {
    $conn = new PDO("mysql:host=$servername;port=3406;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection with database failed. Contact an administrator.";
}