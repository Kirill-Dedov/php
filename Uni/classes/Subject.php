<?php

class Subject
{
    private $name;
    private $grade;

    public function __construct($name, $grade)
    {
        $this->setName($name);
        $this->setGrade($grade);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setName($name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('Название предмета не может быть пустым');
        }
        if (strlen($name) < 2) {
            throw new InvalidArgumentException('Название предмета должно содержать хотя бы 2 символа');
        }
        $this->name = $name;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setGrade($grade)
    {
        if (1 > $grade || 5 < $grade) {
            throw new InvalidArgumentException('Оценка должна быть целым числом от 1 до 5');
        }
        $this->grade = $grade;
    }
}
