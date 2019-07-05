<?php

namespace App\Base;

use App\Utility\Pool\MysqlPool;
use App\Utility\Pool\MysqlObject;
use EasySwoole\Component\Pool\PoolManager;



abstract class BaseModel
{
	protected $db;
	protected $table;
    private static $instance=[];

    static function getInstance(...$args)
    {
        $obj_name = static::class;
        if(!isset(self::$instance[$obj_name])){
            self::$instance[$obj_name] = new static(...$args);
        }
        return self::$instance[$obj_name];
    }

	protected function __construct()
	{
		$db = MysqlPool::defer();

		if($db instanceof MysqlObject) {
			$this->db = $db;
		} else {
			throw new \Exception('mysql pool is empty');
		}
	}

	public function startTransaction(): bool
	{
		return $this->db->startTransaction();
	}

	public function commit(): bool
	{
		return $this->db->commit();
	}

	public function rollback($commit = true)
	{
		$this->rollback($commit);
	}

	public function where($whereProp, $whereValue = 'DBNULL', $operator = '=', $cond = 'AND'): BaseModel
	{
		$this->db->where($whereProp, $whereValue, $operator, $cond);
		return $this;
	}

	public function whereOr($whereProp, $whereValue = 'DBNULL', $operator = '='): BaseModel
    {
        return $this->db->where($whereProp, $whereValue, $operator, 'OR');
        return $this;
    }

    public function whereNull($whereProp, $cond = 'AND'): BaseModel
    {
        return $this->db->whereNull($whereProp, $cond);
        return $this;
    }

    public function whereNotNull($whereProp, $cond = 'AND'): BaseModel
    {
        return $this->db->whereNotNull($whereProp, $cond);
        return $this;
    }

    public function whereEmpty($whereProp, $cond = 'AND'): BaseModel
    {
        return $this->db->whereEmpty($whereProp, $cond);
        return $this;
    }

    public function whereNotEmpty($whereProp, $cond = 'AND'): BaseModel
    {
        return $this->db->whereNotEmpty($whereProp, $cond);
        return $this;
    }

    public function whereIn($whereProp, $whereValue, $cond = 'AND'): BaseModel
    {
    	$this->db->whereIn($whereProp, $whereValue, $cond);
        return $this;
    }

    public function whereNotIn($whereProp, $whereValue, $cond = 'AND'): BaseModel
    {
        $this->db->whereNotIn($whereProp, $whereValue, $cond);
        return $this;
    }

    public function whereBetween($whereProp, $whereValue, $cond = 'AND'): BaseModel
    {
    	$this->db->whereBetween($whereProp, $whereValue, $cond);
        return $this;
    }

    public function whereNotBetween($whereProp, $whereValue, $cond = 'AND'): BaseModel
    {
        $this->db->whereNotBetween($whereProp, $whereValue, $cond);
        return $this;
    }

    public function whereLike($whereProp, $whereValue, $cond = 'AND'): BaseModel
    {
        return $this->db->whereLike($whereProp, $whereValue, $cond);
        return $this;
    }

    public function whereNotLike($whereProp, $whereValue, $cond = 'AND'): BaseModel
    {
    	$this->db->whereNotLike($whereProp, $whereValue, $cond);
        return $this;
    }

    public function get($numRows = null, $columns = '*')
    {
    	return $this->db->get($this->table, $numRows, $columns);
    }

    public function getOne($columns = '*')
    {
    	return $this->db->getOne($this->table, $columns);
    }

    public function find($id, $columns = '*')
    {
        return $this->where('id', $id)->getOne($columns);
    }

    public function getValue($column, $limit = 1)
    {
    	return $this->db->getValue($this->table, $columns, $limit);
    }

    public function getColumn($columnName, $limit = null)
    {
    	return $this->db->getColumn($this->table, $columnName, $limit);
    }

    public function insert($insertData)
    {
        return $this->db->insert($this->table, $insertData, 'INSERT');
    }

    public  function replace($insertData)
    {
        return $this->db->replace($this->table, $insertData, 'REPLACE');
    }

