<?php

/**
 * 76. 最小覆盖子串
 * 题目:给你一个字符串 s 、一个字符串 t 。返回 s 中涵盖 t 所有字符的最小子串。如果 s 中不存在涵盖 t 所有字符的子串，则返回空字符串 ""
 * Example:
 * 1、输入：s = "ADOBECODEBANC", t = "ABC"  输出："BANC"
 * 2、输入：s = "a", t = "a"  输出："a"
 */
class Solution
{
    /**
     * 滑动窗口解法
     * @param $source
     * @param $target
     * @return false|string
     */
    public function slidingWindow($source, $target)
    {
        $targetMap = $windowMap = [];

        $left = $right = 0;

        $targetLength = strLen($target);
        $sourceLength = strLen($source);

        $match = 0;
        $start = 0;
        $minLength = PHP_INT_MAX;

        for ($i = 0; $i < $targetLength; $i++) {
            $targetMap[$target[$i]]++;
        }

        while ($right < $sourceLength) {
            $windowMap[$source[$right]]++;
            if ($windowMap[$source[$right]] == $targetMap[$source[$right]]) {
                $match++;
            }
            $right++;
            while ($match == count($targetMap)) {
                if ($minLength > $right - $left) {
                    $start = $left;
                    $minLength = $right - $left;
                }
                $windowMap[$source[$left]]--;
                if ($windowMap[$source[$left]] < $targetMap[$source[$left]]) {
                    $match--;
                }
                $left++;
            }

        }
        return $minLength == PHP_INT_MAX ? "" : substr($source, $start, $minLength);
    }

    /**
     * 优化$left的无用遍历
     * @param $source
     * @param $target
     * @return false|string
     */
    public function slidingWindow1($source, $target)
    {
        $targetMap = $windowMap = [];

        $left = $right = 0;

        $targetLength = strLen($target);
        $sourceLength = strLen($source);

        $match = 0;
        $start = 0;
        $minLength = PHP_INT_MAX;

        for ($i = 0; $i < $targetLength; $i++) {
            $targetMap[$target[$i]]++;
        }

        while ($right < $sourceLength) {
            if ($left == $right && !$targetMap[$source[$right]]) {
                $left++;
                $right++;
            } else {
                $windowMap[$source[$right]]++;
                if ($windowMap[$source[$right]] == $targetMap[$source[$right]]) {
                    $match++;
                }
                $right++;
                while ($match == count($targetMap)) {
                    if ($minLength > $right - $left) {
                        $start = $left;
                        $minLength = $right - $left;
                    }
                    $windowMap[$source[$left]]--;
                    if ($windowMap[$source[$left]] < $targetMap[$source[$left]]) {
                        $match--;
                    }
                    $left++;
                }
            }
        }
        return $minLength == PHP_INT_MAX ? "" : substr($source, $start, $minLength);
    }
}