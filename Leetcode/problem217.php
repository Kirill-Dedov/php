<?php

// https:// leetcode.com/problems/contains-duplicate/description/?envType=problem-list-v2&envId=sorting

function containsDuplicate($nums)
{
    $counts = [];
    foreach ($nums as $num) {
        if (isset($counts[$num])) {
            return true;
        }
        $counts[$num] = true;
    }

    return false;
}
