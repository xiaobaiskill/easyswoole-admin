<?php

namespace App\HttpController\Admin;

use App\Base\AdminController;
use App\Utility\Message\Status;

use App\Utility\Log\Log;

class Index extends AdminController
{
	public function index()
	{
		$this->render('admin.index');
	}

	public function indexContext()
	{
		$this->render('admin.indexContext');
	}
}