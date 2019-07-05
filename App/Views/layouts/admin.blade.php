<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="">
    @yield('stylesheet')
    <link rel="stylesheet" href="/layui/css/layui.css"  media="all">
    <script src="/js/jquery.min.js" charset="utf-8"></script>
    <script src="/layui/layui.js" charset="utf-8"></script>
    <script src="/js/global.js" charset="utf-8"></script>

    @yield('javascriptHeader')
	<style type="text/css">
    	* {
    		margin: 0px;
			padding: 0px;
			list-style: none;
    	}

        .white {
            background-color: #fff;
        }

        .p20 {
            padding:20px;
        }
    </style>
</head>
<body>
	@yield('header')

	@yield('body')

	@yield('footer')

	@yield('javascriptFooter')
</body>
</html>