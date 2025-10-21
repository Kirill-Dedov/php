<?php

// https:// leetcode.com/problems/longest-common-prefix/description/?envType=problem-list-v2&envId=array

function longestCommonPrefix($strs)
{
    $commonPrefix = '';
    $arrLength = count($strs);
    if (0 === $arrLength) {
        return $commonPrefix;
    } elseif (1 === $arrLength) {
        return $strs[0];
    } else {
        $j = 0;
        while (true) {
            if (strlen($strs[0]) <= $j) {
                return $commonPrefix;
            }
            $temp = $strs[0][$j];
            for ($i = 1; $i < $arrLength; ++$i) {
                if (strlen($strs[$i]) <= $j || $strs[$i][$j] !== $temp) {
                    return $commonPrefix;
                }
            }
            $commonPrefix .= $temp;
            ++$j;
        }
    }

    return $commonPrefix;
}
