<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> easyswoole-admin</title>
    <link href="/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css?v=4.1.0" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                    <span class="block m-t-xs" style="font-size:20px;">
                                        <i class="fa fa-area-chart"></i>
                                        <strong class="font-bold">后台管理</strong>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="logo-element"><i class="fa fa-area-chart"></i>
                        </div>
                    </li>
                    <li>
                        <a class="J_menuItem" href="/index_context">
                            <i class="fa fa-home"></i>
                            <span class="nav-label">主页</span>
                        </a>
                    </li>
                    <li class="line dk"></li>
					<!-- 用户管理 -->
                    @if($role_group->hasRule('auth'))
                    <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                        <span class="ng-scope">管理用户</span>
                    </li>
                        @if($role_group->hasRule('auth.auth'))
                            <li>
                                <a href="#"><i class="fa fa-user"></i> <span class="nav-label">后台管理员</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    @if($role_group->hasRule('auth.auth.view'))
                                        <li><a class="J_menuItem" href="/auth">管理员列表</a>
                                        </li>
                                    @endif
                                    @if($role_group->hasRule('auth.auth.add'))
                                        <li><a class="J_menuItem" href="/auth/add">添加管理员</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if($role_group->hasRule('auth.role'))
                            <li>
                                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">角色管理</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    @if($role_group->hasRule('auth.role.view'))
                                        <li><a class="J_menuItem"  href="/role">角色列表</a>
                                        </li>
                                    @endif
                                    @if($role_group->hasRule('auth.role.add'))
                                        <li><a class="J_menuItem" href="/role/add">添加角色</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if($role_group->hasRule('auth.rule'))
                            <li>
                                <a href="#"><i class="fa fa-key fa-fw"></i> <span class="nav-label">权限管理</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    @if($role_group->hasRule('auth.rule.view'))
                                        <li><a class="J_menuItem" href="/rule">权限列表</a>
                                        </li>
                                    @endif
                                    @if($role_group->hasRule('auth.rule.add'))
                                        <li><a class="J_menuItem" href="/rule/add">添加权限</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        <li class="line dk"></li>
                    @endif

					<!-- 设置 -->
                    <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                        <span class="ng-scope">设置</span>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-cog fa-fw"></i> <span class="nav-label">系统设置</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="basic_gallery.html">网站设置</a>
                            </li>
                            <li><a class="J_menuItem" href="basic_gallery.html">地区管理</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2" href="#" title="侧边伸缩"><i class="fa fa-dedent"></i> </a>

                        <a class="minimalize-styl-2" href="http://www.xiaobaiskill.cn" title="前台">
                        <img src="/img/web.png" alt=""> </a>

                        <a class="refresh minimalize-styl-2" href="#"  title="刷新"><i class="fa fa-refresh"></i> </a>

                        <!-- <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search" id="top-search">
                            </div>
                        </form> -->
                    </div>

                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                {{$uname}}<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li class="m-t-xs text-center">
                                    <a class="J_menuItem" href="/auth/info">
                                        <div class="dropdown-messages-box">
                                            基本资料
                                        </div>
                                    </a>
                                </li>
                                <li class="text-center">
                                    <a class="J_menuItem" href="/auth/pwd">
                                        <div class="dropdown-messages-box">
                                                修改密码
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a href="/logout">
                                            <strong> 退出</strong>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row J_mainContent" id="content-main" style="padding: 10px">
                <iframe id="J_iframe" width="100%" height="100%" src="index_context" frameborder="0" data-id="index_context" seamless></iframe>
            </div>
        </div>
        <!--右侧部分结束-->
    </div>

    <!-- 全局js -->
    <script src="/js/jquery.min.js?v=2.1.4"></script>
    <script src="/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/layer/layer.min.js"></script>

    <!-- 自定义js -->
    <script src="/js/hAdmin.js?v=4.1.0"></script>
    <script type="text/javascript" src="/js/index.js"></script>

</body>

</html>
