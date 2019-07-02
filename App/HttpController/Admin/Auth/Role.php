<?php

namespace App\HttpController\Admin\Auth;

use App\Base\AdminController;
class Role extends AdminController
{
	public function index()
	{
		$this->render('admin.auth.role');
	}

	public function editRule()
	{
		$this->render('admin.auth.edit_rule');
	}
}