<?php
	class connect
	{
		function insert()
		{
			require("connection.php");

			
			$name=$_POST['sname'];
			$price=$_POST['sprice'];
			$quantity=$_POST['squan'];
			$status=$_POST['sstatus'];
			$created=$_POST['screated'];
			$updated=$_POST['supdated'];
	


			$query="insert into product(name,price,quantity,status,created_at,updated_at) values ('$name','$price','$quantity','$status','$created','$updated')";
			mysqli_query($con,$query);
			echo "insert successfully";
			header("Location: product_grid.php");
		}
	}
	$obj = new connect();
	$obj->insert();
?> 
