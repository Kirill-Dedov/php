<?php

// https:// leetcode.com/problems/majority-element/description/?envType=problem-list-v2&envId=sorting

function majorityElement($nums)
{
    $counts = [];
    foreach ($nums as $num) {
        $counts[$num] = isset($counts[$num]) ? $counts[$num] + 1 : 1;
    }

    $max = max($counts);

    return array_search($max, $counts);
}
