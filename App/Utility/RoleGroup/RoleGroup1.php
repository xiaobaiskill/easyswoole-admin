<?php

namespace App\Utility\RoleGroup;

class RoleGroup1  extends RoleGroup
{
	public function __construct($role_id)
	{
		return ;
	}
	
	public function hasRule($rule)
	{
		return true;
	}
}