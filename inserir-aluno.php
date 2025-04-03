<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

// Chamando diretório atual:
$caminhoBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhoBanco);

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