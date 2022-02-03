<?php 

require_once('Adapter.php');
			$adapter->connect();
			$con = $adapter->getConnect();

			$id = $_GET['j'];
			
			$query ="DELETE FROM customer where id =  $id";

			$row = $adapter->delete($query);
			header("Location: customer_grid.php");

?>