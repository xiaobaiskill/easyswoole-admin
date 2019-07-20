<?php

namespace App\Utility\RoleGroup;
use easySwoole\Cache\Cache;
use App\Model\AdminRole as RoleModel;
use App\Model\AdminRule as RuleModel;

class RoleGroup 
{
	private $role_id;
	public function __construct($role_id)
	{
		$this->role_id = $role_id;
	}
	
	public function hasRule($rule)
	{
		if(empty($rule)) {
            return true;
        }

        if(!isset($this->rules)) {
        	$data = RoleModel::getInstance()->find($this->role_id);
        	$this->rules = RuleModel::getInstance()->getIdsInNode($data['rules']);
        }

        return in_array($rule, $this->rules);
	}
	
}