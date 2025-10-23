<?php

// https:// leetcode.com/problems/merge-sorted-array/description/?envType=problem-list-v2&envId=sorting

function merge(&$nums1, $m, $nums2, $n)
{
    array_splice($nums1, $m, $n, $nums2);
    usort($nums1, fn ($a, $b) => $a - $b);
}
