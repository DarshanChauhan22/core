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
   public function insert($aname,$acity,$aphno)
    { 
      $name= $aname;
      $city= $acity;
      $phone= $aphno;
      
      //$query="insert into student_master(name,city,phno) values ('".$name."','".$city."','".$phone."')";
      $query="insert into student(name,city,phno) values ('$name','$city','$phone')";
      echo "insert successfully";
      mysqli_query($this->con,$query);
  
    }


    function delete($aid)
    {
      $id = $aid;
      
      $query = "delete from student where id = '$id'";
      
      mysqli_query($this->con,$query);
      echo "delete successfully";
    }


    function update($aid,$aname,$acity,$aphno)
    {
      
      $id = $aid;
      $name = $aname;
      $city = $acity;
      $phone = $aphno;
      
      $query = "update student set name='". $name ."',city = '". $city ."', phno = '".$phone ."' where id =" . $id;
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
          while(mysqli_fetch_array($rs))
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
  //$obj->insert('dvc','monm','4545455');
  //$obj->delete(15);
  //$obj->update(1,'dc','morbi','123456');
 $obj->view();

?>