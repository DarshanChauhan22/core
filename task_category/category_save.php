<?php


		if($_POST['submit'])
		{
			
			require('Adapter.php');
			$adapter->connect();
			

			$id = $_POST['id'];
			$name=$_POST['sname'];
			$status=$_POST['sstatus'];
			$created=$_POST['screated'];
			$updated=$_POST['supdated'];
			$date=date('d-m-y h:i:s'); 
			
			if(!$id)
			{

			$query="insert into category(name,status,created_at,updated_at) values ('$name','$status','$date','$updated')";

			$adapter->insert($query);

			header("Location: category_grid.php");
			}

			$query="update category set name=' $name ', status = '$status ', created_at = '$created ', updated_at = '$date ' where id =  $id";

			$adapter->update($query);

			header("Location: category_grid.php");
		}
		header("Location: category_grid.php");
?>