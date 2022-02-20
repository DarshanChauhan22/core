<?php $customers = $this->getCustomers(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>
<html>
<head>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
	
</head>
<body>
	<div class='container' style="text-align: center; ">
	<h1> Customer Details </h1> 
	<form action="<?php echo $controllerCoreAction->getUrl('add','customer',null,true) ?>" method="POST">
		<button type="submit" name="Add" class="Registerbtn"> Add New </button>
	</form>

	<div id='info'>
	<table border=1 width=100%>
		<tr>
			<th> Id </th>
			<th> First Name </th>
			<th> Last Name </th>
			<th> Email </th>
			<th> Mobile </th>
			<th> Status </th>
			<th> Address </th>
			<th> Create Date </th>
			<th> Update Date </th>
			<th> Action </th>
		</tr>
		<?php if($customers):
			foreach ($customers as $customer): ?>
				 
				<tr>
		      		<td><?php echo $customer["customerId"] ?></td>
		    		<td><?php echo $customer["firstName"] ?></td>
		    		<td><?php echo $customer["lastName"] ?></td>
		    		<td><?php echo $customer["email"] ?></td>
		    		<td><?php echo $customer["mobile"] ?></td>
		    		<td>
			    		<?php if ($customer['status'] == 1):
			    			echo 'Active';
			    		else:
			    			echo 'InActive';
			    		endif; ?>
		    		</td>
		    		<td> <?php echo $customer['address'] ?> </td>
		    		<td><?php echo $customer["createdAt"] ?></td>
		    		<td><?php echo $customer["updatedAt"] ?></td>
		    		<td>
		    			<a href="<?php echo $controllerCoreAction->getUrl('delete','customer',['id' =>  $customer['customerId']],true) ?>">Delete</a> 
		    			<a href="<?php echo $controllerCoreAction->getUrl('edit','customer',['id' =>  $customer['customerId']],true) ?>">Update</a>
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