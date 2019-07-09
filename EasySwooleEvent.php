<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/5/28
 * Time: 下午6:33
 */

namespace EasySwoole\EasySwoole;


use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;

use EasySwoole\Utility\File;
use EasySwoole\EasySwoole\Config;

use App\Process\HotReload;

use App\Utility\Pool\MysqlPool;
use EasySwoole\Component\Pool\PoolManager;

use App\Utility\Template\Blade;
use EasySwoole\Template\Render;
use EasySwoole\EasySwoole\ServerManager;

use easySwoole\Cache\Cache;
class EasySwooleEvent implements Event
{

    public static function initialize()
    {
        // TODO: Implement initialize() method.
        date_default_timezone_set('Asia/Shanghai');

        // 加载配置项
        self::loadConf();
    }

    public static function loadConf()
    {
        $files = File::scanDirectory(EASYSWOOLE_ROOT . '/App/Config');
        if (is_array($files)) {
            foreach ($files['files'] as $file) {
                $fileNameArr = explode('.', $file);
                $fileSuffix = end($fileNameArr);
                if ($fileSuffix == 'php') {
                    Config::getInstance()->loadFile($file);
                } elseif ($fileSuffix == 'env') {
                    Config::getInstance()->loadEnv($file);
                }
            }
        }
    }

    public static function mainServerCreate(EventRegister $register)
    {
        // 热更新
        $hot_reload = (new HotReload('HotReload', ['disableInotify' => false]))->getProcess();
        ServerManager::getInstance()->getSwooleServer()->addProcess($hot_reload);

        // mysql
        PoolManager::getInstance()->register(MysqlPool::class);

        // template
        $viewDir = EASYSWOOLE_ROOT . '/App/Views';
        $cacheDir = EASYSWOOLE_ROOT . '/Temp/Template';
        Render::getInstance()->getConfig()->setRender(new Blade($viewDir,$cacheDir));
        Render::getInstance()->attachServer(ServerManager::getInstance()->getSwooleServer());

        // cache -- file redis memcache
        $conf = Config::getInstance()->getConf('app.cache');
        Cache::init($conf);

    }

    public static function onRequest(Request $request, Response $response): bool
    {
        // TODO: Implement onRequest() method.
        return true;
    }

    public static function afterRequest(Request $request, Response $response): void
    {
        // TODO: Implement afterAction() method.
    }
}