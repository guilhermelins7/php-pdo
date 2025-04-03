<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$studentService = new PdoStudentRepository();

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