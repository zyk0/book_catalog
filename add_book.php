<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
	<link rel="icon" type="image/x-icon" href="https://img.icons8.com/ultraviolet/50/book.png">
	<link rel="stylesheet" 
	href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" 
	integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" 
	crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="https://unpkg.com/purecss@2.0.5/build/grids-responsive-min.css">
	<link rel="stylesheet" href="css.css">
	
    <style>
    #tag-suggestions div:hover {
        background-color: #eee;
    }
    #tag-suggestions {
        border: 1px solid #ccc;
        max-width: 300px;
        display: none;
        position: absolute;
        background: white;
        z-index: 1000;
    }
    </style>
</head>
<body>
<div class="pure-menu pure-menu-horizontal menu-height">
    <a href="#" class="pure-menu-heading pure-menu-link pure-menu-disabled">Book shelf</a>
    <ul class="pure-menu-list">
        <li class="pure-menu-item">
            <a href="list.php" class="pure-menu-link">list</a>
        </li>
        <li class="pure-menu-item">
            <a href="index.php" class="pure-menu-link">Catalog</a>
        </li>
        <li class="pure-menu-item">
            <a href="add_book.php" class="pure-menu-link">Add Book</a>
        </li>
    </ul>
</div>


<?php
	$nowyear = date("Y"); 
	$nextyear = $nowyear + 1;
?>

<div class="pure-g">
	<div class="pure-u-1-5"><p>Thirds</p>|</div>
    <div class="pure-u-3-5"><p>Thirds</p>
	
	<hr>
		<h1>Add a New Book</h1>
		<form class="pure-form" action="insert_book.php" method="POST" enctype="multipart/form-data" autocomplete="off">
		<fieldset class="pure-group">
		
			<label><input type="text" name="name" class="pure-input-2-3" placeholder="  Book Name" required /></label>
			<label><input type="text"    name="author" class="pure-input-2-3" placeholder="  Author" required /></label>
			<label><input type="number"  name="year"   class="pure-input-2-3" placeholder="  Year" 
				min="2010" max="<?php echo $nextyear; ?>" step="1" value="" required />
			</label>
			<label><input type="text" id="tag" name="tag" class="pure-input-2-3" placeholder="  Tag" /></label>
			<div id="tag-suggestions"></div>

			<fieldset class="pure-group">
				<input type="file" name="cover"> 
				<input type="submit" value="Add Book" placeholder="Add Book" class="pure-input-2-3">
			</fieldset>
			
		</fieldset>
		</form>
	<hr>		

	</div>
    <div class="pure-u-1-5"><p>Thirds</p>|</div>

</div> 

	<!--
    <h1>Add a New Book</h1>
    <form action="insert_book.php" method="POST" enctype="multipart/form-data" autocomplete="off">
        <label>Book Name: <input type="text" name="name" required></label><br><br>
        <label>Author: <input type="text" name="author" required></label><br><br>
        <label>Year: <input type="number" name="year" required></label><br><br>
        <label>Tag: <input type="text" id="tag" name="tag"></label><br><br>
        <div id="tag-suggestions"></div>
        <label>Cover: <input type="file" name="cover"></label><br><br>
        <input type="submit" value="Add Book">
    </form>
	-->

<script>
const tagInput = document.getElementById('tag');
const suggestionsBox = document.getElementById('tag-suggestions');

tagInput.addEventListener('input', function() {
    const query = this.value.trim();
    if (query.length === 0) {
        suggestionsBox.style.display = 'none';
        return;
    }

    fetch('tag_search.php?term=' + encodeURIComponent(query))
        .then(response => response.json())
        .then(tags => {
            if (tags.length === 0) {
                suggestionsBox.style.display = 'none';
                return;
            }

            suggestionsBox.innerHTML = '';
            tags.forEach(tag => {
                const div = document.createElement('div');
                div.textContent = tag;
                div.style.padding = '5px';
                div.style.cursor = 'pointer';

                div.addEventListener('click', () => {
                    tagInput.value = tag;
                    suggestionsBox.style.display = 'none';
                });

                suggestionsBox.appendChild(div);
            });

            const rect = tagInput.getBoundingClientRect();
            suggestionsBox.style.left = rect.left + 'px';
            suggestionsBox.style.top = (rect.bottom + window.scrollY) + 'px';
            suggestionsBox.style.width = rect.width + 'px';
            suggestionsBox.style.display = 'block';
        });
});

document.addEventListener('click', (e) => {
    if (!suggestionsBox.contains(e.target) && e.target !== tagInput) {
        suggestionsBox.style.display = 'none';
    }
});
</script>

<footer class="footer addbookfooter">footer</footer>	
</body>
</html>
