    <?php

    class University
    {
        private string $name = '';
        private string $rector = '';
        private array $faculties = [];
        private SplObjectStorage $studentFacultyMap;

        public function __construct(string $name, string $rector, array $faculties = [])
        {
            $this->setName($name);
            $this->setRector($rector);
            $this->setFaculties($faculties);
        }

        public function getName(): string
        {
            return $this->name;
        }

        public function getRector(): string
        {
            return $this->rector;
        }

        public function getFaculties(): array
        {
            return $this->faculties;
        }

        /**
         * @throws InvalidArgumentException
         */
        public function setName(string $name): void
        {
            if (empty($name)) {
                throw new InvalidArgumentException('Название университета не может быть пустым');
            }
            $this->name = $name;
        }

        /**
         * @throws InvalidArgumentException
         */
        public function setRector(string $rector): void
        {
            if (empty($rector)) {
                throw new InvalidArgumentException('Имя ректора не может быть пустым');
            }
            $this->rector = $rector;
        }

        /**
         * @throws InvalidArgumentException
         */
        public function setFaculties(array $faculties): void
        {
            foreach ($faculties as $faculty) {
                if (!$faculty instanceof Faculty) {
                    throw new InvalidArgumentException('Все факультеты должны быть экземплярами класса Faculty');
                }
            }
            $this->faculties = $faculties;
            $this->refreshStudentFacultyMap();
        }

        public function addFaculty(Faculty $faculty): void
        {
            $this->faculties[] = $faculty;
            $this->addFacultyToMap($faculty);
        }

        public function getTotalStudentsCount(): int
        {
            $total = 0;
            foreach ($this->faculties as $faculty) {
                $total += $faculty->getStudentsCount();
            }

            return $total;
        }

        public function getUniversityAverageGrade(): float
        {
            $totalStudents = 0;
            $totalGrade = 0;

            foreach ($this->faculties as $faculty) {
                foreach ($faculty->getStudents() as $student) {
                    $totalGrade += $student->getAverageGrade();
                    ++$totalStudents;
                }
            }

            if (0 === $totalStudents) {
                return 0;
            }

            return round($totalGrade / $totalStudents, 2);
        }

        public function getAllStudents(): array
        {
            $allStudents = [];
            foreach ($this->faculties as $faculty) {
                $allStudents = array_merge($allStudents, $faculty->getStudents());
            }

            return $allStudents;
        }

        public function getFacultyForStudent(Student $student): ?Faculty
        {
            if ($this->studentFacultyMap->contains($student)) {
                return $this->studentFacultyMap[$student];
            }

            return null;
        }

        private function addFacultyToMap(Faculty $faculty): void
        {
            foreach ($faculty->getStudents() as $student) {
                $this->studentFacultyMap[$student] = $faculty;
            }
        }

        private function refreshStudentFacultyMap(): void
        {
            $this->studentFacultyMap = new SplObjectStorage();
            foreach ($this->faculties as $faculty) {
                $this->addFacultyToMap($faculty);
            }
        }
    }
