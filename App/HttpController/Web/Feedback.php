<?php

namespace App\HttpController\Web;

use App\Base\BaseController;
use App\Utility\Message\Status;

use App\Model\Feedback as FeedbackModel;
use App\Model\FeedbackReply as FeedbackReplyModel;

use App\Utility\Log\Log;

use easySwoole\Cache\Cache;

use EasySwoole\EasySwoole\Config;

class Feedback extends BaseController
{
	public function index()
	{
		$this->render('web.feedback.feedback',['title'=>'建议页面']);
	}

	public function add()
	{
		$request = $this->request();
		$data = $request->getRequestParam('title','detail','verify');

		$encry = Config::getInstance()->getConf('web.verify_encry');

		if (md5($encry . strtoupper($data['verify']) . $encry) != $this->request()->getCookieParams('v-idea')) {
			$this->writeJson(Status::CODE_VERIFY_ERR, '验证码有误');return ;
		}

		unset($data['verify']);

		if($hash = FeedbackModel::getInstance()->add($data)) {
			$this->writeJson(Status::CODE_OK, '', ['hash' => $hash]);
		} else {
			Log::getInstance()->error( json_encode($data, JSON_UNESCAPED_UNICODE) . "没有存储成功");
			$this->writeJson(Status::CODE_ERR,'失败');
		}
	}

	// 回复页
	public function reply()
	{
		$encry = $this->request()->getRequestParam('encry');
		$feedback_info  = FeedbackModel::getInstance()->where('hash',$encry,'=')->getOne('id,title,detail');

		if(empty($feedback_info)){
			$this->render('default.404');
			return ;
		}

		$reply_info = FeedbackReplyModel::getInstance()
					->where('fid',$feedback_info['id'],'=')
					->orderBy('created_at','ASC')
					->get();

		$data = [
			'feedback' => $feedback_info,
			'reply'	   => $reply_info,
			'title'	   => $feedback_info['title']
		];
		$this->render('web.feedback.reply',$data);
	}

	// 回复添加
	public function replyAdd()
	{
		$data = $this->request()->getRequestParam('fid','context');
		$data['sender'] = 0;
		if(FeedbackReplyModel::getInstance()->insert($data)) {
			$this->writeJson(Status::CODE_OK);
		} else {
			$this->writeJson(Status::CODE_ERR,'发送失败');
		}
	}
}