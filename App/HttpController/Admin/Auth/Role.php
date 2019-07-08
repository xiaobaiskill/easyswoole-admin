<?php

namespace App\HttpController\Admin\Auth;

use App\Base\AdminController;

use App\Utility\Log\Log;

use App\Model\AdminRole as RoleModel;
use App\Model\AdminRule as RuleModel;

use App\Utility\Message\Status;

use App\Common\AppFunc;

class Role extends AdminController
{
	public function index()
	{
		$this->render('admin.auth.role');
	}

	public function getAll()
	{
		$data = $this->getPage();

		$role_data = RoleModel::getInstance()
						->findAll($data['page'],$data['limit']);

		$role_count = RoleModel::getInstance()->count();
		$data = ['code'=>Status::CODE_OK, 'count'=>$role_count, 'data'=>$role_data];
		$this->dataJson($data);
		return ;
	}


	public function del()
	{
		$request = $this->request();
		$id = $request->getRequestParam('id');
		$bool =  RoleModel::getInstance()->where('id', $id, '=')->delete(1);
		if($bool) {
			$this->writeJson(Status::CODE_OK,'');
		} else {
			$this->writeJson(Status::CODE_ERR,'删除失败');
			Log::getInstance()->error( "role--del:" . json_encode($data, JSON_UNESCAPED_UNICODE) . "没有删除失败");
		}
	}

	public function editRule()
	{
		$rule_data = RuleModel::getInstance()->get(null, 'id, name as title, pid');
		$data = AppFunc::arrayToTree($rule_data);

		$id = $this->request()->getRequestParam('id');
		$role_info = RoleModel::getInstance()->find($id);
		$this->render('admin.auth.editRule', ['id' => $id, 'data' => $data, 'checked'=>explode(',', $role_info['rules']) ]);
	}

	public function editRuleData()
	{
		$info = $this->request()->getRequestParam('id','rules');

		$id = $info['id'];
		$rules = implode(',', $info['rules']);
		var_dump($rules);
		if(RoleModel::getInstance()->saveIdData($id, ['rules' => $rules])) {
			$this->writeJson(Status::CODE_OK);
		} else {
			$this->writeJson(Status::CODE_ERR,'删除失败');
			Log::getInstance()->error( "role--editRuleData:" . json_encode($info, JSON_UNESCAPED_UNICODE) . "权限变更失败");
		}
		return ;
	}
}