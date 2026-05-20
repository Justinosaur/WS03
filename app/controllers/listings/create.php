<?php

require basePath('models/JobListing.php');

use App\Models\JobListing;

$error = null;
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $old = $_POST;

    $data = [
        'user_id'      => $_SESSION['user_id'] ?? null,
        'title'        => trim($_POST['title'] ?? ''),
        'description'  => trim($_POST['description'] ?? ''),
        'salary'       => trim(str_replace(',', '', $_POST['salary'] ?? '0')),
        'tags'         => trim($_POST['tags'] ?? ''),
        'company'      => trim($_POST['company'] ?? ''),
        'address'      => trim($_POST['address'] ?? ''),
        'city'         => trim($_POST['city'] ?? ''),
        'state'        => trim($_POST['state'] ?? ''),
        'phone'        => trim($_POST['phone'] ?? ''),
        'email'        => trim($_POST['email'] ?? ''),
        'requirements' => trim($_POST['requirements'] ?? ''),
        'benefits'     => trim($_POST['benefits'] ?? ''),
    ];

    try {
        $listing = new JobListing($data);

        if ($listing->save()) {
            header('Location: /listings');
            exit;
        }

        $error = 'Failed to save listing.';
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

loadView('listings/create', [
    'error' => $error,
    'old'   => $old,
]);

?>