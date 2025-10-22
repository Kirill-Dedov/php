<?php

function exportUsersToCSV($users, $filename = 'users_export.csv')
{
    $file = fopen($filename, 'w');

    fputcsv($file, ['ID', 'Name', 'Email', 'Registration Date'], ',', '"', '\\');

    foreach ($users as $user) {
        fputcsv($file, [
            $user['id'],
            $user['name'],
            $user['email'],
            $user['reg_date'],
        ], ',', '"', '\\');
    }

    fclose($file);

    return $filename;
}

function importUsersFromCSVWithFile($filename = 'users_export.csv')
{
    if (!file_exists($filename)) {
        throw new Exception("File not found: $filename");
    }

    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if (false === $lines) {
        throw new Exception("Failed to read file: $filename");
    }

    $users = [];
    $headers = str_getcsv(array_shift($lines), ',', '"', '\\');

    foreach ($lines as $lineNumber => $line) {
        $row = str_getcsv($line, ',', '"', '\\');

        if (4 === count($row)) {
            $users[] = [
                'id' => $row[0],
                'name' => $row[1],
                'email' => $row[2],
                'reg_date' => $row[3],
            ];
        }
    }

    return $users;
}

$users = [
    ['id' => 1, 'john' => 'name1', 'email' => 'john@example.com', 'reg_date' => '1111-11-11'],
    ['id' => 2, 'jane' => 'name2', 'email' => 'jane@example.com', 'reg_date' => '2222-02-02'],
    ['id' => 3, 'bob' => 'name3', 'email' => 'bob@example.com', 'reg_date' => '3333-03-03'],
];

try {
    echo "=== Step 1: Exporting Users to CSV ===\n";
    $exported_file = exportUsersToCSV($users);
    echo "CSV exported to: $exported_file\n\n";

    echo "=== Step 2: Reading Users from CSV ===\n";
    $importedUsers = importUsersFromCSVWithFile($exported_file);
    echo 'Found '.count($importedUsers)." users:\n\n";

    foreach ($importedUsers as $user) {
        echo 'ID: '.$user['id']."\n";
        echo 'Name: '.$user['name']."\n";
        echo 'Email: '.$user['email']."\n";
        echo 'Registration Date: '.$user['reg_date']."\n";
        echo "------------------------\n";
    }
} catch (Exception $e) {
    echo 'Error: '.$e->getMessage()."\n";
}
