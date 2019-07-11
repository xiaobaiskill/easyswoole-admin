<?php

namespace App\Base;

use EasySwoole\EasySwoole\Config;

use App\Model\AdminAuth as AuthModel;
use App\Model\AdminLog as LogModel;

use easySwoole\Cache\Cache;
use App\Common\AppFunc;
use App\Utility\Massage\Status;
class AdminController extends BaseController
{
	protected $auth;   // 保存了登录用户的信息
	protected $role_group;

	// 检查token 是否合法
	private function checkToken()
	{
		$r = $this->request();
		$id = $r->getCookieParams('id');
		$time = $r->getCookieParams('time');

		$token = md5( $id . Config::getInstance()->getConf('app.token') . $time);
		if($r->getCookieParams('token') == $token) {
			$this->auth = AuthModel::getInstance()->find($id);
			AppFunc::initRule($this->auth['role_id']);
			// 如果 用户组类 被删除的话则使用,则使用 根用户组(RoleGroup)
			try {
				$role_group = 'RoleGroup' . $this->auth['role_id'];
			    $class ="\\App\\Utility\\RoleGroup\\{$role_group}";
				$this->role_group = new $class();
			} catch (Exception $e) {
			    $this->role_group = new \App\Utility\RoleGroup\RoleGroup();
			}

			return true;
		} else {
			$this->response()->redirect("/login");
			return false;
		}
	}

	// 操作记录
	protected function Record()
	{
		$data = [
			'url'  => $this->request()->getUri()->getPath(),
			'data' => json_encode($this->request()->getParsedBody()),
			'uid'  => $this->auth['id']
		];
		LogModel::getInstance()->insert($data);
		return true;
	}

	// get 请求是否有权限访问
	public function  hasRuleForGet($rule)
	{
		if(!AppFunc::hasRule($rule)) {
			$this->show404();
			return false;
		}

		return true;
	}

	// post 请求是否有权限访问
	public function  hasRuleForpost($rule)
	{
		if(!AppFunc::hasRule($rule)) {
			$this->writeJson(Status::CODE_RULE_ERR,'权限不足');
			return false;
		}
		return true;
	}


	public function onRequest(?string $action): ?bool
	{
		return $this->checkToken() && $this->Record();
		// return true;
	}

	public function dataJson($data)
	{
        if (!$this->response()->isEndResponse()) {
            $this->response()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $this->response()->withHeader('Content-type', 'application/json;charset=utf-8');
            return true;
        } else {
            return false;
        }
	}

	// 获取 page limit 信息
	public function getPage()
	{
		$request = $this->request();
		$data = $request->getRequestParam('page','limit');
		$data['page'] =  $data['page']?:1;
		$data['limit'] =  $data['limit']?:10;
		return $data;
	}
}