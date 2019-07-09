<?php

namespace App\Model;

use App\Base\BaseModel;

use EasySwoole\EasySwoole\Config;

use App\Common\AppFunc;
class AdminAuth extends BaseModel
{
	protected $table = "admin_auth";

	public function findAll($page, $limit)
	{
		$data = $this->where('deleted',0,'=')
				->join('admin_role','admin_auth.role_id = admin_role.id')
				->where('admin_auth.deleted',0,'=')
				->orderBy('admin_auth.created_at','ASC')
				->get([($page-1) * $page, $limit]
					, "admin_auth.id,uname,display_name,admin_auth.created_at,logined_at,status,admin_role.name as role_name");

		return $data;
	}

	public function saveIdData($id, $data)
	{
		return $this->where('id',$id)->update($data);
	}

	public function findUname($uname)
	{
		return $this->where('uname', $uname)
				->where('deleted',0)
				->getOne();
	}

	public function login($uname, $pwd)
	{
		$data = $this->findUname($uname);
		$encry = Config::getInstance()->getConf('app.verify');
		return md5($data['encry'] . $pwd . $encry) == $data['pwd'] ? $data :false;
	}

	private function pwdEncry($pwd, $rand)
	{
		$encry = Config::getInstance()->getConf('app.verify');
		return md5($data['encry'] . $data['pwd'] . $encry);
	}

	// $data = ['uname', 'pwd', 'status', 'display_name', 'role_id']; 必须
	public function add($data)
	{
		$data['encry'] = AppFunc::getRandomStr(6);
		$encry = Config::getInstance()->getConf('app.verify');
		$data['pwd'] = $this->pwdEncry($data['pwd'],$encry);
		return $this->insert($data);
	}

	// $data = ['uname', 'pwd', 'status', 'display_name', 'role_id']; 必须
	public function save($id, $data)
	{
		$data['encry'] = AppFunc::getRandomStr(6);
		$encry = Config::getInstance()->getConf('app.verify');
		$data['pwd'] = $this->pwdEncry($data['pwd'], $encry);
		return $this->saveIdData($id, $data);
	}
}