<?php 

require('Adapter.php');
			$adapter->connect();
			$con = $adapter->getConnect();

			$id = $_GET['j'];
			
			$query ="DELETE FROM product where product_id =  $id";

			$row = $adapter->delete($query);
			header("Location: product_grid.php");

?>