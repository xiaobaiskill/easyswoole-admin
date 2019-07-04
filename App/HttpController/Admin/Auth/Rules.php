<?php

namespace App\HttpController\Admin\Auth;

use App\Base\AdminController;
use App\Utility\Message\Status;

use App\Utility\Log\Log;

use App\Model\AdminRule as RuleModel;

class Rules extends AdminController
{
	public function index()
	{
		$this->render('admin.auth.rules');
	}

	public function getAll()
	{
		$data = $this->getPage();

		$rule_data = RuleModel::getInstance()->getAll($data['page'], $data['limit']);

		$rule_count = RuleModel::getInstance()->where('deleted',0,'=')->count();
		$data = ['code'=>Status::CODE_OK,'count'=>$rule_count,'data'=>$rule_data];
		$this->dataJson($data);
	}

	public function set()
	{
		return ;
	}

	public function del()
	{

	}

	public function edit()
	{
		return ;
	}
}