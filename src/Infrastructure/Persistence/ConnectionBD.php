<?php

namespace Alura\Pdo\Infrastructure\Persistence;

use PDO;

class ConnectionBD
{
    public static function createConnection(): \PDO
    {
        $caminhoBanco = __DIR__ . '/../../../banco.sqlite';

        $connection = new PDO('sqlite:' . $caminhoBanco);
        // Defininindo configurações para lançamento de exceções:
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;
    }
}