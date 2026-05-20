<?php

namespace App\Models;

class JobListing
{
    private array $data;

    private static array $fields = [
        'user_id',
        'title',
        'description',
        'salary',
        'tags',
        'company',
        'address',
        'city',
        'state',
        'phone',
        'email',
        'requirements',
        'benefits'
    ];

    public function __construct(array $data)
    {
        $this->data = array_intersect_key(
            $data,
            array_flip(self::$fields)
        );
    }

    public function save(): bool
    {
        $config = require basePath('config/db.php');
        $db = new \Database($config);

        $fields = array_values(
            array_intersect(
                self::$fields,
                array_keys($this->data)
            )
        );

        if (empty($fields)) {
            throw new \Exception('No valid fields provided to save listing.');
        }

        [$columns, $placeholders] = $this->buildSqlParts($fields);

        $stmt = $db->conn->prepare(
            "INSERT INTO listings ($columns) VALUES ($placeholders)"
        );

        $this->bindValues($stmt, $fields);

        try {
            return $stmt->execute();
        } catch (\PDOException $e) {
            throw new \Exception(
                'Failed to save job listing: ' . $e->getMessage()
            );
        }
    }

    private function buildSqlParts(array $fields): array
    {
        $columns = implode(', ', $fields);

        $placeholders = implode(
            ', ',
            array_map(fn($f) => ":$f", $fields)
        );

        return [$columns, $placeholders];
    }

    private function bindValues(\PDOStatement $stmt, array $fields): void
    {
        foreach ($fields as $field) {
            $stmt->bindValue(
                ":$field",
                $this->data[$field] ?? null
            );
        }
    }
}