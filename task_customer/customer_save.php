<?php

		if($_POST['submit'])
		{
			
			require('Adapter.php');
			$adapter->connect();

			$id = $_POST['id'];
			echo $id;
			$firstName=$_POST['firstName'];
			$lastName=$_POST['lastName'];
			$mobile=$_POST['mobile'];
			$email=$_POST['email'];
			$status=$_POST['status'];
			$createdAt=$_POST['createdAt'];
			$updatedAt=$_POST['updatedAt'];
			$date=date('y-m-d h:i:s'); 
			
			if(!$id)
			{

			$query="insert into customer(firstName,lastName,mobile,email,status,createdAt,updatedAt) values ('$firstName','$lastName','$mobile','$email','$status','$date','$updatedAt')";

			$adapter->insert($query);

			header("Location: customer_grid.php");
			}
			
			$query="update customer set firstName=' $firstName ',lastName = ' $lastName ', mobile = '$mobile ', email = '$email', status = '$status ', createdAt = '$createdAt ', updatedAt = '$date ' where id =  $id";

			$adapter->update($query);

			header("Location: customer_grid.php");
		}
		header("Location: customer_grid.php");
?>