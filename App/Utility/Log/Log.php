<?php

namespace App\Utility\Log;

use EasySwoole\Log\LoggerInterface;
use EasySwoole\EasySwoole\Config;

class Log implements LoggerInterface
{
	use \EasySwoole\Component\Singleton;
	private $logDir;
	private function __construct(string $logDir = null)
	{
		if(empty($logDir)){
            $logDir = Config::getInstance()->getConf("LOG_DIR");
        }
        $this->logDir = $logDir;
	}

	public function info(?string $msg,string $category = 'DEBUG')
    {
        $this->send($msg,self::LOG_LEVEL_INFO,$category);
    }

    public function notice(?string $msg,string $category = 'DEBUG')
    {
        $this->send($msg,self::LOG_LEVEL_NOTICE,$category);
    }

    public function waring(?string $msg,string $category = 'DEBUG')
    {
        $this->send($msg,self::LOG_LEVEL_WARNING,$category);
    }

    public function error(?string $msg,string $category = 'DEBUG')
    {
        $this->send($msg,self::LOG_LEVEL_ERROR,$category);
    }

	public function log(?string $msg,int $logLevel = self::LOG_LEVEL_INFO,string $category = 'DEBUG'):string
	{
		$date = date('Y-m-d H:i:s');
		$levelStr = $this->levelMap($logLevel);
		$filePath = $this->logDir."/" . date('Y-m-d') . "log.log";
		$str = "[{$date}][{$category}][{$levelStr}] : [{$msg}]\n";
        file_put_contents($filePath,"{$str}",FILE_APPEND|LOCK_EX);
        return $str;
	}

    public function console(?string $msg,int $logLevel = self::LOG_LEVEL_INFO,string $category = 'DEBUG')
    {
		$date = date('Y-m-d H:i:s');
		$levelStr = $this->levelMap($logLevel);
		$temp =  $this->colorString("[{$date}][{$category}][{$levelStr}] : [{$msg}]",$logLevel)."\n";
        fwrite(STDOUT,$temp);
    }

    private function send(?string $msg,int $logLevel = self::LOG_LEVEL_INFO,string $category = 'DEBUG')
    {
    	if(Config::getInstance()->getConf('DEBUG')) {
    		$this->console($msg, $logLevel, $category);
    	} else {
    		$this->log($msg, $logLevel, $category);
    	}
    }


    private function colorString(string $str,int $logLevel)
    {
        switch($logLevel) {
            case self::LOG_LEVEL_INFO:
                $out = "[42m";
                break;
            case self::LOG_LEVEL_NOTICE:
                $out = "[43m";
                break;
            case self::LOG_LEVEL_WARNING:
                $out = "[45m";
                break;
            case self::LOG_LEVEL_ERROR:
                $out = "[41m";
                break;
            default:
                $out = "[42m";
                break;
        }
        return chr(27) . "$out" . "{$str}" . chr(27) . "[0m";
    }

    private function levelMap(int $level)
    {
        switch ($level)
        {
            case self::LOG_LEVEL_INFO:
               return 'INFO';
            case self::LOG_LEVEL_NOTICE:
                return 'NOTICE';
            case self::LOG_LEVEL_WARNING:
                return 'WARNING';
            case self::LOG_LEVEL_ERROR:
                return 'ERROR';
            default:
                return 'UNKNOWN';
        }
    }
}