<?php
//$str = "fgggggdg saaaafaaaagsddddfdgfd";
//$target = "f s";
//var_dump(slidingWindow($str, $target));

function slidingWindow($str, $target)
{
    $targetHash = [];
    $windowHash = [];

    $targetLength = strlen($target);
    if ($targetLength == 0) {
        return "";
    }
    for ($i = 0; $i < $targetLength; $i++) {
        $targetHash[$target[$i]]++;
    }
    $charNum = count($targetHash);
    $start = 0;
    $match = 0;
    $start = 0;
    $left = $right = 0;
    $minLength = PHP_INT_MAX;
    $length = strlen($str);
    while ($right < $length) {
        $windowHash[$str[$right]]++;
        if ($targetHash[$str[$right]] == $windowHash[$str[$right]]) {
            $match++;
        }
        $right++;
        while ($match == $charNum) {
            if ($minLength > $right - $left) {
                $start = $left;
                $minLength = $right - $left;
            }
            $windowHash[$str[$left]]--;
            if ($windowHash[$str[$left]] < $targetHash[$str[$left]]) {
                $match--;
            }
            $left++;
        }
    }
    return $minLength != PHP_INT_MAX ? substr($str, $start, $minLength) : "";
}

//给定一个字符串 s 和一个非空字符串 p，找到 s 中所有是 p 的字母异位词的子串，返回这些子串的起始索引。
//字符串只包含小写英文字母，并且字符串 s 和 p 的长度都不超过 20100。
//说明：
//字母异位词指字母相同，但排列不同的字符串。
//不考虑答案输出的顺序。
//示例 1:
//输入:
//s: "cbaebabacd" p: "abc"
//输出:
//[0, 6]
//$str = "cbaebabacd";$target="abc";
//var_dump(slidingWindow1($str,$target));
function slidingWindow1($str, $target)
{
    $targetHash = [];
    $windowHash = [];

    $targetLength = strlen($target);
    if ($targetLength == 0) {
        return "";
    }
    for ($i = 0; $i < $targetLength; $i++) {
        $targetHash[$target[$i]]++;
    }

    $charNum = count($targetHash);
    $match = 0;
    $left = $right = 0;
    $results = [];
    $length = strlen($str);
    while ($right < $length) {
        $windowHash[$str[$right]]++;
        if ($targetHash[$str[$right]] == $windowHash[$str[$right]]) {
            $match++;
        }
        $right++;
        while ($match == $charNum) {
            if ($targetLength == $right - $left) {
                $results[] = $left;
            }
            $windowHash[$str[$left]]--;
            if ($windowHash[$str[$left]] < $targetHash[$str[$left]]) {
                $match--;
            }
            $left++;
        }
    }
    return $results;
}

$str = "cbaebabacd";
var_dump(slidingWindow11($str));
//无重复字符的最长子串
function slidingWindow11($str)
{
    $windowHash = [];

    $left = $right = 0;
    $maxLength = 0;
    $length = strlen($str);
    while ($right < $length) {
        $beforRight = $str[$right];
        $windowHash[$str[$right]]++;
        $right++;
        while ($windowHash[$beforRight] > 1) {
            $windowHash[$str[$left]]--;
            $left++;
        }
        if ($maxLength < $right - $left) {
            $maxLength = $right - $left;
        }
    }
    return $maxLength != 0 ? substr($str, $left, $maxLength) : "";
}

function slidingWindows($str, $target)
{
    $left = $right = 0;
    $window = [];
    while ($right < strlen($str)) {
        $window->add($str[$right]);
        $right++;
        while (valid) {
            $window->remove($str[$left]);
            $left++;
        }
    }
}