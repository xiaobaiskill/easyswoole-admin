<style>
	.layadmin-shortcut li {
	    text-align: center;
	}
</style>
<div class="layui-card">
	<div class="layui-card-header">快捷方式</div>
	<div class="layui-card-body">
		<ul class="layui-row layui-col-space10 layui-this layadmin-shortcut">
			@if($role_group->hasRule('auth.auth.view'))
			<li class="layui-col-xs2">
				<a onclick="parent.Jump('/auth')">
					<i class="layui-icon layui-icon-friends"></i>
					<cite>后台管理员</cite>
				</a>
			</li>
			@endif
			@if($role_group->hasRule('auth.role.view'))
			<li class="layui-col-xs2">
				<a lay-href="home/homepage2.html">
					<i class="layui-icon layui-icon-group"></i>
					<cite>角色管理</cite>
				</a>
			</li>
			@endif
			@if($role_group->hasRule('auth.rule.view'))
			<li class="layui-col-xs2">
				<a lay-href="home/homepage2.html">
					<i class="layui-icon layui-icon-vercode"></i>
					<cite>权限管理</cite>
				</a>
			</li>
			@endif

			<li class="layui-col-xs2">
				<a lay-href="home/homepage2.html">
					<i class="layui-icon layui-icon-chart"></i>
					<cite>其他</cite>
				</a>
			</li>
		</ul>
	</div>
</div>