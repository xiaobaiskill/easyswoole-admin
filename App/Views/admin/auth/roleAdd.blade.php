@extends('admin.auth.roleBase')

@section('body-title','添加用户组')

@section('javascriptFooter')
<script>
layui.use('form', function(){
  var form = layui.form;

  //监听提交
  form.on('submit(submit)', function(data){
    $.post('/role/add',data.field,function(info){
        if(info.code != 0) {
            layer.msg(info.msg);
        } else {
            layer.msg('添加成功',{time:1000},function(){
                location.href = '/role';
            });

        }
    });
    return false;
  });
});
</script>
@endsection
