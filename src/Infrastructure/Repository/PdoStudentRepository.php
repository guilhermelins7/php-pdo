<?php

namespace Alura\Pdo\Infrastructure\Repository;

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Domain\Repository\IStudentRepository;
use Alura\Pdo\Infrastructure\Persistence\ConnectionBD;
use Alura\Pdo\Domain\Model\Phone;

use PDO;
use DateTimeInterface;
use DateTimeImmutable;
use RuntimeException;

class PdoStudentRepository implements IStudentRepository
{
    // Injetando dependência da conexão com Banco: ...
    private \PDO $connection;
    // ... 
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function allStudents(): array
    {
        $stmt = $this->connection->query('SELECT * FROM students;');
        return $this->hydrateStudentList($stmt);
    }

    public function studentByID(int $id): Student
    {
        $stmt = $this->connection->prepare("SELECT * FROM students WHERE id = :id;");
        $stmt->execute(['id' => $id]);
    
        $row = $stmt->fetch();
    
        if (!$row) {
            echo "Estudante não encontrado.";
            exit();
        }
    
        $student = new Student(
            $row['id'],
            $row['name'],
            new DateTimeImmutable($row['birth_date'])
        );
    
        return $student;
    }
    

    public function studentsBirthAt(DateTimeInterface $birthDate): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM students WHERE birth_date = ?;');
        $stmt->execute(['1', $birthDate->format('Y-m-d')]);
        return $this->hydrateStudentList($stmt);
    }

    public function hydrateStudentList(\PDOStatement $stmt): array
    {
        $studentDataList = $stmt->fetchAll();
        $studentList = [];

        foreach ( $studentDataList as $studentData) {
            $student = new Student(
                $studentData['id'],
                $studentData['name'],
                new DateTimeImmutable($studentData['birth_date'])
            );

            $this->fillPhonesOf($student);

            $studentList[] = $student;
        }

        return $studentList;
    }

    public function fillPhonesOf(Student $student): void
    {
        $sqlQuery = "SELECT * FROM phones WHERE student_id = :student_id;";
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(':student_id', $student->id(), PDO::PARAM_INT);
        $stmt->execute();

        $phoneDataList = $stmt->fetchAll();

        foreach ($phoneDataList as $phoneData) {
            $student->addPhone(
                new Phone(
                    $phoneData['id'],
                    $phoneData['area_code'],
                    $phoneData['number'],
                    $student->id()
                )
            );
        }
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
        if($statement === false) 
            throw new RuntimeException($this->connection->errorInfo()[2]);

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