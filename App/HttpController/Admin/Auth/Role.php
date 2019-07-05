<?php

namespace App\HttpController\Admin\Auth;

use App\Base\AdminController;

use App\Utility\Log\Log;

use App\Model\AdminRole as RoleModel;

use App\Utility\Message\Status;
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
						->getAll($data['page'],$data['limit']);

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

		$this->render('admin.auth.editRule');
	}
}