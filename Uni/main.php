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

    $files = $university->saveAllReports();
    echo "Отчеты успешно сохранены:\n";
    echo '- Отчет по факультетам: '.$files['faculties']."\n";
    echo '- Отчет по студентам: '.$files['students']."\n";
    echo "\nОткройте эти файлы в браузере для просмотра.\n";
} catch (InvalidArgumentException $e) {
    echo 'Ошибка в данных: '.$e->getMessage()."\n";
} catch (RuntimeException $e) {
    echo 'Ошибка при сохранении файлов: '.$e->getMessage()."\n";
} catch (Exception $e) {
    echo 'Произошла непредвиденная ошибка: '.$e->getMessage()."\n";
}
