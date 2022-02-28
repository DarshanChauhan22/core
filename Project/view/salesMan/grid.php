<?php $salesMans = $this->getSalesMans(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>

<html>
<head>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
	
</head>
<body>
	<div class='container' style="text-align: center; ">
	<h1> SalesMan Details </h1> 
	<form action="<?php echo $controllerCoreAction->getUrl('add','salesMan',null,true) ?>" method="POST">
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
				<th> Create Date </th>
				<th> Update Date </th>
				<th> Action </th>
			</tr>
			<?php if($salesMans):
				foreach ($salesMans as $salesMan): ?>
					<tr>
			      		<td><?php echo $salesMan->salesManId ?></td>
			    		<td><?php echo $salesMan->firstName ?></td>
			    		<td><?php echo $salesMan->lastName ?></td>
			    		<td><?php echo $salesMan->email ?></td>
			    		<td><?php echo $salesMan->mobile ?></td>
			    		
			    		<td>
				    		<?php echo $salesMan->getStatus($salesMan->status); ?>
			    		</td>
			    		</td>
			    		<td><?php echo $salesMan->createdAt ?></td>
			    		<td><?php echo $salesMan->updatedAt ?></td>
			    		<td>
			    			<a href="<?php echo$controllerCoreAction->getUrl('delete','salesMan',['id' =>  $salesMan->salesManId],true) ?>">Delete</a> 
			    			<a href="<?php echo$controllerCoreAction->getUrl('edit','salesMan',['id' =>  $salesMan->salesManId],true) ?>">Update</a>
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