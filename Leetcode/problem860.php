<?php

// https:// leetcode.com/problems/lemonade-change/description/?envType=problem-list-v2&envId=greedy

function lemonadeChange($bills)
{
    $five = 0;
    $ten = 0;
    $result = true;
    for ($i = 0; $i < count($bills); ++$i) {
        if (5 === $bills[$i]) {
            ++$five;
            continue;
        } elseif (10 === $bills[$i]) {
            if ($five > 0) {
                --$five;
                ++$ten;
                continue;
            } else {
                $result = false;
                break;
            }
        } else {
            if ($ten > 0 && $five > 0) {
                --$five;
                --$ten;
                continue;
            } elseif ($five > 2) {
                $five -= 3;
                continue;
            } else {
                $result = false;
                break;
            }
        }
    }

    return $result;
}
