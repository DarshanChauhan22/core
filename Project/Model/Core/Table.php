<?php Ccc::loadClass('Model_Core_Table_Row'); ?>

<?php

class Model_Core_Table
{
	protected $tableName = NULL;
	protected $primaryKey = NULL;
	protected $rowClassName;

	public function getRowClassName()
	{
		return $this->rowClassName;
	}

	public function setRowClassName($rowClassName)
	{
		$this->rowClassName = $rowClassName;
		return $this;
	}

	public function getRow()
	{
		return Ccc::getModel($this->getRowClassName());
	}
  
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
		$columns = [];
		$values =[];
		global $adapter;
		foreach ($arr1 as $columnName => $value ){
			array_push($columns,$columnName);
			array_push($values,$value);
		}
			$sql1= implode(',', $columns);
			$sql2= implode("','", $values);
			$sql3 = "'" . $sql2 . "'";
			$tableName = $this->tableName;
			
			$sql4 = "INSERT INTO $tableName  ($sql1) values($sql3);" ;
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

		foreach($arr3 as $arrKey => $arrValue){
			$set[] = "$arrKey='$arrValue'";
		}
		$imp = implode(',', $set);
		$update = "UPDATE $tableName SET $imp WHERE $key = $value;";
		$result = $adapter->update($update);
		

//,updatedAt = '".$date."'
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

    public function load($id)
	{
		$rowData = $this->fetchRow("SELECT * FROM {$this->getTableName()} WHERE {$this->getPrimaryKey()} = {$id}");
		
		if(!$rowData)
		{
			return false;
		}
		$row = $this->getRow();
		$row->setData($rowData);
		return $row;
	}
}

?>