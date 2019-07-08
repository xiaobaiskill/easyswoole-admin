<?php

namespace App\Common;

class AppFunc
{
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

    static public function makeTree($list, $parent_id = 0)
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
}
