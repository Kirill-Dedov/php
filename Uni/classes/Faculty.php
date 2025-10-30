<?php

class Faculty
{
    private $name;
    private $dean;
    private $students;

    public function __construct($name, $dean, $students = [])
    {
        $this->setName($name);
        $this->setDean($dean);
        $this->setStudents($students);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDean()
    {
        return $this->dean;
    }

    public function getStudents()
    {
        return [...$this->students];
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setName($name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('Название факультета не может быть пустым');
        }
        $this->name = $name;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setDean($dean)
    {
        if (empty($dean)) {
            throw new InvalidArgumentException('Имя декана не может быть пустым');
        }
        $this->dean = $dean;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setStudents($students)
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
    public function addStudent($student)
    {
        if (!$student instanceof Student) {
            throw new InvalidArgumentException('Студент должен быть экземпляром класса Student');
        }

        $this->students[] = $student;
    }

    public function getStudentsCount()
    {
        return count($this->students);
    }
}
