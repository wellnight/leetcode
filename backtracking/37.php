<?php

$a = [
    ["5", "3", ".", ".", "7", ".", ".", ".", "."],
    ["6", ".", ".", "1", "9", "5", ".", ".", "."],
    [".", "9", "8", ".", ".", ".", ".", "6", "."],
    ["8", ".", ".", ".", "6", ".", ".", ".", "3"],
    ["4", ".", ".", "8", ".", "3", ".", ".", "1"],
    ["7", ".", ".", ".", "2", ".", ".", ".", "6"],
    [".", "6", ".", ".", ".", ".", "2", "8", "."],
    [".", ".", ".", "4", "1", "9", ".", ".", "5"],
    [".", ".", ".", ".", "8", ".", ".", "7", "9"]];

(new Solution())->solveSudoku($a);
echo json_encode($a);

/**
 * 37. 数独问题
 * 题目:编写一个程序，通过填充空格来解决数独问题。
 * 一个数独的解法需遵循如下规则：
 * 1、数字1-9在每一行只能出现一次。
 * 2、数字1-9在每一列只能出现一次。
 * 3、数字1-9在每一个以粗实线分隔的3x3宫内只能出现一次。
 * Example:
 * 输入：
 * [
 * ["5", "3", ".", ".", "7", ".", ".", ".", "."],
 * ["6", ".", ".", "1", "9", "5", ".", ".", "."],
 * [".", "9", "8", ".", ".", ".", ".", "6", "."],
 * ["8", ".", ".", ".", "6", ".", ".", ".", "3"],
 * ["4", ".", ".", "8", ".", "3", ".", ".", "1"],
 * ["7", ".", ".", ".", "2", ".", ".", ".", "6"],
 * [".", "6", ".", ".", ".", ".", "2", "8", "."],
 * [".", ".", ".", "4", "1", "9", ".", ".", "5"],
 * [".", ".", ".", ".", "8", ".", ".", "7", "9"]
 * ]
 * 输出：
 * 提示:
 * 给定的数独序列只包含数字 1-9 和字符 '.' 。
 * 你可以假设给定的数独只有唯一解。
 * 给定数独永远是 9x9 形式的。
 */
class Solution
{
    private $boardMap = [];

    private $result;
    private $rule = 3;

    public function solveSudoku(&$board)
    {
        $this->boardMap = &$board;
        $this->recursive(0, 0);
        return $this->result;
    }

    /**
     * 递归体
     * @param $row
     * @param $col
     * @return bool
     */
    public function recursive($row, $col)
    {
        if ($col == 9) {
            return $this->recursive($row + 1, 0);
        }
        if ($row == 9) {
            $this->result = $this->boardMap;
            return true;
        }
        for ($i = $row; $i <= $row; $i++) {
            for ($j = $col; $j <= $col; $j++) {
                if ($this->boardMap[$i][$j] === '.') {
                    for ($m = 1; $m <= 9; $m++) {
                        if ($this->check($i, $j, (string)$m)) {
                            $this->boardMap[$row][$col] = (string)$m;
                            if ($this->recursive($i, $j + 1)) {
                                return true;
                            }
                            $this->boardMap[$row][$col] = ".";
                        }
                    }
                } elseif ($this->recursive($i, $j + 1)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * 位置检测
     * @param $row
     * @param $col
     * @param $value
     * @return bool
     */
    public function check($row, $col, $value)
    {
        for ($i = 0; $i < 9; $i++) {
            if ($this->boardMap[$row][$i] === $value) {
                return false;
            }
            if ($this->boardMap[$i][$col] === $value) {
                return false;
            }
        }
        $beginRow = floor($row / $this->rule) * 3;
        $beginCol = floor($col / $this->rule) * 3;
        for ($i = 0; $i < $this->rule; $i++) {
            $roleNum = $beginRow + $i;
            for ($j = 0; $j < $this->rule; $j++) {
                $colNum = $beginCol + $j;
                if ($this->boardMap[$roleNum][$colNum] === $value) {
                    return false;
                }
            }
        }
        return true;
    }
}