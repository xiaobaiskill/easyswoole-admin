<?php

namespace App\HttpController\Admin\Auth;

use App\Base\AdminController;
use App\Utility\Message\Status;

use App\Utility\Log\Log;

use App\Model\AdminRule as RuleModel;

class Rule extends AdminController
{
	public function index()
	{
		$this->render('admin.auth.rule');
	}

	public function getAll()
	{
		$data = $this->getPage();

		$rule_data = RuleModel::getInstance()->findAll($data['page'], $data['limit']);

		$rule_count = RuleModel::getInstance()->count();
		$data = ['code'=>Status::CODE_OK,'count'=>$rule_count,'data'=>$rule_data];
		$this->dataJson($data);
	}

	// 获取修改 和 添加的数据 并判断是否完整
	private function fieldInfo()
	{
		$request = $this->request();
		$data = $request->getRequestParam('name','node', 'menu', 'status','pid');

		$validate = new \EasySwoole\Validate\Validate();
		$validate->addColumn('name')->required();
		$validate->addColumn('node')->required();
		$validate->addColumn('menu')->required();
		$validate->addColumn('status')->required();
		$validate->addColumn('pid')->required();

		if(!$validate->validate($data)) {
			$this->writeJson(Status::CODE_ERR,'请勿乱操作');
			return ;
		}

		return $data;
	}

	public function add()
	{
		$data = RuleModel::getInstance()->pid0Data();
		$this->render('admin.auth.ruleAdd',['data' => $data]);
	}

	public function addData()
	{
		$data = $this->fieldInfo();
		if(!$data) {
			return ;
		}
		if(RuleModel::getInstance()->insert($data)) {
			$this->writeJson(Status::CODE_OK);
		} else {
			$this->writeJson(Status::CODE_ERR,'添加失败');
			Log::getInstance()->error( "rule--addData:" . json_encode($data, JSON_UNESCAPED_UNICODE) . "没有添加失败");
		}
	}

	// 修改数据的页面
	public function edit()
	{
		$id = $this->request()->getRequestParam('id');

		if(!$id){
			$this->show404();
			return ;
		}

		$info = RuleModel::getInstance()->find($id);
		if(!$info) {
			$this->show404();
			return ;
		}

		$data = RuleModel::getInstance()->pid0Data();
		$this->render('admin.auth.ruleEdit',['data' => $data,'info'=>$info]);
	}

	// 修改数据
	public function editData()
	{
		$data = $this->fieldInfo();
		if(!$data) {
			return ;
		}

		$id = $this->request()->getRequestParam('id');
		if(!$id) {
			$this->writeJson(Status::CODE_ERR,'缺少ID参数');
			return ;
		}

		if(RuleModel::getInstance()->saveIdData($id, $data)) {
			$this->writeJson(Status::CODE_OK);
		} else {
			$this->writeJson(Status::CODE_ERR,'添加失败');
			Log::getInstance()->error( "rule--addData:" . json_encode($data, JSON_UNESCAPED_UNICODE) . "没有添加失败");
		}
	}



	// 单字段修改
	public function set()
	{
		$request = $this->request();
		$data = $request->getRequestParam('id','key','value');
		$validate = new \EasySwoole\Validate\Validate();

		$validate->addColumn('key')->required()->func(function($params, $key) {
		    return $params instanceof \EasySwoole\Spl\SplArray
		    		&& $key == 'key'
		    		&& in_array($params[$key], ['menu','status','name','node']);
		}, '请勿乱操作');

		$validate->addColumn('id')->required();
		$validate->addColumn('value')->required();

		if(!$validate->validate($data)) {
			$this->writeJson(Status::CODE_ERR,'请勿乱操作');
			return ;
		}

		$bool = RuleModel::getInstance()->where('id',$data['id'],'=')
								->setValue($data['key'],$data['value']);

		if($bool) {
			$this->writeJson(Status::CODE_OK);
		} else {
			$this->writeJson(Status::CODE_ERR,'设置失败');
			Log::getInstance()->error("rule--set:" .  json_encode($data, JSON_UNESCAPED_UNICODE) . "没有设置失败");
		}
	}

	public function del()
	{
		$request = $this->request();
		$id = $request->getRequestParam('id');
		$bool =  RuleModel::getInstance()->delId($id, true);
		if($bool) {
			$this->writeJson(Status::CODE_OK,'');
		} else {
			$this->writeJson(Status::CODE_ERR,'删除失败');
			Log::getInstance()->error("rule--del:" .  $id . "没有删除失败");
		}
	}


}