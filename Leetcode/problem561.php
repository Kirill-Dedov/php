<?php

// https:// leetcode.com/problems/array-partition/?envType=problem-list-v2&envId=greedy

function arrayPairSum($nums)
{
    sort($nums);
    $result = 0;
    for ($i = 0; $i < count($nums); $i += 2) {
        $result += $nums[$i];
    }

    return $result;
}
