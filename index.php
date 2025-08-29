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
	<link rel="icon" type="image/x-icon" href="https://img.icons8.com/ultraviolet/50/book.png">
	<link rel="stylesheet" 
			href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" 
			integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" 
			crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="https://unpkg.com/purecss@2.0.5/build/grids-responsive-min.css">
	<link rel="stylesheet" href="css.css">
		
</head>
<body>

<div class="pure-menu pure-menu-horizontal menu-height">
    <a href="#" class="pure-menu-heading pure-menu-link pure-menu-disabled">Book shelf</a>
    <ul class="pure-menu-list">
        <li class="pure-menu-item">
            <a href="index.php" class="pure-menu-link">Index</a>
        </li>
        <li class="pure-menu-item">
            <a href="index.php" class="pure-menu-link">Catalog</a>
        </li>
        <li class="pure-menu-item">
            <a href="add_book.php" class="pure-menu-link">Add Book</a>
        </li>
    </ul>
</div>


<div class="pure-g">
<div class="pure-u-3-5"><p>Thirds</p>
	
<div class="left-box">	
	<?php while ($row = $result->fetch_assoc()): ?>
		<div style="margin-bottom: 20px;">
				<?php if ($row['cover']): ?>
					<a href="one_book.php?id=<?php echo $row['id']; ?>">
						<img class="pure-img" src="uploads/<?php echo htmlspecialchars($row['cover']); ?>" 
						width="100" alt="Cover">
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
			<a class="pure-button pure-button-primary xsmall" 
				href="index.php?page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>

        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
            <?php if ($p == $page): ?>
                <strong><?php echo $p; ?></strong>
            <?php else: ?>
                <a href="index.php?page=<?php echo $p; ?>"><?php echo $p; ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
			<a class="pure-button pure-button-primary xsmall" 
			href="index.php?page=<?php echo $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>
	
	
</div>

</div>
<div class="pure-u-1-5"><p>Thirds</p></div>
<div class="pure-u-1-5"><p>Thirds</p></div>
</div> 

	
	
<footer class="footer">footer</footer>	
	
</body>
</html>
