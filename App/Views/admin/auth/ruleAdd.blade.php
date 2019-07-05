@extends('admin.auth.ruleBase')

@section('body-title','添加权限')

@section('javascriptFooter')
<script>
layui.use('form', function(){
  var form = layui.form;

  //监听提交
  form.on('submit(submit)', function(data){
  	data.field.menu = data.field.menu ? 1 : 0;
    data.field.status = data.field.status ? 1 : 0;
    $.post('/rule/add',data.field,function(info){
        if(info.code != 0) {
    		layer.msg(info.msg);
    	} else {
    		layer.msg('添加成功',{time:2000});
    		if(data.field.menu == 1) {
    			location.href = '/rule/add';
    		} else {
    			data.form.reset();
    		}
    	}
    });
    return false;
  });
});
</script>
@endsection