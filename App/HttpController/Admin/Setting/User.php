<?php

namespace App\HttpController\Admin\Setting;

use App\Base\AdminController;

class User extends AdminController
{
    public function index()
    {
        $this->render('admin.setting.user.index');
    }
}
