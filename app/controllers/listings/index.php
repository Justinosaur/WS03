<?php

$config = require basePath('config/db.php');
$db = new Database($config);

$keywords = trim($_GET['keywords'] ?? '');
$location = trim($_GET['location'] ?? '');

$where = [];
$params = [];

if ($keywords !== '') {
    $where[] = '(title LIKE :kw OR description LIKE :kw OR tags LIKE :kw)';
    $params['kw'] = "%{$keywords}%";
}

if ($location !== '') {
    $where[] = '(city LIKE :loc OR state LIKE :loc OR address LIKE :loc)';
    $params['loc'] = "%{$location}%";
}

$sql = buildQuery($where);

$stmt = $db->conn->prepare($sql);
$stmt->execute($params);

$listings = $stmt->fetchAll();

loadView('listings/index', [
    'listings' => $listings,
    'keywords' => $keywords,
    'location' => $location,
]);

function buildQuery(array $where): string
{
    $sql = 'SELECT * FROM listings';

    if (!empty($where)) {
        $sql .= ' WHERE ' . implode(' AND ', $where);
    }

    return $sql . ' ORDER BY id DESC';
}

?>