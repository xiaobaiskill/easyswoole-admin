<?php

namespace App\Model;

use App\Base\BaseModel;

class Feedback extends BaseModel
{
	protected $table = "bf_yg_feedback";

	// 返回加密的hash
	public function add($data):?string
	{
		if ($id = $this->insert($data)) {
			$hash = strtoupper(substr(md5('jmz' . $id),5,16));
			$this->where('id',$id,'=')->setValue('hash', $hash);
			return $hash;
		}
		return null;
	}
}