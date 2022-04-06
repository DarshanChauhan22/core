<?php

class Model_Core_Row_Resource
{
    protected $tableName = NULL;
    protected $primaryKey = NULL;
  
    public function __construct()
    {
        
    }

    public function getAdapter()
    {
        global $adapter;
        return $adapter;
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

    public function insert(array $queryInsert)
    {
        if(!$queryInsert){
            return false;
        }
        $key = '`'.implode("`,`", array_keys($queryInsert)).'`';
        $value = '\''.implode("','", array_values($queryInsert)).'\'';

        $sqlResult = "INSERT INTO `{$this->getTableName()}` ({$key}) VALUES ({$value});";
       // print_r($sqlResult); //die;
        $result = $this->getAdapter()->insert($sqlResult);
        return $result;
    }

    public function delete(array $deleteArr)
    { 
        $tableName = $this->getTableName();

        $key = key($deleteArr);
        $value = $deleteArr[$key];
        $delete = "DELETE FROM $tableName WHERE $key = $value;";
        $result = $this->getAdapter()->delete($delete);
        return $result;
    }

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
        //print_r($query);
        return $this->getAdapter()->update($query);
    }

    public function fetchRow($queryFetchRow)
    {
        $tableName = $this->getTableName();
        $result = $this->getAdapter()->fetchRow($queryFetchRow);
        return $result;  
    }

    public function fetchAll($queryFetchAll)
    {
        $tableName = $this->getTableName();
        $result = $this->getAdapter()->fetchAll($queryFetchAll);
        return $result;
    }
}

