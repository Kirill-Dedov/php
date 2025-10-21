<?php

// https:// leetcode.com/problems/search-insert-position/description/?envType=problem-list-v2&envId=array

function searchInsert($nums, $target)
{
    $right = count($nums) - 1;
    $left = 0;
    $mid = 0;

    while ($left <= $right) {
        $mid = (int) (($left + $right) / 2);
        if ($nums[$mid] === $target) {
            return $mid;
        } elseif ($nums[$mid] < $target) {
            $left = $mid + 1;
        } else {
            $right = $mid - 1;
        }
    }

    return $left;
}
