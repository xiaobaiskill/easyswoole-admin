<?php

namespace App\Base;

class AdminController extends BaseController
{
	public function onRequest(?string $action): ?bool
	{
		return true;
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