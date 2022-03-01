<?php $admins = $this->getAdmins(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>


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
				<th> Status </th>
				<th> Create Date </th>
				<th> Update Date </th>
				<th> Update </th>
				<th> Delete </th>
			</tr>
			<?php if($admins):
				foreach ($admins as $admin): ?>
					<tr>
			      		<td><?php echo $admin->adminId ?></td>
			    		<td><?php echo $admin->firstName ?></td>
			    		<td><?php echo $admin->lastName ?></td>
			    		<td><?php echo $admin->email ?></td>
			    		<td><?php echo $admin->password ?></td>
			    		
			    		<td>
				    		<?php echo $admin->getStatus($admin->status); ?>
			    		</td>
			    		</td>
			    		<td><?php echo $admin->createdAt ?></td>
			    		<td><?php echo $admin->updatedAt ?></td>
			    		<td>
			    			<a href="<?php echo$controllerCoreAction->getUrl('edit','admin',['id' =>  $admin->adminId],true) ?>">Update</a>
			    		</td>
			    		<td>
			    			<a href="<?php echo$controllerCoreAction->getUrl('delete','admin',['id' =>  $admin->adminId],true) ?>">Delete</a> 
			    		</td>
			   		</tr>
			 	<?php endforeach;?>
			<?php else:?>
				<tr><td colspan='10'>No Record Available</td></tr>			
			<?php endif; ?>
		</table>
	</div>
