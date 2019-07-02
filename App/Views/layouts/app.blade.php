<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    @yield('stylesheet')
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/jquery-3.4.1.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/layer/layer.js"></script>
	<style type="text/css">
    	* {
    		margin: 0px;
			padding: 0px;
			list-style: none;
    	}
    	body{
    		background-color: #f3f3f3;

    	}
    	.container{
    		background-color: #fff;
    	}
    </style>
</head>
<body>
	@yield('header')

	@section('body')
		这是主体内容
	@show

	@yield('footer')

    <script src="/js/global.js?v=20190627"></script>
	@yield('javascript')
</body>
</html>