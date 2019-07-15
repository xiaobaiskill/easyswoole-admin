<?php

namespace App\HttpController\Admin;

use App\Base\AdminController;
use App\Model\AdminLoginLog as LoginLog;

class Index extends AdminController
{
    public function index()
    {
        $this->render('admin.index',['uname' => $this->auth['uname']]);
    }

    public function indexContext()
    {
        $this->render('admin.indexContext');
    }

    public function loginLog()
    {
 		$data = $this->getPage();

        $role_data = LoginLog::getInstance()
            ->findAll($data['page'], $data['limit']);

        $role_count = LoginLog::getInstance()->count();
        $data       = ['code' => Status::CODE_OK, 'count' => $role_count, 'data' => $role_data];
        $this->dataJson($data);
        return;
    }
}
