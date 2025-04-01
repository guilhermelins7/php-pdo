<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

// ID DE BUSCA:
$id = 5;

$caminhoBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhoBanco);

$result = $pdo->query( "SELECT * FROM students WHERE id = $id;");

if ($studentData = $result->fetch(PDO::FETCH_ASSOC)) {
    $student = new Student(
        $studentData['id'],
        $studentData['name'],
        new DateTimeImmutable($studentData['birth_date'])
    );

    echo $student->name() . PHP_EOL;
}
