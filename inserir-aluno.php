<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

echo "Adicionar aluno:\nInforme o nome: ";
$nomeAluno = trim(fgets(STDIN));

echo "Informe DT de nascimento: 'Y-m-d':";
$dataNascimento = trim(fgets(STDIN));

$caminhoBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhoBanco);

$student = new Student(
    null,
    $nomeAluno,
    new DateTimeImmutable($dataNascimento)
);

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES (? , ?);";
$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(1, $student->name());
$statement->bindValue(2, $student->birthDate()->format('Y-m-d'));

if($statement->execute()) {
    echo 'Aluno incluido!';
    exit();
}

echo 'falha na inclusão';