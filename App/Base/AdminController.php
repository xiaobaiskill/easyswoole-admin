<?php

namespace App\Base;

use EasySwoole\EasySwoole\Config;

use App\Model\AdminAuth as AuthModel;
use App\Model\AdminLog as LogModel;

use easySwoole\Cache\Cache;
class AdminController extends BaseController
{
	protected $auth;

	// 检查token 是否合法
	private function checkToken()
	{
		$r = $this->request();
		$id = $r->getCookieParams('id');
		$time = $r->getCookieParams('time');

		$token = md5( $id . Config::getInstance()->getConf('app.token') . $time);
		if($r->getCookieParams('token') == $token) {
			$this->auth = AuthModel::getInstance()->find($id);
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