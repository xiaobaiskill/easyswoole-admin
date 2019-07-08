@extends('admin.auth.roleBase')

@section('body-title','编辑用户组')

@section('javascriptFooter')
<script>
function callback(data){
    if(data.code != 0) {
        layer.msg(info.msg);
    } else {
        layer.msg('编辑成功',{time:1000},function(){
            location.href = '/role';
        });

    }
}
layui.use('form', function(){
  var form = layui.form;

    form.val("form", {
      "name": "{{ $info['name'] }}"
      ,"detail": "{{ $info['detail'] }}"
    });

  //监听提交
  form.on('submit(submit)', function(data){
    post('/role/edit/{{$id}}', data.field, callback);
    return false;
  });
});
</script>
@endsection
