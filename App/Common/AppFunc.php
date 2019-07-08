<?php

namespace App\Common;

class AppFunc
{
    // 二维数组 转 tree
    static public function arrayToTree($list,$pid = 'pid')
    {
    	$map = [];
    	if(is_array($list)){
    		foreach ($list as $k => $v) {
    			$map[$v[$pid]][] = $v;  // 同一个pid 放在同一个数组中
    		}
    	}

    	return self::makeTree($map);
    }

    static private function makeTree($list, $parent_id = 0)
    {
    	$items = isset($list[$parent_id]) ? $list[$parent_id] : [];
    	if(!$items)
    	{
    		return null;
    	}

    	$trees = [];
    	foreach ($items as $k => $v) {
    		$children = self::makeTree($list, $v['id']);  // 找到以这个id 为pid 的数据
     		if($children){
     			$v['children'] = $children;
     		}
     		$trees[] = $v;
    	}

    	return $trees;
    }

    // 规则 |--- 就分的
    static public function treeRule($tree_list, &$tree , $pre = '', $child = 'children')
    {
        if(is_array($tree_list)) {
            foreach ($tree_list as $k => $v) {
                $v['name'] = $pre . $v['name'];
                $tree[] = $v;
                if(isset($v[$child])) {
                    self::treeRule($v[$child], $tree, $pre . '&nbsp;|------&nbsp;');
                }
            }
        }
    }

    /**
     * 获得随机字符串
     * @param $len             需要的长度
     * @param $special        是否需要特殊符号
     * @return string       返回随机字符串
     */
    static public function getRandomStr($len, $special=true){
        $chars = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
            "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
            "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
            "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
            "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
            "3", "4", "5", "6", "7", "8", "9"
        );

        if($special){
            $chars = array_merge($chars, array(
                "!", "@", "#", "$", "?", "|", "{", "/", ":", ";",
                "%", "^", "&", "*", "(", ")", "-", "_", "[", "]",
                "}", "<", ">", "~", "+", "=", ",", "."
            ));
        }

        $charsLen = count($chars) - 1;
        shuffle($chars);                            //打乱数组顺序
        $str = '';
        for($i=0; $i<$len; $i++){
            $str .= $chars[mt_rand(0, $charsLen)];    //随机取出一位
        }
        return $str;
    }

}