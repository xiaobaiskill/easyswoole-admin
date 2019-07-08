@extends('layouts.admin')

@section('body')
<div id="rule" class="tree-rule-more"></div>

<div class="layui-btn-container p20">
  	<button type="button" class="layui-btn layui-btn-sm" lay-demo="save">保存</button>
</div>
@endsection


@section('javascriptFooter')
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
var arr = [];
function getCheck(data)
{
    for(var x in data) {
        if(data[x].children){
            getCheck(data[x].children)
        } else {
            arr.push(data[x].id);
        }
    }
}

function callback(data)
{
    if(data.code !== 0) {
        layer.msg(data.msg);
    } else {
        layer.msg('变更成功',{time:2000});
        parent.layer.close(parent.layer.getFrameIndex(window.name)); //再执行关闭
    }
}


layui.use(['tree', 'util'], function(){
  var tree = layui.tree
  ,layer = layui.layer
  ,util = layui.util
  ,data = @json($data);

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
		var checkedData = tree.getChecked('rules'); //获取选中节点的数据
        getCheck(checkedData);

        let datajson = {'rules' : arr };
        post('/role/edit_rule/{{$id}}', datajson, callback)
        arr = [];
    }
  });
  var checked = @json($checked);
  tree.setChecked('rules', checked.map(Number));

});
</script>
@endsection