<?php

// https:// leetcode.com/problems/remove-element/description/?envType=problem-list-v2&envId=array

function removeElement(&$nums, $val)
{
    $counter = 0;
    for ($i = count($nums) - 1; $i >= 0; --$i) {
        if ($nums[$i] === $val) {
            array_splice($nums, $i, 1);
        } else {
            ++$counter;
        }
    }

    return $counter;
}
