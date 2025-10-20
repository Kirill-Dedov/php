<?php

// Задача. Напишите функцию getAgeDifference(), которая принимает два года рождения и возвращает строку с разницей в возрасте в виде The age difference is 11.

function getAgeDifference($age1, $age2)
{
    $ageDifference = abs($age1 - $age2);

    return "The age difference is {$ageDifference}.";
}

echo getAgeDifference(200, 1);
