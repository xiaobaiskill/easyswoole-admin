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
                    self::treeRule($v[$child], $tree, $pre . '&nbsp;|-----&nbsp;');
                }
            }
        }
    }


}
