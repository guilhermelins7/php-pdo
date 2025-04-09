<?php 

require_once 'vendor/autoload.php';

use Alura\Pdo\Infrastructure\Persistence\ConnectionBD;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

$connection = ConnectionBD::createConnection();
$studentRepository = new PdoStudentRepository($connection);

echo 'Alunos com telefone:' . PHP_EOL;

$students = $studentRepository->studentsWithPhones();
foreach ($students as $student) {
    echo $student->name() . PHP_EOL;
    foreach ($student->phones() as $phone) {
        echo "Telefone: {$phone->formattedPhone()}" . PHP_EOL;
    }
    echo PHP_EOL;
}

?>