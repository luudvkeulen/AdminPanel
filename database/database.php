<?php
$servername = "localhost";
$username = "adminpanel";
$password = "1337";
$dbname = "adminpanel";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection with database failed. Contact an administrator.";
}