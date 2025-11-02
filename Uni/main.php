<?php

require_once 'classes/Subject.php';
require_once 'classes/Student.php';
require_once 'classes/Faculty.php';
require_once 'classes/University.php';
try {
    $student1 = new Student('Иван Иванов', [
        new Subject('Математика', 5),
        new Subject('Физика', 5),
        new Subject('Программирование', 5),
    ]);
    $student1->setNewSubject('Литература', 2);

    $student2 = new Student('Петр Петров', [
        new Subject('Физика', 4),
        new Subject('История', 3),
    ]);

    $student2->setNewSubject('Математика', 2);

    $student3 = new Student('Алексей Алексеев', [
        new Subject('Математика', 3),
        new Subject('История', 4),
        new Subject('Химия', 5),
    ]);

    $student4 = new Student('Анна Аннова', [
        new Subject('Химия', 5),
        new Subject('Математика', 4),
        new Subject('Программирование', 5),
    ]);

    $student5 = new Student('Мария Мариева', [
        new Subject('История', 5),
        new Subject('Химия', 3),
    ]);

    $student5->setNewSubject('Литература', 4);

    $student6 = new Student('Игнат Игнатов', [
        new Subject('Математика', 4),
        new Subject('Физика', 3),
        new Subject('Программирование', 4),
    ]);

    $faculty1 = new Faculty('Факультет информатики', 'Профессор Баймова', [$student1, $student4, $student6]);
    $faculty2 = new Faculty('Факультет истории', 'Профессор Барабанов', [$student3, $student5]);
    $faculty3 = new Faculty('Факультет физики', 'Профессор Васильев', [$student2]);

    $university = new University('Технический университет', 'Профессор Браун', [$faculty1, $faculty2, $faculty3]);
    $success = true;

    $facultiesReportFileName = 'faculties_report.html';
    $facultiesReportHtml = '<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Отчет по факультетам - '.$university->getName().'</title>
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
        <h1>Университет: '.$university->getName().'</h1>
        <div class="faculty-count"><strong>Общее количество студентов:</strong> '.$university->getTotalStudentsCount().'</div>';

    if (empty($university->getFaculties())) {
        $facultiesReportHtml .= '<p>Пока в университете нет факультетов</p>';
    } else {
        $facultiesReportHtml .= '<table>
                    <thead>
                        <tr>
                            <th>Название факультета</th>
                            <th>Декан</th>
                            <th>Количество студентов</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($university->getFaculties() as $faculty) {
            $facultiesReportHtml .= '<tr>
                        <td>'.$faculty->getName().'</td>
                        <td>'.$faculty->getDean().'</td>
                        <td>'.$faculty->getStudentsCount().'</td>
                    </tr>';
        }

        $facultiesReportHtml .= '</tbody>
                </table>';
    }

    $facultiesReportHtml .= '</body>
    </html>';

    $facultiesReportHtml = file_put_contents($facultiesReportFileName, $facultiesReportHtml);
    if (false === $facultiesReportHtml) {
        echo "Не удалось сохранить файл: $facultiesReportFileName\n";
        $success = false;
    }

    $allStudents = $university->getAllStudents();
    $studentsReportFileName = 'students_report.html';
    $studentsReportHtml = '<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Список студентов - '.$university->getName().'</title>
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
        $studentsReportHtml .= '<p>Пока в университете нет ни одного студента</p>';
    } else {
        $studentsReportHtml .= '<table>
                    <thead>
                        <tr>
                            <th>Имя студента</th>
                            <th>Факультет</th>
                            <th>Средний бал</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($allStudents as $student) {
            $facultyName = $university->getFacultyForStudent($student)->getName();
            $studentsReportHtml .= '<tr>
                        <td>'.$student->getName().'</td>
                        <td>'.$facultyName.'</td>
                        <td>'.$student->getAverageGrade().'</td>
                    </tr>';
        }

        $studentsReportHtml .= '</tbody>
                </table>';
    }

    $studentsReportHtml .= '</body>
    </html>';
    $studentsReport = file_put_contents($studentsReportFileName, $studentsReportHtml);
    if (false === $studentsReport) {
        echo "Не удалось сохранить файл: $studentsReportFileName\n";

        $success = false;
    }
    if ($success) {
        echo "Отчеты успешно сохранены:\n";
        echo '- Отчет по факультетам: '.$facultiesReportFileName."\n";
        echo '- Отчет по студентам: '.$studentsReportFileName."\n";
        echo "\nОткройте эти файлы в браузере для просмотра.\n";
    }
} catch (InvalidArgumentException $e) {
    echo 'Ошибка в данных: '.$e->getMessage()."\n";
} catch (Exception $e) {
    echo 'Произошла непредвиденная ошибка: '.$e->getMessage()."\n";
}
