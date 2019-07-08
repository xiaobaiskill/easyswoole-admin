<?php

namespace App\Base;

use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Template\Render;

abstract class BaseController extends Controller
{
	function index()
    {
        $this->actionNotFound('index');
    }

	public function render(string $template,array $data = [],array $options = [])
	{
		$this->response()->write(Render::getInstance()->render($template, $data, $options));
	}

    public function show404()
    {
        $this->render('default.404');
    }

	public function writeJson($statusCode = 200, $msg = null, $data = null)
	{
        if (!$this->response()->isEndResponse()) {
            $result = Array(
                "code" => $statusCode,
                "msg" => $msg,
                "data" => $data
            );
            $this->response()->write(json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $this->response()->withHeader('Content-type', 'application/json;charset=utf-8');
            return true;
        } else {
            return false;
        }
	}
}