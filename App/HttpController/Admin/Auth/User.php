<?php

namespace App\HttpController\Admin\Auth;

use App\Base\AdminController;
use App\Utility\Message\Status;

use App\Utility\Log\Log;

use App\Model\AdminAuth as AuthModel;


class User extends AdminController
{
	public function index()
	{
		$this->render('admin.auth.user');
	}

	// 获取用户数
	public function getAll()
	{
		$data = $this->getPage();

		$auth_data = AuthModel::getInstance()
						->findAll($data['page'],$data['limit']);

		$auth_count = AuthModel::getInstance()->where('deleted',0,'=')->count();
		$data = ['code'=>Status::CODE_OK,'count'=>$auth_count,'data'=>$auth_data];
		$this->dataJson($data);
		return ;
	}

	public function add()
	{
		return ;
	}

	// 多字段修改
	public function save()
	{
		return ;
	}

	// 单字段修改
	public function set()
	{
		$request = $this->request();
		$data = $request->getRequestParam('id','key','value');
		$validate = new \EasySwoole\Validate\Validate();

		$validate->addColumn('key')->required()->func(function($params, $key) {
		    return $params instanceof \EasySwoole\Spl\SplArray && $key == 'key' && in_array($params[$key], ['display_name','status']);
		}, '请勿乱操作');

		$validate->addColumn('id')->required();
		$validate->addColumn('value')->required();

		if(!$validate->validate($data)) {
			$this->writeJson(Status::CODE_ERR,'请勿乱操作');
			return ;
		}

		$bool = AuthModel::getInstance()->where('id',$data['id'],'=')
								->setValue($data['key'],$data['value']);

		if($bool) {
			$this->writeJson(Status::CODE_OK,'');
		} else {
			$this->writeJson(Status::CODE_ERR,'设置失败');
			Log::getInstance()->error("user--set:" .  json_encode($data, JSON_UNESCAPED_UNICODE) . "没有设置失败");
		}
	}

	public function del()
	{
		$request = $this->request();
		$id = $request->getRequestParam('id');
		$bool =  AuthModel::getInstance()->delId($id);
		if($bool) {
			$this->writeJson(Status::CODE_OK,'');
		} else {
			$this->writeJson(Status::CODE_ERR,'删除失败');
			Log::getInstance()->error("user--del:" .  $id . "没有删除失败");
		}
	}
}
