<?php
//  $allowedTypes для загрузки разрешены только изображения
//  $maxSize - лимит обложки - 1MB
//  $cover = uniqid () имя обложки


include 'config.php';

$name = $_POST['name'];
$author = $_POST['author'];
$year = $_POST['year'];
$tag = $_POST['tag'];

$cover = '';
if (!empty($_FILES['cover']['name'])) {
    $maxSize = 1 * 1024 * 1024; // 1MB
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

    $fileTmpPath = $_FILES["cover"]["tmp_name"];
    $fileSize = $_FILES["cover"]["size"];
    $fileType = mime_content_type($fileTmpPath);

    if (!in_array($fileType, $allowedTypes)) {
        die("Error: Only JPG, JPEG, PNG, and GIF images are allowed.");
    }

    if ($fileSize > $maxSize) {
        die("Error: Cover image must not exceed 1MB.");
    }

    $extension = pathinfo($_FILES["cover"]["name"], PATHINFO_EXTENSION);
    $cover = uniqid('cover_', true) . '.' . strtolower($extension);

    $targetDir = "uploads/";
    $targetFile = $targetDir . $cover;

    move_uploaded_file($fileTmpPath, $targetFile);
}

$stmt = $conn->prepare("INSERT INTO books (name, author, year, cover, tag) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssiss", $name, $author, $year, $cover, $tag);
$stmt->execute();

header("Location: index.php");
exit;

?>

