<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$caminhoBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhoBanco);


$result = $pdo->query( 'SELECT * FROM students;');
// Atribuindo array associativo (propriedades = nome das colunas) à $studentDataList.
$studentDataList = $result->fetchAll(PDO::FETCH_ASSOC);
$studentList = [];

echo 'Alunos:';

foreach ( $studentDataList as $studentData) {
    $studentList[] = new Student(
        $studentData['id'],
        $studentData['name'],
        new DateTimeImmutable($studentData['birth_date'])
    );
}

foreach ($studentList as $student) {
    echo "\n\nID:" . $student->id() . "\nAluno:" . $student->name() . "\nIdade: " . $student->age();
}
