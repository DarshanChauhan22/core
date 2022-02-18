<?php
	$admins = $this->getAdmins();
	$controllerCoreAction = new Controller_Core_Action();
	//print_r($controllerCoreAction->getUrl('save','admin',null,false));
	//exit();
?>

<html>
<head>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
	
</head>
<body>
	<div class='container' style="text-align: center; ">
	<h1> Admin Details </h1> 
	<form action="<?php echo $controllerCoreAction->getUrl('add','admin',null,true) ?>" method="POST">
		<button type="submit" name="Add" class="Registerbtn"> Add New </button>
	</form>

	<div id='info'>
		<table border=1 width=100%>
			<tr>
				<th> Id </th>
				<th> First Name </th>
				<th> Last Name </th>
				<th> Email </th>
				<th> Password </th>
				<th> Mobile </th>
				<th> Status </th>
				<th> Create Date </th>
				<th> Update Date </th>
				<th> Action </th>
			</tr>
			<?php if($admins):
				foreach ($admins as $row): ?>
					<tr>
			      		<td><?php echo $row["adminId"] ?></td>
			    		<td><?php echo $row["firstName"] ?></td>
			    		<td><?php echo $row["lastName"] ?></td>
			    		<td><?php echo $row["email"] ?></td>
			    		<td><?php echo $row["password"] ?></td>
			    		<td><?php echo $row["mobile"] ?></td>
			    		<td>
				    		<?php if ($row['status'] == 1):
				    			echo 'Active';
				    		else:
				    			echo 'InActive';
				    		endif; ?>
			    		</td>
			    		<td><?php echo $row["createdAt"] ?></td>
			    		<td><?php echo $row["updatedAt"] ?></td>
			    		<td>
			    			<a href="<?php echo$controllerCoreAction->getUrl('delete','admin',['id' =>  $row['adminId']],true) ?>">Delete</a> 
			    			<a href="<?php echo$controllerCoreAction->getUrl('edit','admin',['id' =>  $row['adminId']],true) ?>">Update</a>
			    		</td>
			   		</tr>
			 	<?php endforeach;?>
			<?php else:?>
				<tr><td colspan='10'>No Record Available</td></tr>			
			<?php endif; ?>
		</table>
	</div>
</body>
</html>