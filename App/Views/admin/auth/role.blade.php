@extends('layouts.admin')

@section('body')
<div class="white p20">
    <table class="layui-hide" id="test" lay-filter="test"></table>
    <script type="text/html" id="toolbarDemo">
        @if($role_group->hasRule('auth.role.add'))
            <div class="layui-btn-container">
                <button class="layui-btn layui-btn-sm" lay-event="add">添加用户组</button>
            </div>
        @endif
    </script>

    <script type="text/html" id="barDemo">
        @if($role_group->hasRule('auth.role.rule'))
            <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="editRule">变更权限</a>
        @endif
        @if($role_group->hasRule('auth.role.set'))
            <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
        @endif

        @if($role_group->hasRule('auth.role.del'))
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
        @endif
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
        ,{field:'name', title:'用户名', width:220 @if($role_group->hasRule('auth.role.set')), edit: 'text' , event:'edit_name' @endif }
        ,{field:'detail', title:'描述' @if($role_group->hasRule('auth.role.set')), edit: 'text' , event:'edit_detail' @endif}
        ,{field:'created_at', title:'创建时间'}
        ,{fixed: 'right', title:'操作', toolbar: '#barDemo', width: 200}
        ]]
        ,defaultToolbar:[]
        ,page: true
    });

    //头工具栏事件
    table.on('toolbar(test)', function(obj){
        switch(obj.event){
            case 'add':
                location.href="/role/add";
            break;
        };
    });

    //监听行工具事件
    table.on('tool(test)', function(obj){
        var data = obj.data;
        switch(obj.event){
            case 'edit_name':
                layer.prompt({
                    formType: 2
                    ,value: data.name
                }, function(value, index){
                    layer.close(index);
                    let datajson = {key:'name', value:value};
                    $.post('/role/set/' + data.id ,datajson,function(data){
                        if(data.code != 0) {
                            layer.msg(data.msg);
                        } else {
                            obj.update({
                              name: value
                            });
                        }
                    });
                });
            break;
            case 'edit_detail':
                layer.prompt({
                    formType: 2
                    ,value: data.detail
                }, function(value, index){
                    layer.close(index);
                    let datajson = {key:'detail', value:value};
                    $.post('/role/set/' + data.id ,datajson,function(data){
                        if(data.code != 0) {
                            layer.msg(data.msg);
                        } else {
                            obj.update({
                              detail: value
                            });
                        }
                    });
                });
            break;
            case 'del':
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
            break;
            case 'edit':
                location.href = '/role/edit/' + data.id;
            break;
            case 'editRule':
                layer.open({
                    type: 2,
                    maxmin: true, // 显示最大最小化按钮
                    area: ['500px', '450px'],
                    title: '变更权限',
                    content: '/role/edit_rule/' + data.id,
                });
            break;
        }
    });
});
</script>
@endsection
