<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

echo "Deletar aluno\nInforme o ID:";
$idDelete = trim(fgets(STDIN));

$caminhoBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhoBanco);

$result = $pdo->exec( "DELETE FROM students WHERE id = '$idDelete';");

if ($result) {
    echo $result . " excluido."; exit();
}

echo 'Nenhum excluido.';