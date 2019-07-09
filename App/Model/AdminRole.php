<?php

namespace App\Model;

use App\Base\BaseModel;

use easySwoole\Cache\Cache;

use App\Model\AdminRule as RuleModel;
class AdminRole extends BaseModel
{
	protected $table = "admin_role";

	public function findAll($page, $limit)
	{
		return $this->orderBy('created_at','ASC')
					->get([($page-1) * $page, $limit]
					, "id, name, detail, created_at");
	}

	public function saveIdData($id, $data)
	{
		return $this->where('id',$id)->update($data);
	}


	public function saveIdRules($id, $rules_checked, $rules)
	{
		if($this->saveIdData($id, ['rules_checked' => implode(',', $rules_checked),'rules' => implode(',', $rules)])) {
			$rules = RuleModel::getInstance()->getIdsInNode($rules);
			Cache::set('role_' . $id, $rules);
			return true;
		} else {
			return false;
		}

	}
}