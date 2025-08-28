<?php
include 'config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    die("Invalid book ID.");
}

$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Book not found.");
}

$book = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($book['name']); ?> - Book Details</title>
</head>
<body>
    <nav style="margin-bottom: 20px;">
        <a href="index.php">Catalog</a> |
        <a href="add_book.php">Add Book</a>
    </nav>
    <hr>

    <h1><?php echo htmlspecialchars($book['name']); ?></h1>

    <?php if ($book['cover']): ?>
        <img src="uploads/<?php echo htmlspecialchars($book['cover']); ?>" alt="Cover" style="max-width:300px;">
    <?php endif; ?>

    <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
    <p><strong>Year:</strong> <?php echo $book['year']; ?></p>
    <?php if (!empty($book['tag'])): ?>
        <p><strong>Tag:</strong> <?php echo htmlspecialchars($book['tag']); ?></p>
    <?php endif; ?>

</body>
</html>
