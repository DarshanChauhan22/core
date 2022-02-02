<?php

$id = $_POST['id'];
echo $id;

			if(!$id)
			{
			require('Adapter.php');
			$adapter->connect();
			$con = $adapter->getConnect();

            $name=$_POST['sname'];
			$price=$_POST['sprice'];
			$quantity=$_POST['squan'];
			$status=$_POST['sstatus'];
			$created=$_POST['screated'];
			$updated=$_POST['supdated'];
	

			$query="insert into product(name,price,quantity,status,created_at,updated_at) values ('$name','$price','$quantity','$status','$created','$updated')";

			$adapter->insert($query);

			header("Location: product_grid.php");
		}else{
			echo "edir";
		}


?>