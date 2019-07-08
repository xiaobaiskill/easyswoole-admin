<?php

namespace App\Model;

use App\Base\BaseModel;

class AdminAuth extends BaseModel
{
	protected $table = "admin_auth";

	public function findAll($page, $limit)
	{
		$data = $this->where('deleted',0,'=')
				->orderBy('created_at','ASC')
				->get([($page-1) * $page, $limit]
					, "id,uname,display_name,created_at,logined_at,status");

		return $data;
	}
}