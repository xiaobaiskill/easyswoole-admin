@extends('admin.auth.userBase')

@section('body-title','添加用户')

@section('javascriptFooter')
<script>
layui.use('form', function(){
	var form = layui.form;

	form.verify({
		title: function(value){
			if(value.length < 5){
				return '标题至少得5个字符啊';
			}
		}
		,pass: [
			/^[\S]{6,12}$/
			,'密码必须6到12位，且不能出现空格'
		]
		,content: function(value){
		 	layedit.sync(editIndex);
		}
	});

	//监听提交
	form.on('submit(submit)', function(data){
		$.post('/user/add', data.field, function(info){
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
