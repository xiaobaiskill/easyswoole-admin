@extends('layouts.admin')

@section('stylesheet')
<style type="text/css">
	li .layui-icon {
		display: inline-block;
	    width: 100%;
	    height: 60px;
	    line-height: 60px;
	    text-align: center;
	    border-radius: 2px;
	    font-size: 30px;
	    background-color: #F8F8F8;
	}
	li.layui-col-xs3{
		text-align: center;
	}
</style>
@endsection

@section('body')
<div>
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md8">
			@component('admin.index.quick',['role_group'=>$role_group])
			@endcomponent
			
			@if($role_group->hasRule('index.login.log'))
				<!-- 登录记录 -->
				@component('admin.index.login_log')
				@endcomponent
			@endif
		</div>
		<div class="layui-col-md4">
			<div class="layui-card">
				<div class="layui-card-header">版本信息</div>
				<div class="layui-card-body">
					<table class="layui-table">
					    <colgroup>
							<col width="150">
							<col>
					    </colgroup>
						<tr>
							<td>当前版本</td>
							<td><a href="#" onclick="parent.Jump('/version')">1.0</a></td>
						</tr>
						<tr>
							<td>项目框架</td>
							<td>easyswoole</td>
						</tr>
						<tr>
							<td>操作系统</td>
							<td>Linux</td>
						</tr>
						<tr>
							<td>服务器环境</td>
							<td>Nginx/1.14.0<br> PHP/7.1.30 <br> Mysql/5.6.40</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('javascriptFooter')
<script>
$('.Jump').click(function(){
	parent.Jump($(this).attr('src'));
});
</script>
@endsection