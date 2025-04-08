<?php

namespace Alura\Pdo\Domain\Repository;

use Alura\Pdo\Domain\Model\Student;

interface IStudentRepository
{
    public function allStudents(): array;
    public function studentByID(int $id): Student;
    public function studentsBirthAt(\DateTimeInterface $birthDate) : array;
    public function save(Student $student): bool;
    public function remove(int $studentID): bool;
}