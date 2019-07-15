<?php

namespace App\Model;

use App\Base\BaseModel;

class AdminRule extends BaseModel
{
    protected $table = "admin_rule";

    public function findAll($page, $limit)
    {
        return $this->orderBy('created_at', 'ASC')
            ->get([($page - 1) * $page, $limit]
                , "id, name, node, status, created_at");
    }

    // 查找pid 为 0 的数据
    public function pid0Data()
    {
        return $this->orderBy('created_at', 'ASC')
            ->where('pid', 0, '=')
            ->get(null, "id, name");
    }

    public function saveIdData($id, $data)
    {
        return $this->where('id', $id)->update($data);
    }

    public function getIdsInNode($ids = [])
    {
        return $this->whereIn('id', $ids)->where('status', 1)->getColumn('node');
    }
}
