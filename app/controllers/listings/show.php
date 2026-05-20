<?php

$config = require basePath('config/db.php');
$db = new Database($config);

$id = $_GET['id'] ?? null;

if (!$id || !ctype_digit((string) $id)) {
    loadView('error/404');
    return;
}

$stmt = $db->conn->prepare(
    'SELECT * FROM listings WHERE id = :id LIMIT 1'
);

$stmt->execute([
    'id' => $id
]);

$listing = $stmt->fetch();

if (!$listing) {
    loadView('error/404');
    return;
}

loadView('listings/show', [
    'listing' => $listing
]);

?>