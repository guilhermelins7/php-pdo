<?php

require_once 'vendor/autoload.php';

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Domain\Model\Phone;
use Alura\Pdo\Infrastructure\Persistence\ConnectionBD;

use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

$connection = ConnectionBD::createConnection();
$studentService = new PdoStudentRepository($connection);

$studentList = $studentService->allStudents();

foreach ($studentList as $student) {
    echo "\n\nID: {$student->id()}\nAluno: {$student->name()}\nIdade: {$student->age()}";
    if($student->phones()) {
        echo "\nNúmeros de Telefone:\n";
        foreach ($student->phones() as $phone) {
            echo "{$phone->formattedPhone()}\n";
        }
    }
}