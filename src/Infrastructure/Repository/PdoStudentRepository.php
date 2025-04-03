<?php

namespace Alura\Pdo\Infrastructure\Repository;

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Domain\Repository\IStudentRepository;
use Alura\Pdo\Infrastructure\Persistence\ConnectionBD;

use PDO;
use DateTimeInterface;
use DateTimeImmutable;

class PdoStudentRepository implements IStudentRepository
{
    private \PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionBD::createConnection();
    }

    public function allStudents(): array
    {
        $stmt = $this->connection->query('SELECT * FROM students;');
        return $this->hydrateStudentList($stmt);
    }

    public function studentsBirthAt(DateTimeInterface $birthDate): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM students WHERE birth_date = ?;');
        $stmt->execute(['1', $birthDate->format('Y-m-d')]);
        return $this->hydrateStudentList($stmt);
    }

    public function hydrateStudentList(\PDOStatement $stmt): array
    {
        $studentDataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $studentList = [];

        foreach ( $studentDataList as $studentData) {
            $studentList[] = new Student(
                $studentData['id'],
                $studentData['name'],
                new DateTimeImmutable($studentData['birth_date'])
            );
        }

        return $studentList;
    }

    public function save(Student $student): bool
    {   
        if($student->id() == null) return $this->insert($student);
        return $this->update($student);
    }

    public function insert(Student $student): bool
    {
        $sqlInsert = "INSERT INTO students (name, birth_date) VALUES (:name , :birth_date);";
        // Preparando a query para execução:
        $statement = $this->connection->prepare($sqlInsert);
        // Associando o placeholder com os dados do Objeto:
        
        $result = $statement->execute(
            [
                ':name' => $student->name(),
                ':birth_date' => $student->birthDate()->format('Y-m-d')
            ]
        );

        if($result) {
            // Retornando último id do aluno inserido lastInsertId.
            $student->defineId($this->connection->lastInsertId());
        }

        return $result;
    }

    public function update(Student $student): bool 
    {
        $statment = $this->connection->prepare("UPDATE students SET name = :name, birth_date = :birth_date WHERE id = :id;");
        // Definindo o bindValue como inteiro.
        $statment->bindValue(':id', $student->id(), PDO::PARAM_INT);
        $statment->bindValue(':name', $student->name());
        $statment->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));

        return $statment->execute();
    }

    public function remove(int $studentID): bool
    {
        $statment = $this->connection->prepare("DELETE FROM students WHERE id = :id");
        // Definindo o bindValue como inteiro.
        $statment->bindValue(':id', $studentID, PDO::PARAM_INT);

        return $statment->execute();
    }
}