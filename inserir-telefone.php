<?php 

use Alura\Pdo\Infrastructure\Persistence\ConnectionBD;

require_once 'vendor/autoload.php';

$pdo = ConnectionBD::createConnection();

echo "Inserir telefone\nInforme o ID do aluno:";
$id = trim(fgets(STDIN));
echo 'Informe o DDD:';
$areaCode = trim(fgets(STDIN));
echo 'Informe o telefone:';
$number = trim(fgets(STDIN));

try {
    $sqlQuery = 'INSERT INTO phones (area_code, number, student_id) VALUES (:area_code, :number, :student_id)';
    $stmt = $pdo->prepare($sqlQuery);
    $stmt->bindValue(':area_code', $areaCode, PDO::PARAM_STR);
    $stmt->bindValue(':number', $number, PDO::PARAM_STR);
    $stmt->bindValue(':student_id', $id, PDO::PARAM_INT);
    $stmt->execute();
    echo "Telefone inserido com sucesso!\n";
} catch (PDOException $e) {
    echo "Erro ao inserir telefone: " . $e->getMessage() . "\n";
}

?>