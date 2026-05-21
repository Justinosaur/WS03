<?php

/**
 * Attempt to authenticate a user by email and password.
 *
 * @param string $email
 * @param string $password
 * @return bool True on success, false on failure
 */
function loginUser(string $email, string $password): bool
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    $config = require basePath('config/db.php');
    $db = new Database($config);

    $query = $db->conn->prepare(
        "SELECT * FROM users WHERE email = :email LIMIT 1"
    );

    $query->execute([
        'email' => $email
    ]);

    $user = $query->fetch();

    if (!$user || !password_verify($password, $user->password)) {
        return false;
    }

    session_regenerate_id(true);

    $_SESSION['user_id'] = $user->id;

    return true;
}

/**
 * Register a new user and return the new user's ID.
 *
 * @param string $name
 * @param string $email
 * @param string $password
 * @return int Inserted user ID
 * @throws Exception If email is already registered or query fails
 */
function registerUser(string $name, string $email, string $password): int
{
    $config = require basePath('config/db.php');
    $db = new Database($config);

    $checkEmail = $db->conn->prepare(
        "SELECT id FROM users WHERE email = :email LIMIT 1"
    );

    $checkEmail->execute([
        'email' => $email
    ]);

    if ($checkEmail->fetch()) {
        throw new Exception("Email is already registered.");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $insertUser = $db->conn->prepare(
        "INSERT INTO users (name, email, password)
         VALUES (:name, :email, :password)"
    );

    $insertUser->execute([
        'name'     => $name,
        'email'    => $email,
        'password' => $hashedPassword
    ]);

    return (int) $db->conn->lastInsertId();
}

?>