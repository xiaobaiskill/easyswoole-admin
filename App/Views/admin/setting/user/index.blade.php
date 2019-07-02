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
      ,{field:'username', title:'用户名', width:120, edit: 'text'}
      ,{field:'email', title:'邮箱', width:150, edit: 'text', templet: function(res){
        return '<em>'+ res.email +'</em>'
      }}
      ,{field:'sex', title:'性别', width:80, edit: 'text', sort: true}
      ,{field:'city', title:'城市', width:100}
      ,{field:'sign', title:'签名'}
      ,{field:'experience', title:'积分', width:80, sort: true}
      ,{field:'ip', title:'IP', width:120}
      ,{field:'logins', title:'登入次数', width:100, sort: true}
      ,{field:'joinTime', title:'加入时间', width:120}
      ,{fixed: 'right', title:'操作', toolbar: '#barDemo', width:150}
    ]]
  ,code: 0
  ,msg: ""
  ,count: 3000000
  ,data: [{
    "id": "10001"
    ,"username": "杜甫"
    ,"email": "xianxin@layui.com"
    ,"sex": "男"
    ,"city": "浙江杭州"
    ,"sign": "点击此处，显示更多。当内容超出时，点击单元格会自动显示更多内容。"
    ,"experience": "116"
    ,"ip": "192.168.0.8"
    ,"logins": "108"
    ,"joinTime": "2016-10-14"
  }, {
    "id": "10002"
    ,"username": "李白"
    ,"email": "xianxin@layui.com"
    ,"sex": "男"
    ,"city": "浙江杭州"
    ,"sign": "君不见，黄河之水天上来，奔流到海不复回。 君不见，高堂明镜悲白发，朝如青丝暮成雪。 人生得意须尽欢，莫使金樽空对月。 天生我材必有用，千金散尽还复来。 烹羊宰牛且为乐，会须一饮三百杯。 岑夫子，丹丘生，将进酒，杯莫停。 与君歌一曲，请君为我倾耳听。(倾耳听 一作：侧耳听) 钟鼓馔玉不足贵，但愿长醉不复醒。(不足贵 一作：何足贵；不复醒 一作：不愿醒/不用醒) 古来圣贤皆寂寞，惟有饮者留其名。(古来 一作：自古；惟 通：唯) 陈王昔时宴平乐，斗酒十千恣欢谑。 主人何为言少钱，径须沽取对君酌。 五花马，千金裘，呼儿将出换美酒，与尔同销万古愁。"
    ,"experience": "12"
    ,"ip": "192.168.0.8"
    ,"logins": "106"
    ,"joinTime": "2016-10-14"
    ,"LAY_CHECKED": true
  }, {
    "id": "10003"
    ,"username": "王勃"
    ,"email": "xianxin@layui.com"
    ,"sex": "男"
    ,"city": "浙江杭州"
    ,"sign": "人生恰似一场修行"
    ,"experience": "65"
    ,"ip": "192.168.0.8"
    ,"logins": "106"
    ,"joinTime": "2016-10-14"
  }, {
    "id": "10004"
    ,"username": "李清照"
    ,"email": "xianxin@layui.com"
    ,"sex": "女"
    ,"city": "浙江杭州"
    ,"sign": "人生恰似一场修行"
    ,"experience": "666"
    ,"ip": "192.168.0.8"
    ,"logins": "106"
    ,"joinTime": "2016-10-14"
  }, {
    "id": "10005"
    ,"username": "冰心"
    ,"email": "xianxin@layui.com"
    ,"sex": "女"
    ,"city": "浙江杭州"
    ,"sign": "人生恰似一场修行"
    ,"experience": "86"
    ,"ip": "192.168.0.8"
    ,"logins": "106"
    ,"joinTime": "2016-10-14"
  }, {
    "id": "10006"
    ,"username": "贤心"
    ,"email": "xianxin@layui.com"
    ,"sex": "男"
    ,"city": "浙江杭州"
    ,"sign": "人生恰似一场修行"
    ,"experience": "12"
    ,"ip": "192.168.0.8"
    ,"logins": "106"
    ,"joinTime": "2016-10-14"
  }, {
    "id": "10007"
    ,"username": "贤心"
    ,"email": "xianxin@layui.com"
    ,"sex": "男"
    ,"city": "浙江杭州"
    ,"sign": "人生恰似一场修行"
    ,"experience": "16"
    ,"ip": "192.168.0.8"
    ,"logins": "106"
    ,"joinTime": "2016-10-14"
  }, {
    "id": "10008"
    ,"username": "贤心"
    ,"email": "xianxin@layui.com"
    ,"sex": "男"
    ,"city": "浙江杭州"
    ,"sign": "人生恰似一场修行"
    ,"experience": "106"
    ,"ip": "192.168.0.8"
    ,"logins": "106"
    ,"joinTime": "2016-10-14"
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