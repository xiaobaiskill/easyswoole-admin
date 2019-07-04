<?php
namespace App\HttpController;

use EasySwoole\Http\AbstractInterface\AbstractRouter;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use FastRoute\RouteCollector;
use EasySwoole\template\Render;

class Router extends AbstractRouter
{
    public function initialize(RouteCollector $routes)
    {
        // 未找到路由对应的方法
        $this->setMethodNotAllowCallBack(function (Request $request, Response $response) {
            $response->write(Render::getInstance()->render('default.404'));
            $response->withStatus(404);
        });

        // 未找到路由匹配
        $this->setRouterNotFoundCallBack(function (Request $request, Response $response) {
            $response->write(Render::getInstance()->render('default.404'));
            $response->withStatus(404);
        });


        $routes->addGroup('/admin', function (RouteCollector $route) {
            $route->get('/','/Admin/Index');
            $route->get('/index_context','/Admin/Index/indexContext');

            // 管理员
            $route->addGroup('/auth',function(RouteCollector $r){
                $r->get('','/Admin/Auth/User');
                $r->post('/get_all','/Admin/Auth/User/getAll');
                $r->post('/set/{id:\d+}','/Admin/Auth/User/set');
                $r->post('/del/{id:\d+}','/Admin/Auth/User/del');
            });

            // 角色
            $route->addGroup('/role',function(RouteCollector $r){
                $r->get('','/Admin/Auth/Role');
                $r->post('/get_all','/Admin/Auth/Role/getAll');
                $r->post('/del/{id:\d+}','/Admin/Auth/Role/del');
            });

            // 权限
            $route->addGroup('/rules',function(RouteCollector $r){
                $r->addRoute(['GET'], '', '/Admin/Auth/Rules');
                 $r->post('/get_all','/Admin/Auth/Rules/getAll');
            });
        });
    }
}
