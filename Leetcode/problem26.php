<?php

// https://leetcode.com/problems/remove-duplicates-from-sorted-array/description/?envType=problem-list-v2&envId=array

function removeDuplicates(&$nums)
{
    $length = count($nums);
    $slowIndex = 0;

    for ($fastIndex = 1; $fastIndex < $length; ++$fastIndex) {
        if ($nums[$slowIndex] !== $nums[$fastIndex]) {
            ++$slowIndex;
            $nums[$slowIndex] = $nums[$fastIndex];
        }
    }

    return $slowIndex + 1;
}
