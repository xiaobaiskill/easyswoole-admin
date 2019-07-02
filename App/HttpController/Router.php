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

            // 用户管理
            $route->addGroup('/auth',function(RouteCollector $r){
                $r->get('/edit_rule','/Admin/Auth/Rules/editRule');
                $r->get('/role_rule','/Admin/Auth/Role/editRule');
                $r->get('/rules','/Admin/Auth/Rules');
                $r->get('/role','/Admin/Auth/Role');
                $r->get('','/Admin/Auth/User');
            });

            // $route->addRoute(['GET'], '/', '/Admin/Index');
            // $route->addRoute(['GET'], '/index_context', '/Admin/Index/indexContext');



        });
    }
}
