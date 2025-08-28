<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
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
    <nav style="margin-bottom: 20px;">
        <a href="index.php">Catalog</a> |
        <a href="add_book.php">Add Book</a>
    </nav>
    <hr>

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

</body>
</html>
