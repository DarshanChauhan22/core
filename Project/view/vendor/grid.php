<?php $vendors = $this->getVendors(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>

	<h1> Vendor Details </h1> 
	<form action="<?php echo $controllerCoreAction->getUrl('add','vendor',null,true) ?>" method="POST">
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
			<th> Update </th>
			<th> Delete </th>
		</tr>
		<?php if($vendors):
			foreach ($vendors as $vendor): ?>
				 
				<tr>
		      		<td><?php echo $vendor->vendorId ?></td>
		    		<td><?php echo $vendor->firstName ?></td>
		    		<td><?php echo $vendor->lastName ?></td>
		    		<td><?php echo $vendor->email ?></td>
		    		<td><?php echo $vendor->mobile ?></td>
		    		<td>
				   		<?php echo $vendor->getStatus($vendor->status); ?>
			    	</td>
		    		<td> <?php echo $vendor->address ?> </td>
		    		<td><?php echo $vendor->createdAt ?></td>
		    		<td><?php echo $vendor->updatedAt ?></td>
		    		<td>
		    			<a href="<?php echo $controllerCoreAction->getUrl('edit','vendor',['id' =>  $vendor->vendorId],true) ?>">Update</a>
		    		</td>
		    		<td>
		    			<a href="<?php echo $controllerCoreAction->getUrl('delete','vendor',['id' =>  $vendor->vendorId],true) ?>">Delete</a> 
		    		</td>
		   		</tr>
		 	<?php endforeach;?>
		<?php else:?>
			<tr><td colspan='10'>No Record Available</td></tr>			
		<?php endif; ?>
 
	</table>
	
