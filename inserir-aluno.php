<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionBD;

require_once 'vendor/autoload.php';

$pdo = ConnectionBD::createConnection();

echo "Adicionar aluno:\nInforme o nome: ";
$nomeAluno = trim(fgets(STDIN));

echo "Informe DT de nascimento: 'Y-m-d':";
$dataNascimento = trim(fgets(STDIN));

$student = new Student(
    null,
    $nomeAluno,
    new DateTimeImmutable($dataNascimento)
);

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES (:name , :birth_date);";
// Preparando a query para execução:
$statement = $pdo->prepare($sqlInsert);
// Associando o placeholder com os dados do Objeto:
$statement->bindValue(':name', $student->name());
$statement->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));

if($statement->execute()) {
    echo 'Aluno incluido!';
    exit();
}

echo 'falha na inclusão';