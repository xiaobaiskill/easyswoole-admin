<?php
/*// 教程 https://packagist.org/packages/easyswoole/cache
return [
	'type' => 'Files',
	'conf' => [
        'expire'        => 0,     // 缓存过期时间
        'cache_subdir'  => true,  // 开启子目录存放
        'prefix'        => 'cache',    // 缓存文件后缀名
        'path'          => './Temp/Cache',    // 缓存文件储存路径
        'hash_type'     => 'md5', // 文件名的哈希方式
        'data_compress' => false, // 启用缓存内容压缩
        'thread_safe'   => false, // 线程安全模式
        'lock_timeout'  => 3000,  // 文件最长锁定时间(ms)
	]
];*/


/*
return [
	'type' => 'Redis',
	'conf' => [
		'host'       => '127.0.0.1',  // Redis服务器
        'port'       => 6379,         // Redis端口
        'password'   => '',           // Redis密码
        'select'     => 0,            // Redis库序号
        'timeout'    => 0,            // 连接超时
        'expire'     => 0,            // 默认缓存超时
        'persistent' => false,        // 是否使用长连接
        'prefix'     => 'cache:',     // 缓存前缀
	]
];
 */

/*
return [
	'type' => 'Memcached',
	'conf' => [
		'host'     => '127.0.0.1',  // Memcache服务器
        'port'     => 11211,        // Memcache端口
        'expire'   => 0,            // 默认缓存过期时间
        'timeout'  => 0,            // 超时时间（单位：毫秒）
        'prefix'   => '',           // 缓存后缀
        'username' => '',           // Memcache账号
        'password' => '',           // Memcache密码
        'option'   => [],           // Memcache连接配置
	]
];
 */


/*
如果可以，个人建议redis 或 memcache
[http://www.easyswoole.com/cn/Components/redisPool.html]
 */