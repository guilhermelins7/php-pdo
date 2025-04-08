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
        // Opcional, pois a partir da versão 8 do php o PDO já lança exceções por padrão.
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Definindo o modo de busca padrão para o PDO, para não precisar passar o parâmetro em cada consulta.
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $connection;
    }
}