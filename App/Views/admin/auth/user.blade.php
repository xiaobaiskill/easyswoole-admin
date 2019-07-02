@extends('layouts.admin')

@section('stylesheet')
<link rel="stylesheet" href="/layui/css/layui.css"  media="all">
@endsection

@section('body')

<table class="layui-hide" id="test" lay-filter="test"></table>

<script type="text/html" id="toolbarDemo">

  <div class="layui-btn-container">
    <button class="layui-btn layui-btn-sm" lay-event="getCheckData">获取选中行数据</button>
    <button class="layui-btn layui-btn-sm" lay-event="getCheckLength">获取选中数目</button>
    <button class="layui-btn layui-btn-sm" lay-event="isAll">验证是否全选</button>
    <button class="layui-btn layui-btn-sm" lay-event="add">添加用户</button>
  </div>
</script>

<script type="text/html" id="barDemo">
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
    // ,url:'https://www.layui.com/test/table/demo1.json'
    ,toolbar: '#toolbarDemo'
    ,title: '用户数据表'
    ,cols: [[
      {type: 'checkbox', fixed: 'left'}
      ,{field:'id', title:'ID', width:80, fixed: 'left', unresize: true, sort: true}
      ,{field:'username', title:'用户名', width:120}
      ,{field:'email', title:'邮箱', edit: 'text', templet: function(res){
        return '<em>'+ res.email +'</em>'
      }}
      ,{field:'created_at', title:'创建时间', }
      ,{field:'logined_at', title:'最近登录时间', sort: true}

      ,{fixed: 'right', title:'操作', toolbar: '#barDemo', width:150}
    ]]
    ,defaultToolbar:[]
  ,code: 0
  ,msg: ""
  ,count: 3000000
  ,data: [{
    "id": "10001"
    ,"username": "杜甫"
    ,"email": "xianxin@layui.com"

    ,"logined_at": "2016-10-14 14:12:21"
    ,"created_at": "2016-10-14"
  },{
    "id": "10001"
    ,"username": "杜甫"
    ,"email": "xianxin@layui.com"

    ,"logined_at": "2016-10-14 14:12:21"
    ,"created_at": "2016-10-14"
  },{
    "id": "10001"
    ,"username": "杜甫"
    ,"email": "xianxin@layui.com"

    ,"logined_at": "2016-10-14 14:12:21"
    ,"created_at": "2016-10-14"
  },{
    "id": "10001"
    ,"username": "杜甫"
    ,"email": "xianxin@layui.com"

    ,"logined_at": "2016-10-14 14:12:21"
    ,"created_at": "2016-10-14"
  },{
    "id": "10001"
    ,"username": "杜甫"
    ,"email": "xianxin@layui.com"

    ,"logined_at": "2016-10-14 14:12:21"
    ,"created_at": "2016-10-14"
  },{
    "id": "10001"
    ,"username": "杜甫"
    ,"email": "xianxin@layui.com"

    ,"logined_at": "2016-10-14 14:12:21"
    ,"created_at": "2016-10-14"
  }]
    ,page: true
  });

  //头工具栏事件
  table.on('toolbar(test)', function(obj){
    var checkStatus = table.checkStatus(obj.config.id);
    switch(obj.event){
      case 'getCheckData':
        var data = checkStatus.data;
        layer.alert(JSON.stringify(data));
      break;
      case 'getCheckLength':
        var data = checkStatus.data;
        layer.msg('选中了：'+ data.length + ' 个');
      break;
      case 'isAll':
        layer.msg(checkStatus.isAll ? '全选': '未全选');
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
      layer.prompt({
        formType: 2
        ,value: data.email
      }, function(value, index){
        obj.update({
          email: value
        });
        layer.close(index);
      });
    }
  });
});
</script>
@endsection