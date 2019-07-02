<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="">
    @yield('stylesheet')
    @yield('javascriptHeader')
	<style type="text/css">
    	* {
    		margin: 0px;
			padding: 0px;
			list-style: none;
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