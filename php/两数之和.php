<?php
/**
 * Author mapo
 * Date   2021/12/18
 */

/*
    给定一个整数数组 nums和一个整数目标值 target，请你在该数组中找出 和为目标值 target 的那两个整数，并返回它们的数组下标。

    你可以假设每种输入只会对应一个答案。但是，数组中同一个元素在答案里不能重复出现。

    你可以按任意顺序返回答案。

    思路：遵循数学算法 加数+被加数=总数  逆向思考 总数（target） - 加数 = 被加数

    然后利用hashindex检索算法存在被加数，即存在的话所得的加数和被加数就为所得答案
*/

//单个答案
function sum2(array $nums, int $target) : array
{
    for ($i = 0; $i < count($nums);$i++) {
        // 计算剩下的数
        $residue = $target - $nums[$i];
        // 匹配的index，有则返回index， 无则返回false
        $match_index = array_search($residue, $nums);
        if ($match_index !== false && $match_index != $i) {
            return array($i, $match_index);
        }
    }
    return [];
}

$res = sum2([1,2,3,4,5],5);
var_dump($res);

//多个答案
function sum_more(array $nums, int $target) : array
{
    $res = [];
    for ($i = 0; $i < count($nums);$i++) {
        // 计算剩下的数
        $residue = $target - $nums[$i];
        // 匹配的index，有则返回index， 无则返回false
        $match_index = array_search($residue, $nums);
        if ($match_index !== false && $match_index != $i) {
            $key = min($i, $match_index).'_'.max($i, $match_index);
            if (!isset($res[$key])) {
                $res[$key] = array_map(function ($value){
                    return intval($value);
                }, explode('_', $key));
            }
        }
    }
    return array_values($res);
}

$res = sum_more([1,2,3,4,5],5);
var_dump($res);