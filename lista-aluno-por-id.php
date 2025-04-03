<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

echo "Listar por ID\nInforme o ID:";
$id = trim(fgets(STDIN));

$caminhoBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhoBanco);

$result = $pdo->query( "SELECT * FROM students WHERE id = $id;");

if ($studentData = $result->fetch(PDO::FETCH_ASSOC)) {
    $student = new Student(
        $studentData['id'],
        $studentData['name'],
        new DateTimeImmutable($studentData['birth_date'])
    );

    echo "\nAluno encontrado:\nNOME: " . $student->name() . "\nIdade: " . $student->age();
    exit();
}

echo 'Nenhum aluno encontrado.';