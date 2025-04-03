<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$caminhoBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhoBanco);

echo "Deletar aluno\nInforme o ID:";
$idDelete = trim(fgets(STDIN));

$statment = $pdo->prepare("DELETE FROM students WHERE id = :id");
// Definindo o bindValue como inteiro.
$statment->bindValue(':id', $idDelete, PDO::PARAM_INT);

$result = $statment->execute();
if ($result) {
    echo $result . " excluido."; exit();
}

echo 'Nenhum excluido.';