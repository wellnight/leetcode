<?php

/**
 * 167. 两数之和 II - 输入有序数组
 * 给定一个已按照升序排列的整数数组numbers，请你从数组中找出两个数满足相加之和等于目标数target 。
 * 函数应该以长度为 2 的整数数组的形式返回这两个数的下标值。
 * numbers 的下标 从 1 开始计数 ，所以答案数组应当满足 1 <= answer[0] < answer[1] <= numbers.length 。
 * 你可以假设每个输入只对应唯一的答案，而且你不可以重复使用相同的元素。
 *
 * Example:
 * 1、输入：numbers = [2,7,11,15], target = 9  输出：[1,2]  解释：2 与 7 之和等于目标数 9 。因此 index1 = 1, index2 = 2 。
 * 2、输入：numbers = [2,3,4], target = 6  输出：[1,3]
 * 3、输入：numbers = [-1,0], target = -1  输出：[1,2]
 *
 * 提示：
 * 2 <= numbers.length <= 3 * 104
 * -1000 <= numbers[i] <= 1000
 * numbers 按 递增顺序 排列
 * -1000 <= target <= 1000
 * 仅存在一个有效答案
 */

var_dump((new Solution())->twoSum([2, 7, 11, 15], 9));
var_dump((new Solution())->twoSum([2, 3, 4], 6));
var_dump((new Solution())->twoSum([-1, 0], -1));
var_dump((new Solution())->twoSum([5, 25, 75], 100));
var_dump((new Solution())->twoSum([1, 2, 3, 4, 4, 9, 56, 90], 8));

class Solution
{
    /**
     * @param Integer[] $numbers
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($numbers, $target)
    {
        /**
         * 二分法：
         * 外循环固定一个值 $numbers[$index] ，然后在数组中二分查找值 $target - $numbers[$index]
         *
         * 时间复杂度O(nlogn)
         * 空间复杂度O(1)
         */
        $length = count($numbers) - 1;
        for ($index = 0; $index <= $length; $index++) {
            $search = $target - $numbers[$index];
            $left = 0;
            $right = $length;
            while ($left <= $right) {
                $mid = floor(($left + $right) / 2);
                if ($numbers[$mid] == $search) {
                    /**
                     * 找到以后要确定是不是外循环固定的值，不是的话直接返回，是的话则 $numbers[$index] = $target - $numbers[$index]
                     * 即$target - $numbers[$index]在 $mid 的前一位或后一位
                     */
                    if ($mid == $index) {
                        if ($numbers[$mid - 1] == $search) {
                            return [++$index, $mid];
                        } else {
                            return [++$index, ++$mid + 1];
                        }
                    }
                    return [++$index, ++$mid];
                } elseif ($numbers[$mid] < $search) {
                    $left = $mid + 1;
                } elseif ($numbers[$mid] > $search) {
                    $right = $mid - 1;
                }
            }
        }
    }
}
