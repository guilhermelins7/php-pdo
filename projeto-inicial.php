<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$student = new Student(
    null,
    'Guilherme Lins',
    new \DateTimeImmutable('2002-12-22')
);

echo $student->age();
