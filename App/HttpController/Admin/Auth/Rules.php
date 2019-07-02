<?php

namespace App\HttpController\Admin\Auth;

use App\Base\AdminController;
use App\Utility\Message\Status;

use App\Utility\Log\Log;

class Rules extends AdminController
{
	public function index()
	{
		$this->render('admin.auth.rules');
	}

	public function edit()
	{

	}
}