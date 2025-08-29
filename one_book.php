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
    <div class="pure-u-lg-2-4"><p>1 4</p>
	<div class="left-box">
	
		<h1><?php echo htmlspecialchars($book['name']); ?></h1>

		<?php if ($book['cover']): ?>
		
			<img class="pure-img" src="uploads/<?php echo htmlspecialchars($book['cover']); ?>" 
			alt="Cover" 
			style="max-width:300px;">
		<?php endif; ?>

		<p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
		<p><strong>Year:</strong> <?php echo $book['year']; ?></p>
		<?php if (!empty($book['tag'])): ?>
			<p><strong>Tag:</strong> <?php echo htmlspecialchars($book['tag']); ?></p>
		<?php endif; ?>
		
		<p><a class="pure-button" href="index.php">on catalog page</a></p>
		
	</div>
	</div>
    <div class="pure-u-lg-1-4"><p>1 4</p> </div>
	<div class="pure-u-lg-1-4"><p>1 4</p> </div>

</div>

<footer class="footer">footer</footer>	
</body>
</html>
