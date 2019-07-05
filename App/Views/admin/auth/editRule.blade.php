@extends('layouts.admin')

@section('body')
<div id="rule" class="tree-rule-more"></div>
<div class="layui-btn-container">
  	<button type="button" class="layui-btn layui-btn-sm" lay-demo="save">保存</button>
</div>
@endsection


@section('javascriptFooter')
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
layui.use(['tree', 'util'], function(){
  var tree = layui.tree
  ,layer = layui.layer
  ,util = layui.util

   ,data = [{
    title: '一级1'
    ,id: 1
    ,checked: 1
    ,children: [{
      title: '二级1-1 可允许跳转'
      ,id: 3
      ,href: 'https://www.layui.com/'
      ,children: [{
        title: '三级1-1-3'
        ,id: 23
        ,children: [{
          title: '四级1-1-3-1'
          ,id: 24
          ,children: [{
            title: '五级1-1-3-1-1'
            ,id: 30
          },{
            title: '五级1-1-3-1-2'
            ,id: 31
          }]
        }]
      },{
        title: '三级1-1-1'
        ,id: 7
        ,children: [{
          title: '四级1-1-1-1 可允许跳转'
          ,id: 15
          ,href: 'https://www.layui.com/doc/'
        }]
      },{
        title: '三级1-1-2'
        ,id: 8
        ,children: [{
          title: '四级1-1-2-1'
          ,id: 32
        }]
      }]
    },{
      title: '二级1-2'
      ,id: 4
      ,spread: true
      ,children: [{
        title: '三级1-2-1'
        ,id: 9
        ,disabled: true
      },{
        title: '三级1-2-2'
        ,id: 10
      }]
    },{
      title: '二级1-3'
      ,id: 20
      ,children: [{
        title: '三级1-3-1'
        ,id: 21
      },{
        title: '三级1-3-2'
        ,id: 22
      }]
    }]
  },{
    title: '一级2'
    ,id: 2
    ,spread: true
    ,children: [{
      title: '二级2-1'
      ,id: 5
      ,spread: true
      ,children: [{
        title: '三级2-1-1'
        ,id: 11
      },{
        title: '三级2-1-2'
        ,id: 12
      }]
    },{
      title: '二级2-2'
      ,id: 6
      ,children: [{
        title: '三级2-2-1'
        ,id: 13
      },{
        title: '三级2-2-2'
        ,id: 14
        ,disabled: true
      }]
    }]
  },{
    title: '一级3'
    ,id: 16
    ,children: [{
      title: '二级3-1'
      ,id: 17
      ,fixed: true
      ,children: [{
        title: '三级3-1-1'
        ,id: 18
      },{
        title: '三级3-1-2'
        ,id: 19
      }]
    },{
      title: '二级3-2'
      ,id: 27
      ,children: [{
        title: '三级3-2-1'
        ,id: 28
      },{
        title: '三级3-2-2'
        ,id: 29
      }]
    }]
  }]
    //基本演示
  tree.render({
    elem: '#rule'
    ,data: data
    ,showCheckbox: true  //是否显示复选框
    ,id: 'rules'
    ,isJump: true //是否允许点击节点时弹出新窗口跳转
  });

  //按钮事件
  util.event('lay-demo', {
    save: function(othis){
		// var checkedData = tree.getChecked('rules'); //获取选中节点的数据

		// layer.alert(JSON.stringify(checkedData), {shade:0});

		var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
		parent.layer.close(index); //再执行关闭
    }
  });

});
</script>
@endsection