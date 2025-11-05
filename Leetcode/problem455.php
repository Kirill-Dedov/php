<?php

// https:// leetcode.com/problems/assign-cookies/?envType=problem-list-v2&envId=greedy

function findContentChildren($g, $s)
{
    sort($g);
    sort($s);
    $childrenIndex = 0;
    $cookiesIndex = 0;
    $contentChildren = 0;
    while ($childrenIndex < count($g) && $cookiesIndex < count($s)) {
        if ($g[$childrenIndex] <= $s[$cookiesIndex]) {
            ++$contentChildren;
            ++$childrenIndex;
        }
        ++$cookiesIndex;
    }

    return $contentChildren;
}
