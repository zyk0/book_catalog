<?php
// поиск по тегу
include 'config.php';

$term = $_GET['term'] ?? '';

if ($term) {
    $stmt = $conn->prepare("SELECT DISTINCT tag FROM books WHERE tag LIKE CONCAT(?, '%') AND tag != '' LIMIT 10");
    $stmt->bind_param("s", $term);
    $stmt->execute();
    $result = $stmt->get_result();

    $tags = [];
    while ($row = $result->fetch_assoc()) {
        $tags[] = $row['tag'];
    }

    header('Content-Type: application/json');
    echo json_encode($tags);
}
?>
