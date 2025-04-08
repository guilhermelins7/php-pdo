<?php

use Alura\Pdo\Infrastructure\Persistence\ConnectionBD;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$connection = ConnectionBD::createConnection();
$studentService = new PdoStudentRepository($connection);

echo "Deletar aluno\nInforme o ID:";
$idDelete = trim(fgets(STDIN));

$result = $studentService->remove($idDelete);
if ($result) {
    echo $result . " excluido."; exit();
}

echo 'Nenhum excluido.';