<?php

use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$studentService = new PdoStudentRepository();

echo "Deletar aluno\nInforme o ID:";
$idDelete = trim(fgets(STDIN));

$result = $studentService->remove($idDelete);
if ($result) {
    echo $result . " excluido."; exit();
}

echo 'Nenhum excluido.';