    public function onDuplicate($updateColumns, $lastInsertId = null): BaseModel
    {
        $this->db->onDuplicate($updateColumns, $lastInsertId);
        return $this;
    }

    public function insertMulti($tableName, array $multiInsertData, array $dataKeys = null)
    {
    	return $this->db->insertMulti($tableName, $multiInsertData, $dataKeys);
    }

    // 查询表中是否有数据
    public function has()
    {
    	return $this->db->has($this->table);
    }

    public function count($filedName = null)
    {
    	return $this->db->count($this->table, $filedName);
    }

    public function max($filedName)
    {
        return $this->db->max($this->table, $filedName);
    }

    public function min($filedName)
    {
        return $this->db->min($this->table, $filedName);
    }

    public function sum($filedName)
    {
        return $this->db->sum($this->table, $filedName);
    }

    public function avg($filedName)
    {
        return $this->db->avg($this->table, $filedName);
    }

    public function delete($tableName, $numRows = null)
    {
        return $this->db->delete($this->table, $numRows);
    }

    // $del => 真删除 还是 假删除
    public function delId($id, $del = false)
    {
        if($del){
            return $this->where('id',$id)->delete();
        } else {
            return $this->where('id',$id)->setValue('deleted',1);
        }

    }

    public function setValue($filedName, $value)
    {
        return $this->db->setValue($this->table, $filedName, $value);
    }

    public function update($tableData, $numRows = null)
    {
        return $this->db->update($this->table, $tableData, $numRows);
    }

    // 字段自增
    public function setInc($tableName, $filedName, $num = 1)
    {
        return $this->db->setInc($this->table, $filedName, $num);
    }

    public function setDec($tableName, $filedName, $num = 1)
    {
        return $this->db->setDec($this->table, $filedName, $num);
    }

    // 获取即将执行的sql语句
    public function fetchSql(bool $fetch = true)
    {
        $this->db->fetchSql($fetch);
        return $this;
    }

    // 查询结果总数
    public function withTotalCount()
    {
        $this->db->withTotalCount();
        return $this;
    }

    // 返回结果总数
    public function getTotalCount():? int
    {
        return $this->db->getTotalCount();
    }

    /**
     * 本次查询影响的行数
     * @return int
     */
    public function getAffectRows():? int
    {
        return $this->db->getAffectRows;
    }

    public function join($joinTable, $joinCondition, $joinType = '')
    {
       $this->db->join($joinTable, $joinCondition, $joinType);
       return $this;
    }

    public function setQueryOption($options)
    {
        $this->db->setQueryOption($options);
        return $this;
    }

    /**
     * 获取子查询
     * @return array|null
     * @author: eValor < master@evalor.cn >
     */
    public function getSubQuery()
    {
        return $this->db->getSubQuery();
    }

    public function getInsertId()
    {
        return $this->db->getInsertId();
    }

    public function getLastQuery()
    {
        return $this->db->getLastQuery();
    }

    public function getLastError()
    {
    	return $this->db->getLastError();
    }

    public function getLastErrno()
    {
        return $this->db->getLastErrno();
    }

    public function orderBy($orderByField, $orderByDirection = "DESC", $customFieldsOrRegExp = null)
    {
        $this->db->orderBy($orderByField, $orderByDirection, $customFieldsOrRegExp);
        return $this;
    }




    public function having($havingProp, $havingValue = 'DBNULL', $operator = '=', $cond = 'AND')
    {
        $this->db->having($havingProp, $havingValue, $operator, $cond);
        return $this;
    }

    /**
     * 字段分组
     * @param $groupByField
     * @return $this
     * @author: eValor < master@evalor.cn >
     */
    public function groupBy($groupByField)
    {
        $this->db->groupBy($groupByField);
        return $this;
    }

	function __destruct()
	{
		if ($this->db instanceof MysqlObject) {
            PoolManager::getInstance()->getPool(MysqlPool::class)->recycleObj($this->db);
        }
	}

}