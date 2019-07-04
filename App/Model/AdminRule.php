<?php

namespace App\Model;

use App\Base\BaseModel;

class AdminRule extends BaseModel
{
	protected $table = "admin_rule";

	public function getAll($page, $limit)
	{
		return $this->orderBy('created_at','ASC')
					->where('deleted',0,'=')
					->get([($page-1) * $page, $limit]
					, "id, name, url, menu, status, created_at");
	}
}