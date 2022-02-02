<?php 
class Adapter{
    public $config = [
        'host'=>'localhost',
        'user'=>'root',
        'password'=>'',
        'dbname'=>'product'
    ];
    private $connect = NULL;
    public function connect()
    {
        $connect = mysqli_connect($this->config['host'],$this->config['user'],$this->config['password'],$this->config['dbname']);
        $this->setConnect($connect);
        return $connect;
    }

    public function setConnect($connect)
    {
        $this->connect = $connect;
        return $this;
    }

    public function getConnect()     
    {
        return $this->connect;
    }


    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

    public function getConfig()     
    {
        return $this->config;
    }

    public function query($query)
    {
        if(!$this->getConnect()){
            $this->connect();
        }
        $result = $this->getConnect()->query($query);
        echo "sus";
        return $result;
 
    }

    public function insert($query)
    {

        $result = $this->query($query);
        if($result){
            return $this->getConnect()->insert_id;
        }
        return $result;
    }

    public function update($query)
    {
        $result = $this->query($query);
        return $result;
    }

    public function delete($query)
    {
        $result = $this->query($query);
        return $result;
    }

    public function fetchRow($query)
    {
        $result = $this->query($query);
        if($result->num_rows){
            return $result->fetch_assoc();
        }
        return false;
    }

     public function fetchAll($query)
    {
        $result = $this->query($query);
        if($result->num_rows){
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }

}

$adapter = new Adapter();


/*
 $adapter->insert("INSERT INTO product(name,price,quantity,status,created_at,updated_at) VALUES ('test','200','2','1','','')");
*/
/*
$adapter->update("UPDATE product SET name = 'dom' WHERE product_id = 32");
*/

/*
$adapter->delete("DELETE FROM product where product_id = 32");
*/

//$data = $adapter->fetchAll("SELECT * FROM product");
//print_r($data);
?>