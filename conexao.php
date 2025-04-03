<?php

use Alura\Pdo\Infrastructure\Persistence\ConnectionBD;

$pdo = ConnectionBD::createConnection();

$pdo->exec('CREATE TABLE students(id INTEGER PRIMARY KEY, name TEXT, birth_date TEXT)');

echo 'Conectado.';