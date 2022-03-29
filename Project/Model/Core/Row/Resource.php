<?php Ccc::loadClass('Model_Core_Row_Resource'); ?>

<?php

class Model_Core_Row_Resource
{
	protected $tableName = NULL;
	protected $primaryKey = NULL;

	public function __construct()
    {
        
    }


    public function getRow()
    {
        return Ccc::getModel($this->getRowClassName());
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function getTableName()
    {
        return $this->tableName;
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

    public function getAdapter()
    {
        global $adapter;
        return $adapter;
    }

    public function insert(array $queryInsert)
    {
        if(!$queryInsert){
            return false;
        }
        $adapter = $this->getAdapter();
        $key = '`'.implode("`,`", array_keys($queryInsert)).'`';
        $value = '\''.implode("','", array_values($queryInsert)).'\'';
        $sqlResult = "INSERT INTO `{$this->getTableName()}` ({$key}) VALUES ({$value});";
        print_r($sqlResult);
        $result = $adapter->insert($sqlResult);
        return $result;
    }

    public function delete(array $queryDelete)
    {
		$adapter = $this->getAdapter();
        $tableName = $this->getTableName();
        $key = key($queryDelete);
        $value = $queryDelete[$key];
        $sqlResult = "DELETE FROM $tableName WHERE $key = $value;";
        $result = $adapter->delete($sqlResult);
        return $result;
    }

    /*public function update(array $queryUpdate, array $queryId)
    {
        $adapter = $this->getAdapter();
        $date = date("Y-m-d H:i:s");
        $set = [];
        $tableName = $this->getTableName();
        $key = key($queryId);
        $value = $queryId[$this->primaryKey];
        
        foreach ($queryUpdate as $sqlKey => $sqlValue) 
        {
            $set[] = "$sqlKey ='$sqlValue'";
        }
        
        $sql1 = implode(",", $set);
        $update = "UPDATE $tableName SET $sql1 WHERE $key = $value;";
        //print_r($update); die;
        $result = $adapter->update($update);
        return $result;
    }*/


    public function update($data,$id)
    {
        $whereClause = null;
        $fields = null;     
        if(!is_array($id))
        {
            $whereClause = '`'.$this->getPrimaryKey().'`'." = '".$this->getAdapter()->escapString($id)."'";
        }
        else
        {
            foreach ($id as $key => $value) 
            {
                $whereClause = $whereClause .'`'.$key.'`'. " = '".$value."' and ";
            }
            $whereClause = rtrim($whereClause,' and ');
        }
        foreach ($data as $col => $value) 
        {
            if($value != null)
            {
                $fields = $fields .'`'.$col.'`'. " = '".$this->getAdapter()->escapString($value)."',";

            }
            else
            {
                $fields = $fields . $col . ' = null ,';
            }
        }

        $fields = rtrim($fields,',');
        $query = "UPDATE ".'`'.$this->getTableName().'`'." SET ".$fields." WHERE ".$whereClause;
        return $this->getAdapter()->update($query);
    }



    public function fetchRow($queryFetchRow)
    {
         $adapter = $this->getAdapter();
        $tableName = $this->getTableName();
        $result = $adapter->fetchRow($queryFetchRow);
        return $result;
    }

    public function fetchAll($queryFetchAll)
    {
        $adapter = $this->getAdapter();
        $tableName = $this->getTableName();
        $result = $adapter->fetchAll($queryFetchAll);
        return $result;
    }
	
}

