<?php
/**
 * 双闭二分
 * 查找区间【$left,$right】
 * 中止条件$left>$right，不会忽略$left=$right
 * +1、-1去掉$mid
 * 查不到返回-1
 */
function binarySearch1($search, $target)
{
    $left = 0;
    $right = count($search) - 1;
    while ($left <= $right) {
        $mid = $left + floor(($right - $left) / 2);
        if ($search[$mid] == $target) {
            return $mid;
        } elseif ($search[$mid] > $target) {
            $right = $mid - 1;
        } elseif ($search[$mid] < $target) {
            $left = $mid + 1;
        }
    }
    return -1;
}

/**
 * 左闭右开二分
 * 查找区间【$left,$right)
 * 中止条件$left=$right，会漏掉$left=$right
 * +1、-1去掉$mid
 * 漏掉$left=$right，所以不能直接返回-1
 */
function binarySearch2($search, $target)
{
    $left = 0;
    $right = count($search) - 1;
    while ($left < $right) {
        $mid = $left + floor(($right - $left) / 2);
        if ($search[$mid] == $target) {
            return $mid;
        } elseif ($search[$mid] > $target) {
            $right = $mid - 1;
        } elseif ($search[$mid] < $target) {
            $left = $mid + 1;
        }
    }
    return $search[$left] == $target ? $left : -1;
}

/**
 * 左边界二分
 * 查找区间【$left,$right】
 * $left>$right，不会忽略$left=$right
 * 遇到相等先不返回，右边界左偏移一位
 * while(false)时$left=$right+1有三种情况
 * 1.$left越界（$target>max($search)）
 * 2.$search[$left] != $target
 * 3.$search[$left] = $target（$left刚好为左边界）
 */
function binarySearch3($search, $target)
{
    $left = 0;
    $right = count($search) - 1;
    while ($left <= $right) {
        $mid = $left + floor(($right - $left) / 2);
        if ($search[$mid] == $target) {
            $right = $mid - 1;
        } elseif ($search[$mid] > $target) {
            $right = $mid - 1;
        } elseif ($search[$mid] < $target) {
            $left = $mid + 1;
        }
    }
    return $search[$left] && $search[$left] == $target ? $left : -1;
}

/**
 * 右边界二分，同左边界二分
 */
function binarySearch4($search, $target)
{
    $left = 0;
    $right = count($search) - 1;
    while ($left <= $right) {
        $mid = $left + floor(($right - $left) / 2);
        if ($search[$mid] == $target) {
            $left = $mid + 1;
        } elseif ($search[$mid] > $target) {
            $right = $mid - 1;
        } elseif ($search[$mid] < $target) {
            $left = $mid + 1;
        }
    }
    return $search[$right] && $search[$right] == $target ? $right : -1;
}