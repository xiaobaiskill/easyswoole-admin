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

	private function fieldInfo()
	{
		$request = $this->request();
		$data = $request->getRequestParam('name','detail');

		$validate = new \EasySwoole\Validate\Validate();
		$validate->addColumn('name')->required();
		$validate->addColumn('detail')->required();

		if(!$validate->validate($data)) {
			$this->writeJson(Status::CODE_ERR,'请勿乱操作');
			return ;
		}

		return $data;
	}

	public function add()
	{
		$this->render('admin.auth.roleAdd');
	}

	public function addData()
	{
		$data = $this->fieldInfo();
		if(!$data) {
			return ;
		}

		if(RoleModel::getInstance()->insert($data)) {
			$this->writeJson(Status::CODE_OK);
		} else {
			$this->writeJson(Status::CODE_ERR,'添加失败');
			Log::getInstance()->error( "role--addData:" . json_encode($data, JSON_UNESCAPED_UNICODE) . "没有添加失败");
		}
	}

	public function edit()
	{
		$id = $this->request()->getRequestParam('id');

		$info = RoleModel::getInstance()->find($id, 'name, detail');
		$this->render('admin.auth.roleEdit', ['id' => $id, 'info' => $info ]);
	}

	public function editData()
	{
		$data = $this->fieldInfo();
		if(!$data) {
			return ;
		}

		$id = $this->request()->getRequestParam('id');
		if(RoleModel::getInstance()->saveIdData($id, $data)) {
			$this->writeJson(Status::CODE_OK);
		} else {
			$this->writeJson(Status::CODE_ERR,'保存失败');
			Log::getInstance()->error( "role--editData:" . json_encode($data, JSON_UNESCAPED_UNICODE) . "编辑保存失败");
		}
		return ;
	}

	public function set()
	{
		$request = $this->request();
		$data = $request->getRequestParam('id','key','value');
		$validate = new \EasySwoole\Validate\Validate();

		$validate->addColumn('key')->required()->func(function($params, $key) {
		    return $params instanceof \EasySwoole\Spl\SplArray
		    		&& $key == 'key'
		    		&& in_array($params[$key], ['name','detail']);
		}, '请勿乱操作');

		$validate->addColumn('id')->required();
		$validate->addColumn('value')->required();

		if(!$validate->validate($data)) {
			$this->writeJson(Status::CODE_ERR,'请勿乱操作');
			return ;
		}

		$bool = RoleModel::getInstance()->where('id',$data['id'])
								->setValue($data['key'],$data['value']);
		var_dump($bool);
		if($bool) {
			$this->writeJson(Status::CODE_OK);
		} else {
			$this->writeJson(Status::CODE_ERR,'设置失败');
			Log::getInstance()->error("role--set:" .  json_encode($data, JSON_UNESCAPED_UNICODE) . "没有设置成功");
		}
	}

	public function del()
	{
		$request = $this->request();
		$id = $request->getRequestParam('id');
		$bool =  RoleModel::getInstance()->delId($id, true);
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
		$this->render('admin.auth.editRule', ['id' => $id, 'data' => $data, 'checked'=>explode(',', $role_info['rules_checked']) ]);
	}

	public function editRuleData()
	{
		$info = $this->request()->getRequestParam('id','rules_checked', 'rules');

		$id = $info['id'];
		if(RoleModel::getInstance()->saveIdRules($id, $info['rules_checked'], $info['rules'])) {
			$this->writeJson(Status::CODE_OK);
		} else {
			$this->writeJson(Status::CODE_ERR,'删除失败');
			Log::getInstance()->error( "role--editRuleData:" . json_encode($info, JSON_UNESCAPED_UNICODE) . "权限变更失败");
		}
		return ;
	}
}