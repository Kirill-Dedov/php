<?php

class University
{
    private $name;
    private $rector;
    private $faculties;

    public function __construct($name, $rector, $faculties = [])
    {
        $this->setName($name);
        $this->setRector($rector);
        $this->setFaculties($faculties);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRector()
    {
        return $this->rector;
    }

    public function getFaculties()
    {
        return [...$this->faculties];
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setName($name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('Название университета не может быть пустым');
        }
        $this->name = $name;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setRector($rector)
    {
        if (empty($rector)) {
            throw new InvalidArgumentException('Имя ректора не может быть пустым');
        }
        $this->rector = $rector;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setFaculties($faculties)
    {
        foreach ($faculties as $faculty) {
            if (!$faculty instanceof Faculty) {
                throw new InvalidArgumentException('Все факультеты должны быть экземплярами класса Faculty');
            }
        }
        $this->faculties = $faculties;
    }

    public function addFaculty($faculty)
    {
        if (!$faculty instanceof Faculty) {
            throw new InvalidArgumentException('Факультет должен быть экземпляром класса Faculty');
        }

        $this->faculties[] = $faculty;
    }

    public function getTotalStudentsCount()
    {
        $total = 0;
        foreach ($this->faculties as $faculty) {
            $total += $faculty->getStudentsCount();
        }

        return $total;
    }

    public function getUniversityAverageGrade()
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

    public function getAllStudents()
    {
        $allStudents = [];
        foreach ($this->faculties as $faculty) {
            $allStudents = array_merge($allStudents, $faculty->getStudents());
        }

        return $allStudents;
    }

    public function getFacultiesReportHTML()
    {
        $html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Отчет по факультетам - '.$this->name.'</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #b1b1b1ff; }
        th { background-color: #e0dfdfff; }
        .faculty-count { margin: 20px 0; }
    </style>
</head>
<body>
    <h1>Университет: '.$this->name.'</h1>
    <div class="faculty-count"><strong>Общее количество студентов:</strong> '.$this->getTotalStudentsCount().'</div>';

        if (empty($this->faculties)) {
            $html .= '<p>Пока в университете нет факультетов</p>';
        } else {
            $html .= '<table>
                <thead>
                    <tr>
                        <th>Название факультета</th>
                        <th>Декан</th>
                        <th>Количество студентов</th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($this->faculties as $faculty) {
                $html .= '<tr>
                    <td>'.$faculty->getName().'</td>
                    <td>'.$faculty->getDean().'</td>
                    <td>'.$faculty->getStudentsCount().'</td>
                </tr>';
            }

            $html .= '</tbody>
            </table>';
        }

        $html .= '</body>
</html>';

        return $html;
    }

    public function getStudentsReportHTML()
    {
        $allStudents = $this->getAllStudents();

        $html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Список студентов - '.$this->name.'</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #b1b1b1ff; }
        th { background-color: #e0dfdfff; }
        .student-count { margin: 20px 0; }
    </style>
</head>
<body>
    <h1>Список всех студентов</h1>
    <div class="student-count"><strong>Общее количество студентов:</strong> '.count($allStudents).'</div>';

        if (empty($allStudents)) {
            $html .= '<p>Пока в университете нет ни одного студента</p>';
        } else {
            $html .= '<table>
                <thead>
                    <tr>
                        <th>Имя студента</th>
                        <th>Факультет</th>
                        <th>Средний бал</th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($allStudents as $student) {
                $facultyName = '';
                foreach ($this->faculties as $faculty) {
                    if (in_array($student, $faculty->getStudents(), true)) {
                        $facultyName = $faculty->getName();
                        break;
                    }
                }

                $html .= '<tr>
                    <td>'.$student->getName().'</td>
                    <td>'.$facultyName.'</td>
                    <td>'.$student->getAverageGrade().'</td>
                </tr>';
            }

            $html .= '</tbody>
            </table>';
        }

        $html .= '</body>
</html>';

        return $html;
    }

    public function saveFacultiesReport($filename = 'faculties_report.html')
    {
        $result = file_put_contents($filename, $this->getFacultiesReportHTML());
        if (false === $result) {
            throw new RuntimeException("Не удалось сохранить файл: $filename");
        }

        return $filename;
    }

    public function saveStudentsReport($filename = 'students_report.html')
    {
        $result = file_put_contents($filename, $this->getStudentsReportHTML());
        if (false === $result) {
            throw new RuntimeException("Не удалось сохранить файл: $filename");
        }

        return $filename;
    }

    public function saveAllReports()
    {
        $facultiesFile = $this->saveFacultiesReport();
        $studentsFile = $this->saveStudentsReport();

        return [
            'faculties' => $facultiesFile,
            'students' => $studentsFile,
        ];
    }
}
