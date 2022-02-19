<?php

class Model_Core_Table
{
	protected $tableName = NULL;
	protected $primaryKey = NULL;
  
	public function getTableName()
	{
		return $this->tableName;
	}

	public function setTableName($tableName)
	{
		$this->tableName = $tableName;
		return $this;
	}

	public function getPrimaryKey()
	{
		return $this->primaryKey;
	}

	public function setPrimaryKey($primaryKey)
	{
		$this->primaryKey = $primaryKey;
		return $this;
	}

	public function insert(array $arr1)
	{
		$cn = [];
		$vn =[];
		global $adapter;
		foreach ($arr1 as $columnName => $value ){
			array_push($cn,$columnName);
			array_push($vn,$value);
		}
			$sql1= implode(',', $cn);
			$sql2= implode("','", $vn);
			$sql3 = "'" . $sql2 . "'";
			$tableName = $this->tableName;
			
			$sql4 = "INSERT INTO $tableName ($sql1) values($sql3);" ;
			$result = $adapter->insert($sql4);
			return $result;
	}

	public function update(array $arr3 , array $arr4)
	{	
		global $adapter;
		global $date;
		$set = [];
		$tableName = $this->getTableName();
		$key = key($arr4);
		$value = $arr4[$this->getPrimaryKey()];

		foreach($arr3 as $k => $v){
			$set[] = "$k='$v'";
		}
		$imp = implode(',', $set);
		$update = "UPDATE $tableName SET $imp ,updatedAt = '".$date."'  WHERE $key = $value;";
		$result = $adapter->update($update);

		return $result;
	}	

	public function delete(array $arr2)
	{
		global $adapter;
		$key = key($arr2);
		$id = $arr2[$this->primaryKey];
		$tableName = $this->tableName;
		$query = "DELETE FROM $tableName WHERE $key = $id;";
		$result = $adapter->delete($query);
		return $result;
	}

	public function fetchRow($queryFetchRow)
    {
        global $adapter;
        $tableName = $this->getTableName();
        $result = $adapter->fetchRow($queryFetchRow);
       return $result;
    }

    public function fetchAll($queryFetchAll)
    {
        global $adapter;
        $tableName = $this->getTableName();
        $result = $adapter->fetchAll($queryFetchAll);
        return $result;
    }
}

?>