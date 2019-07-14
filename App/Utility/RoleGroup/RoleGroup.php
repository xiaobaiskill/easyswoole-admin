<?php

namespace App\Utility\RoleGroup;
use easySwoole\Cache\Cache;

class RoleGroup 
{
	private $rules = [];
	public function __construct($role_id)
	{
		try{
            $this->rules = Cache::get('role_' . $role_id);
        }catch(Exception $e) {
            return ;
        }
	}
	
	public function hasRule($rule)
	{
		if(empty($rule)) {
            return true;
        }

        return in_array($rule, $this->rules);
	}
	
}