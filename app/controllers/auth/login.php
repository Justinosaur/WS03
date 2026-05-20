<?php

require __DIR__ . '/auth.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        $error = "Please fill in all fields.";
    } else {

        $loginSuccess = loginUser($email, $password);

        if ($loginSuccess) {
            header("Location: /");
            exit;
        }

        $error = "Invalid email or password.";
    }
}

loadView("auth/login", [
    'error' => $error
]);

?>