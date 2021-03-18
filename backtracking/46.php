<?php

/**
 * 46. 全排列
 * 题目:给定一个 没有重复 数字的序列，返回其所有可能的全排列。
 * Example:
 * 输入：[1,2,3]  输出：[[1,2,3],[1,3,2],[2,1,3],[2,3,1],[3,1,2],[3,2,1]]
 */

//var_dump((new Solution())->permute([1, 2, 3]));

class Solution
{
    private $results = [];

    function permute($nums)
    {
        $this->recursive([], $nums);
        return $this->results;
    }

    function recursive($result, $nums)
    {
        if (!$nums) {
            $this->results[] = $result;
            return;
        }
        foreach ($nums as $k => $v) {
            unset($nums[$k]);
            array_push($result, $v);
            $this->recursive($result, $nums);
            $nums[$k] = $v;
            array_pop($result);
        }
    }
}