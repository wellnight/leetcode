<?php

/**
 * 51. n皇后问题
 * 题目:如何将 n 个皇后放置在 n×n 的棋盘上，并且使皇后彼此之间不能相互攻击。
 * 给你一个整数 n ，返回所有不同的 n 皇后问题 的解决方案。每一种解法包含一个不同的 n 皇后问题 的棋子放置方案，该方案中 'Q' 和 '.' 分别代表了皇后和空位。
 * Example:
 * 1、输入：n = 4  输出：[[".Q..","...Q","Q...","..Q."],["..Q.","Q...","...Q",".Q.."]]
 * 2、输入：n = 1  输出：[["Q"]]
 * 提示：
 * 1 <= n <= 9
 * 皇后彼此不能相互攻击，也就是说：任何两个皇后都不能处于同一条横行、纵行或斜线上。
 */

//var_dump((new Solution())->solveQueens(4));

class Solution
{
    private $boardMap = [];
    private $results = [];
    private $n;

    function solveNQueens($n)
    {
        $this->n = $n;
        $str = '';
//        $this->boardMap = array_fill(0, 8, str_pad("", 8, ".", STR_PAD_RIGHT));
        for ($j = 0; $j < $this->n; $j++) {
            $str .= '.';
        }
        for ($i = 0; $i < $this->n; $i++) {
            $this->boardMap[$i] = $str;
        }
        $this->putQueen(1);
        return $this->results;
    }

    function putQueen($k)
    {
        if ($k > $this->n) {
            $this->results[] = $this->boardMap;
            return false;
        }
        $row = $k - 1;
        for ($col = 0; $col < $this->n; $col++) {
            if (!$this->check($row, $col)) {
                continue;
            }
            $this->boardMap[$row][$col] = 'Q';
            $this->putQueen($k + 1);
            $this->boardMap[$row][$col] = '.';
        }
    }

    function check($row, $col)
    {
        for ($i = $row - 1; $i >= 0; $i--) {
            $diff = $row - $i;
            if ($this->boardMap[$i][$col] === 'Q') {
                return false;
            }
            if ($col - $diff >= 0 && $this->boardMap[$i][$col - $diff] === 'Q') {
                return false;
            }
            if ((($col + $diff) <= ($this->n - 1)) && ($this->boardMap[$i][$col + $diff] === 'Q')) {
                return false;
            }
        }
        return true;
    }
}