@extends('admin.auth.ruleBase')

@section('javascriptFooter')
<script>

layui.use('form', function(){
	var form = layui.form;

	form.val("form", {
		"name": "{{ $info['name'] }}"
		,"node": "{{ $info['node'] }}"
		,"status": {{ $info['status'] }}
	});


	//监听提交
	form.on('submit(submit)', function(data){
		data.field.status = data.field.status ? 1 : 0;
		$.post('/rule/edit/'+{{ $info['id'] }},data.field,function(info){
		    if(info.code != 0) {
				layer.msg(info.msg);
			} else {
				layer.msg('编辑成功');
				location.href = '/rule';
			}
		});
		return false;
	});
});
</script>
@endsection