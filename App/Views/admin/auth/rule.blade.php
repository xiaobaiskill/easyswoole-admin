@extends('layouts.admin')

@section('body')
<div class="white p20">
    <table class="layui-hide" id="test" lay-filter="test"></table>

    <!-- 表头 -->
    <script type="text/html" id="toolbarDemo">
        @if($role_group->hasRule('auth.role.add'))
            <div class="layui-btn-container">
                <button class="layui-btn layui-btn-normal layui-btn-sm" lay-event="add">添加最高权限</button>
            </div>
        @endif
    </script>

    <!-- 状态 -->
    <script type="text/html" id="switchStatus">
        <input type="checkbox" name="status" value="@{{d.id}}" lay-skin="switch" @if(!$role_group->hasRule('auth.role.set')) disabled="off" @endif lay-text="启动|禁用" lay-filter="status" @{{ d.status == 1 ? 'checked' : '' }}>
    </script>


    <!-- 操作 -->
    <script type="text/html" id="barDemo">
        @if($role_group->hasRule('auth.rule.add'))
            <a class="layui-btn layui-btn-xs layui-btn-normal" lay-event="add_rule">添加</a>
        @endif

        @if($role_group->hasRule('auth.rule.set'))
            <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
        @endif

        @if($role_group->hasRule('auth.rule.del'))
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
        @endif
    </script>
</div>
@endsection


@section('javascriptFooter')
<script>
    layui.use('table', function(){
    var table = layui.table, form = layui.form;

    table.render({
        elem: '#test'
        ,url:'/rule/get_all'
        ,method:'post'
        ,toolbar: '#toolbarDemo'
        ,title: '权限'
        ,cols: [[
        {field:'id', title:'ID', width:80, fixed: 'left'}
        ,{field:'name', title:'用户名', width:220}
        ,{field:'node', title:'节点标记', width:220 @if($role_group->hasRule('auth.rule.set')), event:'edit_node' @endif}
        ,{field:'created_at', title:'创建时间'}
        ,{field:'status', title:'是否启用', templet: '#switchStatus', width:100}
        ,{fixed: 'right', title:'操作', toolbar: '#barDemo', width: 180}
        ]]
        ,defaultToolbar:[]
        // ,page: true
    });

    //头工具栏事件
    table.on('toolbar(test)', function(obj){
        var checkStatus = table.checkStatus(obj.config.id);
        switch(obj.event){
            case 'add':
                location.href = "/rule/add";
            break;
        };
    });


    form.on('switch(status)', function(obj){
        let datajson = {key:'status', value:obj.elem.checked ? '1':'0'};

        $.post('/rule/set/' + this.value ,datajson,function(data){
            if(data.code != 0) {
                layer.msg(data.msg);
                obj.elem.checked = !obj.elem.checked;
                form.render();
            }
        });
    });


    //监听行工具事件
    table.on('tool(test)', function(obj){
        var data = obj.data;
        switch(obj.event){
            case 'add_rule':
                location.href = '/rule/add/' + data.id;
            break;
            case 'del':
                layer.confirm('真的删除行么', function(index){
                    $.post('/rule/del/' + data.id ,'',function(data){
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
                location.href = '/rule/edit/' + data.id;
            break;
            case 'edit_node':
                layer.prompt({
                    formType: 2
                    ,value: data.node
                }, function(value, index){
                    layer.close(index);
                    let datajson = {key:'node', value:value};
                    $.post('/rule/set/' + data.id ,datajson,function(data){
                        if(data.code != 0) {
                            layer.msg(data.msg);
                        } else {
                            obj.update({
                              node: value
                            });
                        }
                    });
                });
            break;
        }
    });
});
</script>
@endsection
