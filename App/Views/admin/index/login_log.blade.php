<div class="layui-card">
	<div class="layui-card-header">登录记录</div>
	<div class="layui-card-body">
		<table class="layui-hide" id="login_log" lay-filter="login_log"></table>
		<script type="text/html" id="statusTpl">
			@{{#  if(d.status === 1){ }}
				<span style="color: #F581B1;">登录成功</span>
			@{{#  } else { }}
				登录失败
			@{{#  } }}
		</script>
	</div>
</div>

<script type="text/javascript">
layui.use('table', function(){
	var table = layui.table, form = layui.form;

	table.render({
		elem: '#login_log'
		,url:'/login_log'
		,method:'post'
		,page: true
		,title: '用户数据表'
		,cols: [[
			{field:'id', title:'ID', width:80, fixed: 'left', unresize: true, sort: true}
			,{field:'uname', title:'登录名'}
			,{field:'status', title:'是否登录成功', templet: '#statusTpl'}
			,{field:'created_at', title:'登录时间'}
		]]
		,defaultToolbar:[]
	});
});
</script>