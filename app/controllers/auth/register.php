<?php

require __DIR__ . '/auth.php';

$errors = [];

$name = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $passwordConfirm = $_POST['password_confirm'] ?? '';

    if ($name === '') {
        $errors[] = 'Name is required.';
    }

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid email address is required.';
    }

    if ($password === '') {
        $errors[] = 'Password is required.';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters long.';
    }

    if ($password !== $passwordConfirm) {
        $errors[] = 'Passwords do not match.';
    }

    if (!$errors) {
        try {
            $userId = registerUser($name, $email, $password);

            session_regenerate_id(true);
            $_SESSION['user_id'] = $userId;

            header('Location: /');
            exit;
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
    }
}

loadView('auth/register', [
    'errors' => $errors,
    'old' => [
        'name'  => $name,
        'email' => $email,
    ],
]);

?>