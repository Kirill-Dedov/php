<?php

function parseHttpApi()
{
    $url = 'http://api.open-notify.org/astros.json';

    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return 'Ошибка: Неверный URL';
    }

    $response = file_get_contents($url);

    if (false === $response) {
        return 'Ошибка: Не удалось получить данные';
    }

    $data = json_decode($response, true);

    if (JSON_ERROR_NONE !== json_last_error()) {
        return 'Ошибка: Невалидный JSON';
    }

    if (!isset($data['number']) || !isset($data['people'])) {
        return 'Ошибка: Неполные данные в ответе';
    }

    $result = "ЛЮДИ В КОСМОСЕ:\n";
    $result .= "==============\n\n";
    $result .= 'Всего человек на МКС: '.$data['number']."\n\n";

    foreach ($data['people'] as $person) {
        if (!isset($person['name']) || !isset($person['craft'])) {
            continue;
        }
        $result .= '• '.$person['name'].' - на '.$person['craft']."\n";
    }

    return $result;
}

echo parseHttpApi();
