<?php

namespace Alura\Pdo\Infrastructure\Persistence;

use PDO;

class ConnectionBD
{
    public static function createConnection(): \PDO
    {
        $caminhoBanco = __DIR__ . '/../../../banco.sqlite';
        return new PDO('sqlite:' . $caminhoBanco);
    }
}