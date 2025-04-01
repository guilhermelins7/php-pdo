<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$caminhoBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhoBanco);


$result = $pdo->query( 'SELECT * FROM students;');
// Atribuindo array associativo (propriedades = nome das colunas) à $studentDataList.
$studentDataList = $result->fetchAll(PDO::FETCH_ASSOC);
$studentList = [];

var_dump($studentDataList); exit;

foreach ( $studentDataList as $studentData) {
    $studentList[] = new Student(
        $studentData['id'],
        $studentData['name'],
        new DateTimeImmutable($studentData['birth_date'])
    );
}

var_dump($studentList);