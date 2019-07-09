<?php
return [
    'verify'       => 'j#m@z.a',     // 密码加密使用
    'verify_encry' => 'jmzishaoren', // 验证码加密使用
    'token'        => '#jdAJDi(DS()@#D213S*dsa%!@',   // token使用
	'cache' => [
        'driver'        => 'files', // 驱动名称   不同的驱动 下方的参数可以变更。
        'expire'        => 0,       // 缓存过期时间
        'cache_subdir'  => true,    // 开启子目录存放
        'prefix'        => 'cache',      // 缓存文件后缀名
        'path'          => './Temp/Cache',      // 缓存文件储存路径
        'hash_type'     => 'md5',   // 文件名的哈希方式
        'data_compress' => false,   // 启用缓存内容压缩
        'thread_safe'   => false,   // 线程安全模式
        'lock_timeout'  => 3000,    // 文件最长锁定时间(ms)
    ],
];
