<?php

namespace App\Model;

use App\Base\BaseModel;

// 登录日志记录
class AdminLoginLog extends BaseModel
{
    protected $table = "admin_login_log";

    public function add($uname, $status = 0)
    {
        return $this->insert(['uname' => $uname, 'status' => $status]);
    }
}
