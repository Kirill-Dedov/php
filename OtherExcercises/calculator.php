<?php

function add($a, $b)
{
    return $a + $b;
}
function multiply($a, $b)
{
    return $a * $b;
}
function subtract($a, $b)
{
    return $a - $b;
}
function divide($a, $b)
{
    if (0 === $b) {
        throw new InvalidArgumentException('Делить на ноль нельзя!');
    }

    return $a / $b;
}
function power($a, $b)
{
    return $a ** $b;
}
