<?php 
use Alura\Pdo\Infrastructure\Persistence\ConnectionBD;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;
use Alura\Pdo\Domain\Model\Student; // Import the Student class

require_once 'vendor/autoload.php';

$connection = ConnectionBD::createConnection();
$studentRepository = new PdoStudentRepository($connection);

// Processos de definição da turma.

try {
    // Definindo transação no Banco de Dados:
    $connection->beginTransaction();

    $aStudent = new Student(null, 'Nico Steppat', new DateTimeImmutable('1985-05-01'));
    $studentRepository->save($aStudent);

    $bStudent = new Student(null, 'Maria da Silva', new DateTimeImmutable('1990-06-15'));
    $studentRepository->save($bStudent);
    $connection->commit(); // Confirma a transação no banco de dados
    echo "Turma criada com sucesso!\n";
}
catch (PDOException $e) {
    // Caso ocorra algum erro, desfaz a transação:
    echo $e->getMessage();
    $connection->rollBack();
    exit();
}

?>