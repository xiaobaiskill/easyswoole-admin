<?php
namespace App\HttpController\Web;

use App\Base\BaseController;
use EasySwoole\VerifyCode\Conf;

use easySwoole\Cache\Cache;

use EasySwoole\EasySwoole\Config;
class VerifyCode extends BaseController
{
    function index()
    {
        $config = new Conf(['backColor'=>[243,243,243]]);
        $code = new \EasySwoole\VerifyCode\VerifyCode($config);
        $this->response()->withHeader('Content-Type','image/png');
        $drawcode = $code->DrawCode();
        $this->response()->write($drawcode->getImageByte());
        $verify = strtoupper($drawcode->getImageCode());

        $encry = Config::getInstance()->getConf('web.verify_encry');
        $this->response()->setCookie('v-idea',md5($encry . $verify . $encry));
    }
}