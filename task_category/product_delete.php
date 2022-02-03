<?php 

require('Adapter.php');
			$adapter->connect();
			

			$id = $_GET['j'];
			
			$query ="DELETE FROM category where id =  $id";

			$row = $adapter->delete($query);
			header("Location: product_grid.php");

?>