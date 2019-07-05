@extends('layouts.admin')


@section('body')
<div class="white p20">
    <table class="layui-hide" id="test" lay-filter="test"></table>
    <script type="text/html" id="toolbarDemo">
        <div class="layui-btn-container">
            <button class="layui-btn layui-btn-sm" lay-event="add">添加用户组</button>
        </div>
    </script>

    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="editRule">变更权限</a>
        <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>
</div>
@endsection


@section('javascriptFooter')
<script>
    layui.use('table', function(){
    var table = layui.table;

    table.render({
        elem: '#test'
        ,'url' :'/role/get_all'
        ,method:'post'
        ,toolbar: '#toolbarDemo'
        ,title: '角色权限表'
        ,cols: [[
        {field:'id', title:'ID', width:80, fixed: 'left', unresize: true, sort: true}
        ,{field:'name', title:'用户名', width:220, edit: 'text'}
        ,{field:'detail', title:'描述', edit: 'text'}
        ,{fixed: 'right', title:'操作', toolbar: '#barDemo', width: 180}
        ]]
        ,defaultToolbar:[]
        ,page: true
    });

    //头工具栏事件
    table.on('toolbar(test)', function(obj){
        switch(obj.event){
            case 'add':
                location.href="/";
            break;
        };
    });

    //监听行工具事件
    table.on('tool(test)', function(obj){
        var data = obj.data;
        if(obj.event === 'del'){
             layer.confirm('真的删除行么', function(index){
                $.post('/role/del/' + data.id ,'',function(data){
                    layer.close(index);
                    if(data.code != 0) {
                        layer.msg(data.msg);
                    } else {
                        obj.del();
                    }
                });
            });
        } else if(obj.event === 'edit'){
            layer.alert('delete');
        } else if(obj.event === 'editRule') {
            layer.open({
              type: 2,
              maxmin: true, // 显示最大最小化按钮
              area: ['500px', '450px'],
              title: '变更权限',
              content: '/role/edit_rule',
            });
        }
    });
});
</script>
@endsection
