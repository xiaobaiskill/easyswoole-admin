基于 easyswoole 二次开发
====

#### 一、后台
[http://39.105.61.1:8081/](http://39.105.61.1:8081/)
```
// 后台帐号密码 admin 123123

往各位高抬贵手,不要改动admin的账号的密码和权限.
做人留一线 日后好相见
```


#### 二、后台展示
* 1.1 主页
![主页](show/主页.png)

* 1.2 管理员列表页面
![管理员列表](show/管理员列表.png)

* 1.3 添加管理员
![添加管理员](show/添加管理员.png)

* 1.4 角色管理页面
![角色管理](show/角色管理.png)

* 1.5 添加用户组
![添加用户组](show/添加用户组.png)

* 1.6 变更权限
![变更权限](show/变更权限.png)

* 1.7 权限管理
![权限管理](show/权限管理.png)

* 1.8 添加权限
![添加权限](show/添加权限.png)


#### 三、目录介绍
```
App
  |- Base                     // 基础类文件
      |- AdminController.php    // 后台admin 基础controller 类  继承了BaseCcontroller
      |- BaseController.php     // 最基础的 controller 类
      |- BaseModel.php          // 最基础的model 类
  |- Config                   // 关于App 项目的配置
  |- Common                   // 公共函数
  |- HttpController           // 控制器类文件夹
      |- Router.php             // 路由文件
      |- Admin                   // 后台管理模块
          |- Auth                // 管理者模块
          |- Setting             // 设置模块 
          |- Index.php           // 菜单 和 主页 
          |- Login.php           // 登录
  |- Model
      |-AdminAuth.php                // auth model 类 继承了BaseModel
  |- Process                  // 和进程有关的文件都存于此处
      |- HotReload.php          // 热更新 程序
  |- Static                   // 静态资源文件
  |- Utility                  // 公共组件
      |- Log                    // 日志组件
      |- Message                // 消息 组件
      |- RoleGroup              // 用户组 组件
      |- Pool                   // 进程 组件 （mysql池，redis池）
      |- Template               // 模板类文件夹
  |- Views                    // 模板
```

#### 四、功能
```
1、登录
2、token 认证
3、验证码 验证
4、管理员管理
5、用户组管理
6、权限管理
```


#### 五、环境
* 5.1 使用docker 搭建。   启动完成后设置一下nginx 反向代理和静态资源 请看5.3
```
docker-compose up -d
// 使用docker 搭建
```

* 5.2 不使用docker 搭建   启动完成后 设置一下 nginx 反向代理和静态资源。请看5.3
```
php >= 7.1 
swoole-4.3 
[composer 下载安装](https://www.cnblogs.com/xiaobaiskill/p/11003514.html)

// 换composer 的源
composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/

// 下载组件
composer install
// 无法下载 可忽略版本 composer install --ignore-platform-reqs


cp vendor/easyswoole/easyswoole/bin/easyswoole easyswoole

启动mysql  执行 sql.sql

mv App/Config/Database.php.bak  App/Config/Database.php
修改data配置

php easyswoole start product
// 启动 product 是生产环境 dev 是开发环境,默认模式是开发环境
```

* 5.3 nginx 配置
```
location / {
      rewrite ^/(.*)$ /admin/$1 break;
      proxy_pass  http://127.0.0.1:9503;  # 反向代理至http://127.0.0.1:9503
      proxy_redirect     off;
      proxy_set_header   Host             $host;
      proxy_set_header   X-Real-IP        $remote_addr;
      proxy_set_header   X-Forwarded-For  $proxy_add_x_forwarded_for;
  }
location ~ .*\.(gif|jpg|jpeg|png|bmp|swf|woff2|woff|ttf|ico)$     # 这个要全
{
    root /path/to/App/Static;  # 写这个项目静态文件夹的绝对地址
    expires      30d;
}
location ~ .*\.(js|css|map)?$
{
    root /path/to/App/Static; # 写这个项目静态文件夹的绝对地址
    expires      12h;
}

```

* 5.4 db 配置文件讲解
```
在App/Config 目录下添加文件 Database.php

<?php
return [
    'MYSQL' => [
        //数据库配置
       'host'                 => '127.0.0.1',//数据库连接ip
       'user'                 => 'vagrant',//数据库用户名
       'password'             => 'vagrant',//数据库密码
       'database'             => 'test',//数据库
       'port'                 => '3306',//端口
       'timeout'              => '30',//超时时间
       'connect_timeout'      => '5',//连接超时时间
       'charset'              => 'utf8',//字符编码
       'strict_type'          => false, //开启严格模式，返回的字段将自动转为数字类型
       'fetch_mode'           => false,//开启fetch模式, 可与pdo一样使用fetch/fetchAll逐行或获取全部结果集(4.0版本以上)
       'alias'                => '',//子查询别名
       'isSubQuery'           => false,//是否为子查询
       'max_reconnect_times ' => '3',//最大重连次数
    ],
];

?>
```

#### 六、账号
```
// 后台帐号密码 admin 123123
```



#### 七、规范

* 类名
`大驼峰 （如： IndexController  BaseModel）`

* 方法/函数
`小驼峰 （如 getAll getOne）`

* 变量
`下划线 (如： $pwd_hash $user_info)`

#### 八、其他
```
[cache](https://packagist.org/packages/easyswoole/cache)

```