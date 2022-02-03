<?php


		if($_POST['submit'])
		{
			
			require('Adapter.php');
			$adapter->connect();

			$id = $_POST['id'];
			$name=$_POST['sname'];
			$price=$_POST['sprice'];
			$quantity=$_POST['squan'];
			$status=$_POST['sstatus'];
			$created=$_POST['screated'];
			$updated=$_POST['supdated'];
			$date=date('y-m-d h:i:s'); 
			
			if(!$id)
			{

			$query="insert into product(name,price,quantity,status,created_at,updated_at) values ('$name','$price','$quantity','$status','$date','$updated')";

			$adapter->insert($query);

			header("Location: product_grid.php");
			}

			$query="update product set name=' $name ',price = ' $price ', quantity = '$quantity ', status = '$status ', created_at = '$created ', updated_at = '$date ' where product_id =  $id";

			$adapter->update($query);

			header("Location: product_grid.php");
		}
		header("Location: product_grid.php");
?>