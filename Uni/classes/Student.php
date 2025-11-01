<?php

class Student
{
    private string $name;
    private array $subjects;

    public function __construct(string $name, array $subjects = [])
    {
        $this->setName($name);
        $this->setSubjects($subjects);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSubjects(): array
    {
        return [...$this->subjects];
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setName(string $name): void
    {
        if (empty($name)) {
            throw new InvalidArgumentException('Имя студента не может быть пустым');
        }
        $this->name = $name;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setSubjects(array $subjects): void
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
    public function setSubject(Subject $subject): void
    {
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
    public function setNewSubject(string $name, int $grade): void
    {
        $subject = new Subject($name, $grade);
        $this->setSubject($subject);
    }

    public function getAverageGrade(): float
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
