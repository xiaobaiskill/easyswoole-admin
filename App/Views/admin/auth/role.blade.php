@extends('layouts.admin')

@section('stylesheet')
<link rel="stylesheet" href="/layui/css/layui.css"  media="all">
@endsection

@section('body')
<table class="layui-hide" id="test" lay-filter="test"></table>
<script type="text/html" id="toolbarDemo">
  <div class="layui-btn-container">
    <button class="layui-btn layui-btn-sm" lay-event="add">添加用户组</button>
    <button class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除用户组</button>
</div>
</script>

<script type="text/html" id="barDemo">
  <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="editRule">权限</a>
  <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
@endsection


@section('javascriptFooter')

<script src="/layui/layui.js" charset="utf-8"></script>
<script>
    layui.use('table', function(){
    var table = layui.table;

    table.render({
        elem: '#test'
        ,toolbar: '#toolbarDemo'
        ,title: '角色权限表'
        ,cols: [[
        {type: 'checkbox', fixed: 'left'}
        ,{field:'id', title:'ID', width:80, fixed: 'left', unresize: true, sort: true}
        ,{field:'name', title:'用户名', width:220, edit: 'text'}
        ,{field:'detail', title:'描述', edit: 'text', templet: function(res){
            return '<em>'+ res.detail +'</em>'
        }}
        ,{fixed: 'right', title:'操作', toolbar: '#barDemo', width: 180}
        ]]
        ,defaultToolbar:[]
        ,code: 0
        ,msg: ""
        ,count: 3000000
        ,data: [{
            "id": "10001"
            ,"name": "杜甫"
            ,"detail": "xianxin@layui.com"
        }, {
            "id": "10001"
            ,"name": "杜甫"
            ,"detail": "xianxin@layui.com"
        },{
            "id": "10001"
            ,"name": "杜甫"
            ,"detail": "xianxin@layui.com"
        },{
            "id": "10001"
            ,"name": "杜甫"
            ,"detail": "xianxin@layui.com"
        },{
            "id": "10001"
            ,"name": "杜甫"
            ,"detail": "xianxin@layui.com"
        },{
            "id": "10001"
            ,"name": "杜甫"
            ,"detail": "xianxin@layui.com"
        },]
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
              content: '/admin/auth/role_rule',

            });
        }
    });
});
</script>
@endsection
