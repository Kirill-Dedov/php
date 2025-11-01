<?php

class Faculty
{
    private string $name;
    private string $dean;
    private array $students;

    public function __construct(string $name, string $dean, array $students = [])
    {
        $this->setName($name);
        $this->setDean($dean);
        $this->setStudents($students);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDean(): string
    {
        return $this->dean;
    }

    public function getStudents(): array
    {
        return [...$this->students];
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setName(string $name): void
    {
        if (empty($name)) {
            throw new InvalidArgumentException('Название факультета не может быть пустым');
        }
        $this->name = $name;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setDean(string $dean): void
    {
        if (empty($dean)) {
            throw new InvalidArgumentException('Имя декана не может быть пустым');
        }
        $this->dean = $dean;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setStudents(array $students): void
    {
        foreach ($students as $student) {
            if (!$student instanceof Student) {
                throw new InvalidArgumentException('Все студенты должны быть экземплярами класса Student');
            }
        }
        $this->students = $students;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function addStudent(Student $student): void
    {
        $this->students[] = $student;
    }

    public function getStudentsCount(): int
    {
        return count($this->students);
    }
}
