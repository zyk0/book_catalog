<?php
include 'config.php';

// нумерация
$limit = 4;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// количество книг
$totalResult = $conn->query("SELECT COUNT(*) AS total FROM books");
$totalRow = $totalResult->fetch_assoc();
$totalBooks = $totalRow['total'];

$totalPages = ceil($totalBooks / $limit);

// книги на текущей странице
$stmt = $conn->prepare("SELECT * FROM books ORDER BY id DESC LIMIT ? OFFSET ?");
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();


?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Catalog</title>
</head>
<body>
    <nav style="margin-bottom: 20px;">
        <a href="index.php">Catalog</a> |
        <a href="add_book.php">Add Book</a>
    </nav>
    <hr>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div style="margin-bottom: 20px;">
				<?php if ($row['cover']): ?>
					<a href="book.php?id=<?php echo $row['id']; ?>">
						<img src="uploads/<?php echo htmlspecialchars($row['cover']); ?>" width="100" alt="Cover">
					</a>
				<?php endif; ?>
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <p><strong>Author:</strong> <?php echo htmlspecialchars($row['author']); ?></p>
            <p><strong>Year:</strong> <?php echo $row['year']; ?></p>
            <?php if (!empty($row['tag'])): ?>
                <p><strong>Tag:</strong> <?php echo htmlspecialchars($row['tag']); ?></p>
            <?php endif; ?>
			
        </div>
        <hr>
    <?php endwhile; ?>

    <div style="margin-top: 20px;">
        <?php if ($page > 1): ?>
            <a href="index.php?page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>

        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
            <?php if ($p == $page): ?>
                <strong><?php echo $p; ?></strong>
            <?php else: ?>
                <a href="index.php?page=<?php echo $p; ?>"><?php echo $p; ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="index.php?page=<?php echo $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>
</body>
</html>
