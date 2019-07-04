<?php

namespace App\Model;

use App\Base\BaseModel;

class AdminRole extends BaseModel
{
	protected $table = "admin_role";

	public function getAll($page, $limit)
	{
		return $this->orderBy('created_at','ASC')
					->get([($page-1) * $page, $limit]
					, "id, name, detail, created_at");
	}
}