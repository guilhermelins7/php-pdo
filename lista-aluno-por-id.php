<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionBD;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$connection = ConnectionBD::createConnection();
$studentService = new PdoStudentRepository($connection);

echo "Listar por ID\nInforme o ID:";
$id = trim(fgets(STDIN));

$student = $studentService->studentByID($id);

if($student) {
    echo "\nEstudante ID: {$student->id()}\nNome: {$student->name()}\nData de Nascimento: {$student->birthDate()->format('Y-m-d')}\n";
    exit();
}

echo 'Nenhum aluno encontrado.';