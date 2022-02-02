<?php
	class connect
	{
		function delete()
		{
			require("connection.php");
			$id = $_GET['j'];
			
			$query = "delete from product where product_id = ".$id;
			
			mysqli_query($con,$query);
			header("Location: product_grid.php");
		}
	}
	$obj = new connect();
	$obj->delete();
?>