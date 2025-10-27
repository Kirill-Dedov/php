<?php

function findMax($numbers)
{
    if (empty($numbers)) {
        return null;
    }

    return max($numbers);
}

function findMin($numbers)
{
    if (empty($numbers)) {
        return null;
    }

    return min($numbers);
}

function calculateAverage($numbers)
{
    if (empty($numbers)) {
        return null;
    }

    return array_sum($numbers) / count($numbers);
}

function filterEvenNumbers($numbers)
{
    return array_filter($numbers, function ($n) {
        return 0 === $n % 2;
    });
}

function countItem($array, $value)
{
    $count = 0;
    foreach ($array as $item) {
        if ($item === $value) {
            ++$count;
        }
    }

    return $count;
}
