<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$caminhoBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhoBanco);

$student = new Student(
    null,
    'Guilherme Lins dos Santos',
    new DateTimeImmutable('2002-12-22')
);

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES (? , ?);";
$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(1, $student->name());
$statement->bindValue(2, $student->birthDate()->format('Y-m-d'));

if($statement->execute()) {
    echo 'Aluno incluido!';
}

var_dump($pdo->exec($sqlInsert));