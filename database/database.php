<?php

  class adapter
  {
   public function insert()
    { 
     require("connection.php");
      $name='dosrfsm';
      $city='gvot';
      $phone='874560';
      
      //$query="insert into student_master(name,city,phno) values ('".$name."','".$city."','".$phone."')";
      $query="insert into student(name,city,phno) values ('$name','$city','$phone')";
      echo "insert into student(name,city,phno) values ('$name','$city','$phone')";
      echo "insert successfully";
      mysqli_query($con,$query);
  
    }


    function delete()
    {
      require("connection.php");
      $id = 9;
      
      $query = "delete from student where id = '$id'";
      echo "delete from student where id = '$id'";
      
      mysqli_query($con,$query);
      echo "delete successfully";
    }


    function update()
    {
      require("connection.php");
      
      $id = '2';
      $name = 'opo';
      $city = 'qwert';
      $phone = '956235';
      
      $query = "update student set name='". $name ."',city = '". $city ."', phno = '".$phone ."' where id =" . $id;
      
      mysqli_query($con,$query);
      echo "update successfully";

    }











    function view()
    {
      require("connection.php");
      $rs=mysqli_query($con,"select * from student");
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
 
  $obj->insert();
  //$obj->delete();
  //$obj->update();
 // $obj->view();

?>