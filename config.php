<?php
// DB config
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_catalog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка: " . $conn->connect_error);
}
?>
