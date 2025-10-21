<?php

// https:// leetcode.com/problems/two-sum/?envType=problem-list-v2&envId=array

function twoSum($nums, $target)
{
    $map = [];
    foreach ($nums as $currentIndex => $currentNum) {
        $complement = $target - $currentNum;

        if (isset($map[$complement])) {
            return [$map[$complement], $currentIndex];
        }

        $map[$currentNum] = $currentIndex;
    }

    return [];
}
