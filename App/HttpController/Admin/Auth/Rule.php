<?php

namespace App\HttpController\Admin\Auth;

use App\Base\AdminController;
use App\Utility\Message\Status;

use App\Utility\Log\Log;

use App\Model\AdminRule as RuleModel;

use App\Common\AppFunc;
class Rule extends AdminController
{
	public function index()
	{
		$this->render('admin.auth.rule');
	}

	public function getAll()
	{
		$rule_data = RuleModel::getInstance()->get();

		$tree_data = AppFunc::arrayToTree($rule_data,'pid');
		$data = [];
		AppFunc::treeRule($tree_data, $data);

		$data = ['code'=>Status::CODE_OK, 'data'=>$data];
		$this->dataJson($data);
	}

	// 获取修改 和 添加的数据 并判断是否完整
	private function fieldInfo()
	{
		$request = $this->request();
		$data = $request->getRequestParam('name','node', 'status');

		$validate = new \EasySwoole\Validate\Validate();
		$validate->addColumn('name')->required();
		$validate->addColumn('node')->required();
		$validate->addColumn('status')->required();

		if(!$validate->validate($data)) {
			$this->writeJson(Status::CODE_ERR,'请勿乱操作');
			return ;
		}

		return $data;
	}

	public function add()
	{
		$this->render('admin.auth.ruleAdd');
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
			Log::getInstance()->error( "rule--addData:" . json_encode($data, JSON_UNESCAPED_UNICODE) . "添加失败");
		}
	}

	public function addChild()
	{
		$id = $this->request()->getRequestParam('id');
		$this->render('admin.auth.ruleAdd',['id' => $id]);
	}

	public function addChildData()
	{
		$data = $this->fieldInfo();
		if(!$data) {
			return ;
		}

		$data['pid'] = $this->request()->getRequestParam('id');

		if(RuleModel::getInstance()->insert($data)) {
			$this->writeJson(Status::CODE_OK);
		} else {
			$this->writeJson(Status::CODE_ERR,'添加失败');
			Log::getInstance()->error( "rule--addChildData:" . json_encode($data, JSON_UNESCAPED_UNICODE) . "添加失败");
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

		if(RuleModel::getInstance()->saveIdData($id, $data)) {
			$this->writeJson(Status::CODE_OK);
		} else {
			$this->writeJson(Status::CODE_ERR,'保存失败');
			Log::getInstance()->error( "rule--addData:" . json_encode($data, JSON_UNESCAPED_UNICODE) . "编辑保存失败");
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
		    		&& in_array($params[$key], ['status', 'node']);
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
			Log::getInstance()->error("rule--set:" .  json_encode($data, JSON_UNESCAPED_UNICODE) . "没有设置成功");
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