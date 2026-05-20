<?php

$envFile = __DIR__ . '/../../.env';

if (file_exists($envFile)) {

    $envLines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($envLines as $line) {

        $line = trim($line);

        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);

        $key = trim($key);
        $value = trim($value);

        if (!getenv($key)) {
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}

$config = [
    'host'     => getenv('MYSQL_HOST') ?: '127.0.0.1',
    'port'     => getenv('MYSQL_PORT') ?: '3306',
    'dbname'   => getenv('MYSQL_DBNAME') ?: 'jobseeker',
    'username' => getenv('MYSQL_USERNAME') ?: 'root',
    'password' => getenv('MYSQL_PASSWORD') ?: ''
];

return $config;

?>