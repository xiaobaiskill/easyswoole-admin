@extends('layouts.admin')

@section('body')
<table class="layui-hide" id="test" lay-filter="test"></table>
<script type="text/html" id="toolbarDemo">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-normal layui-btn-sm" lay-event="del">添加权限</button>
    </div>
</script>

<script type="text/html" id="barDemo">
  <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
@endsection


@section('javascriptFooter')
<script>
    layui.use('table', function(){
    var table = layui.table;

    table.render({
        elem: '#test'
        ,'url':'/admin/rules/get_all'
        ,method:'post'
        ,toolbar: '#toolbarDemo'
        ,title: '权限'
        ,cols: [[
        {field:'id', title:'ID', width:80, fixed: 'left', unresize: true, sort: true}
        ,{field:'name', title:'用户名', width:220, edit: 'text'}
        ,{field:'url', title:'路径', edit: 'text'}
        ,{field:'menu', title:'是否菜单', width:220}
        ,{field:'status', title:'是否启用', width:220}
        ,{field:'created_at', title:'创建时间', width:220}
        ,{fixed: 'right', title:'操作', toolbar: '#barDemo', width: 180}
        ]]
        ,defaultToolbar:[]
        ,page: true
    });

    //头工具栏事件
    table.on('toolbar(test)', function(obj){
        var checkStatus = table.checkStatus(obj.config.id);
        switch(obj.event){
            case 'del':
            var data = checkStatus.data;
            layer.alert(JSON.stringify(data));
            break;
            case 'add':
            var data = checkStatus.data;
            layer.msg('选中了：'+ data.length + ' 个');
            break;
        };
    });

    //监听行工具事件
    table.on('tool(test)', function(obj){
        var data = obj.data;
        //console.log(obj)
        if(obj.event === 'del'){
            layer.confirm('真的删除行么', function(index){
                obj.del();
                layer.close(index);
            });
        } else if(obj.event === 'edit'){
            layer.alert('delete');
        } else if(obj.event === 'editRule') {
            layer.open({
              type: 2,
              maxmin: true, // 显示最大最小化按钮
              area: ['500px', '450px'],
              title: '修改权限',
              content: '/admin/auth/edit_rule',

            });
        }
    });
});
</script>
@endsection
