@extends('layouts.admin')

@section('body')
<div>
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md8">
			<table class="layui-hide" id="login_log" lay-filter="login_log"></table>
		</div>



		<div class="layui-col-md4">

		</div>
	</div>
</div>
@endsection

@section('javascriptFooter')
<script>
layui.use('table', function(){
	var table = layui.table, form = layui.form;

	table.render({
		elem: '#test'
		,url:'/auth/get_all'
		,method:'post'
		,toolbar: '#toolbarDemo'
		,page: true
		,title: '用户数据表'
		,cols: [[
			{field:'id', title:'ID', width:80, fixed: 'left', unresize: true, sort: true}
			,{field:'uname', title:'登录名'}
			,{field:'status', title:'是否登录成功', }
			,{field:'created_at', title:'最近登录时间'}
		]]
		,defaultToolbar:[]
	});
});
</script>
@endsection