@extends('admin.auth.userBase')

@section('body-title')
    <div class="layui-card-header">添加用户</div>
@endsection
@section('javascriptFooter')
<script>
layui.use('form', function(){
	var form = layui.form, $ = layui.jquery,form_field;


	function callback(data)
	{
		if(data.code != 0) {
	        layer.msg(data.msg);
	    } else {
	        layer.msg('添加成功',{time:1000},function(){
	            location.href = '/auth';
	        });

	    }
	}
	form.verify({
		pwd: [
			/^[\S]{6,12}$/
			,'密码必须6到15位，且不能出现空格'
		],
		verify_pwd:function(value, item){
			var pwd = $("input[name='pwd']").val();
			if(pwd !== value) {
				return '两次输入的密码不一致';
			}
		}
	});

	//监听提交
	form.on('submit(submit)', function(data){
		form_field = data;
		delete data.field.verify_pwd;
		data.field.status = data.field.status ? 1 : 0;
		post('/auth/add',data.field,callback);
		return false;
	});
});
</script>
@endsection
