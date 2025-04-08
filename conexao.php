<?php

use Alura\Pdo\Infrastructure\Persistence\ConnectionBD;

require_once __DIR__ . '/vendor/autoload.php';

$pdo = ConnectionBD::createConnection();

$createTablesSql = '
    CREATE TABLE IF NOT EXISTS students (
        id INTEGER PRIMARY KEY,
        name TEXT,
        birth_date TEXT
    );

    CREATE TABLE IF NOT EXISTS phones (
        id INTEGER PRIMARY KEY,
        area_code TEXT,
        number TEXT,
        student_id INTEGER,
        FOREIGN KEY (student_id) REFERENCES students(id)
    );
';

$pdo->exec($createTablesSql);

echo 'Conectado.';