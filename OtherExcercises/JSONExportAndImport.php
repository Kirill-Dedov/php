<?php

function exportUsersToJSON($users, $filename = 'users_export.json')
{
    $json_data = json_encode($users, JSON_PRETTY_PRINT);

    if (false === file_put_contents($filename, $json_data)) {
        throw new Exception("Failed to write JSON file: $filename");
    }

    return $filename;
}

function readUsersFromJSON($filename = 'users_export.json')
{
    if (!file_exists($filename)) {
        throw new Exception("File not found: $filename");
    }

    $json_content = file_get_contents($filename);

    if (false === $json_content) {
        throw new Exception("Failed to read file: $filename");
    }

    $users = json_decode($json_content, true);

    if (JSON_ERROR_NONE !== json_last_error()) {
        throw new Exception('Invalid JSON format: '.json_last_error_msg());
    }

    return $users;
}

$users = [
    ['id' => 1, 'john' => 'name1', 'email' => 'john@example.com', 'reg_date' => '1111-11-11'],
    ['id' => 2, 'jane' => 'name2', 'email' => 'jane@example.com', 'reg_date' => '2222-02-02'],
    ['id' => 3, 'bob' => 'name3', 'email' => 'bob@example.com', 'reg_date' => '3333-03-03'],
];

try {
    echo "=== Step 1: Exporting Users to JSON ===\n";
    $exported_file = exportUsersToJSON($users);
    echo "JSON exported to: $exported_file\n\n";

    echo "=== Step 2: Reading Users from JSON ===\n";
    $importedUsers = readUsersFromJSON($exported_file);

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
