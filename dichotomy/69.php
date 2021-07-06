<?php

/**
 * 69. x 的平方根
 * 实现 int sqrt(int x) 函数。
 * 计算并返回 x 的平方根，其中 x 是非负整数。由于返回类型是整数，结果只保留整数的部分，小数部分将被舍去。
 * Example:
 * 1、输入: 4  输出: 2
 * 2、输入: 8  输出: 2 说明: 8 的平方根是 2.82842...,由于返回类型是整数，小数部分将被舍去。
 */

var_dump((new Solution())->mySqrt(4));
var_dump((new Solution())->mySqrt(8));

class Solution
{
    /**
     * @param Integer $x
     * @return Integer
     */
    function mySqrt($x)
    {
        $left = 0;
        $right = $x;
        while ($left <= $right) {
            $mid = floor(($left + $right) / 2);
            $square = $mid * $mid;
            if ($square == $x) {
                return $mid;
            } elseif ($square >= $x) {
                $right = $mid - 1;
            } elseif ($square <= $x) {
                $left = $mid + 1;
            }
        }
        return $right;
    }
}
