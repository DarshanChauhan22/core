<?php
	class connect
	{
		function update()
		{
			require("connection.php");
			
			$id = $_POST['id'];
			$name=$_POST['sname'];
			$price=$_POST['sprice'];
			$quantity=$_POST['squan'];
			$status=$_POST['sstatus'];
			$created=$_POST['screated'];
			$updated=$_POST['supdated'];
			echo $id;
			
			$query = "update product set name='".$name ."',price = '".$price ."', quantity = '".$quantity ."',status = '".$status ."', created_at = '".$created ."', updated_at = '".$updated ."' where product_id =" . $id;

			echo "update product set name='". $name ."',price = '". $price ."', quantity = '".$quantity ."', status = '".$status ."', created_at = '".$created ."', updated_at = '".$updated ."' where product_id =" . $id;
			
			mysqli_query($con,$query);
			header("Location: product_grid.php");
		}
	}
	$obj = new connect();
	$obj->update();
?>