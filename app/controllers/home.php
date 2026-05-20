<?php

$config = require basePath('config/db.php');
$db = new Database($config);

$listings = $db
    ->query("SELECT * FROM listings ORDER BY id DESC LIMIT 3")
    ->fetchAll();

if (!$listings) {
    require basePath('seed.php');

    $listings = $db
        ->query("SELECT * FROM listings ORDER BY id DESC LIMIT 3")
        ->fetchAll();
}

loadView('home', [
    'listings' => $listings
]);

?>