<?php

namespace App\HttpController\Admin\Setting;

use App\Base\AdminController;
use App\Utility\Message\Status;

use App\Utility\Log\Log;

class User extends AdminController
{
	public function index()
	{
		$this->render('admin.setting.user.index');
	}
}
