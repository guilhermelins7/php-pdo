<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;
use Alura\Pdo\Infrastructure\Persistence\ConnectionBD;

require_once 'vendor/autoload.php';

$connection = ConnectionBD::createConnection();
$studentService = new PdoStudentRepository($connection);

echo "Adicionar aluno:\nInforme o nome: ";
$nomeAluno = trim(fgets(STDIN));

echo "Informe DT de nascimento: 'Y-m-d':";
$dataNascimento = trim(fgets(STDIN));

$student = new Student(
    null,
    $nomeAluno,
    new DateTimeImmutable($dataNascimento)
);

if($studentService->save($student)) {
    echo 'Aluno incluido!';
    exit();
}

echo 'falha na inclusão';