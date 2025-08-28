<?php
// загрузка новой книги
include 'config.php';

$name   = $_POST['name'];
$author = $_POST['author'];
$year   = $_POST['year'];
$tag    = $_POST['tag'];

$cover = '';
if (!empty($_FILES['cover']['name'])) {
    $targetDir = "uploads/";
    $cover = basename($_FILES["cover"]["name"]);
    $targetFile = $targetDir . $cover;

    move_uploaded_file($_FILES["cover"]["tmp_name"], $targetFile);
}

$stmt = $conn->prepare("INSERT INTO books (name, author, year, cover, tag) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssiss", $name, $author, $year, $cover, $tag);
$stmt->execute();

header("Location: index.php");
exit;
?>
