<?php

class Student
{
    private $name;
    private $subjects;

    public function __construct($name, $subjects = [])
    {
        $this->setName($name);
        $this->setSubjects($subjects);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSubjects()
    {
        return [...$this->subjects];
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setName($name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('Имя студента не может быть пустым');
        }
        $this->name = $name;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setSubjects($subjects)
    {
        foreach ($subjects as $subject) {
            if (!$subject instanceof Subject) {
                throw new InvalidArgumentException('Все предметы должны быть экземплярами класса Subject');
            }
        }
        $this->subjects = $subjects;
    }

    /** If such subject already exists it will be replaced with a new one(grade update).
     *
     * @throws InvalidArgumentException
     */
    public function setSubject($subject)
    {
        if (!$subject instanceof Subject) {
            throw new InvalidArgumentException('Предмет должен быть экземпляром класса Subject');
        }

        $foundIndex = null;
        foreach ($this->subjects as $index => $existingSubject) {
            if ($existingSubject->getName() === $subject->getName()) {
                $foundIndex = $index;
                break;
            }
        }

        if (null !== $foundIndex) {
            $this->subjects[$foundIndex] = $subject;
        } else {
            $this->subjects[] = $subject;
        }
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setNewSubject($name, $grade)
    {
        $subject = new Subject($name, $grade);
        $this->setSubject($subject);
    }

    public function getAverageGrade()
    {
        if (empty($this->subjects)) {
            return 0;
        }
        $total = 0;
        foreach ($this->subjects as $subject) {
            $total += $subject->getGrade();
        }

        return round($total / count($this->subjects), 2);
    }
}
