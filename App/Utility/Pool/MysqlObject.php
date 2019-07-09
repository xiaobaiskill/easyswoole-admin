<?php
namespace App\Utility\Pool;

use EasySwoole\Component\Pool\PoolObjectInterface;
use EasySwoole\Mysqli\Mysqli;

class MysqlObject extends Mysqli implements PoolObjectInterface
{
    public function gc()
    {
        $this->resetDbStatus();
        $this->getMysqlClient()->close();
    }

    public function objectRestore()
    {
        $this->resetDbStatus();
    }

    public function beforeUse(): bool
    {
        return $this->getMysqlClient()->connected;
    }
}
