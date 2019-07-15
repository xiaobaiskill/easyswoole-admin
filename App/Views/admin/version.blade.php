@extends('layouts.admin')

@section('stylesheet')
	<style type="text/css">
		.version h1 {
			margin-bottom: 10px;
		}
		pre{
			border: 1px solid #ccc;
			padding: 10px;
			font-size: 12pt;
			letter-spacing:2px;
			line-height:22px;
		}
	</style>
@endsection

@section('javascriptHeader')

@endsection

@section('body')
<div class="version white p20">
<h1>系统版本更新日志</h1>

<pre>
  版本：v1.0

  [功能]：
  1. 登录
  2. 用户管理
  3. 用户组管理
  4. 权限管理

  [优化]：
  ...

  [修复]bug:
  ...
</pre>
</div>
@endsection
