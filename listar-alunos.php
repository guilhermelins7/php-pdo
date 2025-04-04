<?php

require_once 'vendor/autoload.php';

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionBD;

use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

$studentService = new PdoStudentRepository();

$studentList = $studentService->allStudents();

foreach ($studentList as $student) {
    echo "\n\nID:" . $student->id() . "\nAluno:" . $student->name() . "\nIdade: " . $student->age();
}