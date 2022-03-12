<?php $salesmans = $this->getsalesmans(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>


	<h1> salesman Details </h1> 
	<form action="<?php echo $controllerCoreAction->getUrl('add','salesman',null,true) ?>" method="POST">
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
				<th> Percentage </th>
				<th> Customer </th>
				<th> Create Date </th>
				<th> Update Date </th>
				<th> Update </th>
				<th> Delete </th>
			</tr>
			<?php if($salesmans):
				foreach ($salesmans as $salesman): ?>
					<tr>
			      		<td><?php echo $salesman->salesmanId ?></td>
			    		<td><?php echo $salesman->firstName ?></td>
			    		<td><?php echo $salesman->lastName ?></td>
			    		<td><?php echo $salesman->email ?></td>
			    		<td><?php echo $salesman->mobile ?></td>
			    		
			    		<td>
				    		<?php echo $salesman->getStatus($salesman->status); ?>
			    		</td>
			    		</td>
			    		<td><?php echo $salesman->percentage ?></td>
			    		<td>
			    			<a href="<?php echo$controllerCoreAction->getUrl('grid','salesman_customer',['id' =>  $salesman->salesmanId],true) ?>">Customer</a>
			    		</td>
			    		<td><?php echo $salesman->createdAt ?></td>
			    		<td><?php echo $salesman->updatedAt ?></td>
			    		<td>
			    			<a href="<?php echo$controllerCoreAction->getUrl('edit','salesman',['id' =>  $salesman->salesmanId],true) ?>">Update</a>
			    		</td>
			    		<td>
			    			<a href="<?php echo$controllerCoreAction->getUrl('delete','salesman',['id' =>  $salesman->salesmanId],true) ?>">Delete</a> 
			    		</td>
			   		</tr>
			 	<?php endforeach;?>
			<?php else:?>
				<tr><td colspan='10'>No Record Available</td></tr>			
			<?php endif; ?>
		</table>

