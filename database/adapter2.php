<?php

  class adapter
  {
    private $hostname = "localhost";
    private $user = "root";
    private $password = '';
    private $dbname = "student";
    public $con;

    public function connection()
    {
      $this->con = mysqli_connect($this->hostname,$this->user,$this->password,$this->dbname);
  
      if($this->con== false)
      {
        die("Error: Connection could not found");
      }
    }
   public function insert($query)
    { 
      //$name= $aname;
      //$city= $acity;
      //$phone= $aphno;
      
      //$query="insert into student(name,city,phno) values ('$name','$city','$phone')";
     
      mysqli_query($this->con,$query);
       echo "insert successfully";
  
    }


    function delete($query)
    {
      //$id = $aid;
      
      //$query = "delete from student where id = '$id'";
      
      mysqli_query($this->con,$query);
      echo "delete successfully";
    }


    function update($query)
    {
      
      //$id = $aid;
      //$name = $aname;
      //$city = $acity;
      //$phone = $aphno;
      
      //$query = "update student set name='". $name ."',city = '". $city ."', phno = '".$phone ."' where id =" . $id;
      mysqli_query($this->con,$query);
      echo "update successfully";

    }



    function view()
    {
      $rs=mysqli_query($this->con,"select * from student");
?>
      <table align="center" widht="50%" border="1">
        <tr>
          <th align="center">ID</th>
          <th align="center">Name</th>
          <th align="center">City</th>
          <th align="center">Phone</th>
        </tr>
        <?php
          while($row = mysqli_fetch_array($rs))
          {
            echo "<tr><td>". $row['id'] ."</td>";
            echo "<td>" . $row['name'] ."</td>";
            echo "<td>" . $row['city']."</td>";
            echo "<td>" . $row['phno'] ."</td>";
            
          }         
        ?>
      </table>

<?php 
    }

  }
  $obj = new adapter();
  $obj->connection();
  //$obj->insert("insert into student(name,city,phno) values ('name','city','12')");
  //$obj->delete("delete from student where id = '22'");
  $obj->update("update student set name='paul',city = 'brazil', phno = '456456' where id = '24'");
 $obj->view();

?>