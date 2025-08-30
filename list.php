
<?php

include 'config.php';

$sql = "SELECT * FROM books"; 
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title> List Book</title>
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
            <a href="list.php" class="pure-menu-link">List</a>
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
	<div class="pure-u-lg-3-5"><p>3 5</p> 
	
	
<?php 


// fetch_all  ассоциативный массив
if ($result->num_rows > 0) {
    $rows = $result->fetch_all(MYSQLI_ASSOC); 
    
    // table
    echo "
			<table class='pure-table list-table'>
			<thead>
			<tr>
				<th> id</th>
				<th> name</th>
				<th> author</th>
			</tr>
			</thead>
			";
    
    //  foreach () 
    foreach ($rows as $row) {
        echo "
			<tbody>
				<tr class=''>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['author'] . "</td>
				</tr>
			 <tbody>
			 ";
    }

    echo "</table>";
} else {
    echo "0 results";
}

// Close the connection
$conn->close();
?>


	</div>
    <div class="pure-u-lg-1-5"><p>1 5 </p> 
	</div>
	<div class="pure-u-lg-1-5"><p>1 5</p> </div>
</div>

<footer class="footer">footer</footer>	
</body>
</html>
