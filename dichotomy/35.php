<?php

/**
 * 35. 搜索插入位置
 * 给定一个排序数组和一个目标值，在数组中找到目标值，并返回其索引。如果目标值不存在于数组中，返回它将会被按顺序插入的位置。你可以假设数组中无重复元素。
 * Example:
 * 1、输入: [1,3,5,6], 5  输出: 2
 * 2、输入: [1,3,5,6], 2  输出: 1
 * 3、输入: [1,3,5,6], 7  输出: 4
 * 4、输入: [1,3,5,6], 0  输出: 0
 */

var_dump((new Solution())->searchInsert([1, 3, 5, 6], 5));
var_dump((new Solution())->searchInsert([1, 3, 5, 6], 2));
var_dump((new Solution())->searchInsert([1, 3, 5, 6], 7));
var_dump((new Solution())->searchInsert([1, 3, 5, 6], 0));

class Solution
{
    /**
     * 二分法：
     * 搜索区间【0，count($nums) - 1】
     * 循环结束条件 right = left + 1
     * 因为无重复数据
     * 当 $nums[$mid] = $target 即为找到，直接返回
     * 当 $nums[$mid] > $target 说明在前半段，收right
     * 当 $nums[$mid] < $target 说明在后半段，收left
     * 即如果不存在时 left 和 right 的位置如下 $nums[$right] < $target < $nums[$left] 即返回 left
     */
    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function searchInsert($nums, $target)
    {
        $left = 0;
        $length = count($nums) - 1;
        $right = $length;
        while ($left <= $right) {
            $mid = floor(($left + $right) / 2);
            //echo $left."-".$right.$nums[$mid].PHP_EOL;
            if ($nums[$mid] == $target) {
                return $mid;
            } elseif ($nums[$mid] > $target) {
                $right = $mid - 1;
            } elseif ($nums[$mid] < $target) {
                $left = $mid + 1;
            }
        }
        return $left;
    }
}
