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
					, "id, name, node, url, menu, status, created_at");
	}

	// 查找pid 为 0 的数据
	public function pid0Data()
	{
		return $this->orderBy('created_at','ASC')
					->where('deleted',0,'=')
					->where('pid',0,'=')
					->get(null, "id, name");
	}

	public function saveIdData($id,$data)
	{
		return $this->where('id',$id)->update($data);
	}
}