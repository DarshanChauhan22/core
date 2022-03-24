<?php $shippingMethods = $this->getShippingMethods(); ?>

		<h1 align="center"> Shipping Method Information </h1>	
		<button name='Add'><a href="<?php echo $this->getUrl('add','shippingMethod',null,false) ?>">Add</a></button>
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<th>ShippingMethod Id</th>
				<th>Name</th>
				<th>Note</th>
				<th>Price</th>
				<th>Status</th>
				<th>Created Date</th>
				<th>Updated Date</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php if(!$shippingMethods): ?>
				<tr>
					<td colspan="17">No Record available.</td>
				</tr>
			<?php else : ?>
				<?php foreach ($shippingMethods as $shippingMethod): ?>
				<tr>
					<td><?php echo $shippingMethod->methodId;?></td>
					<td><?php echo $shippingMethod->name;?></td>
					<td><?php echo $shippingMethod->note;?></td>
					<td><?php echo $shippingMethod->price;?></td>
					<td><?php echo $shippingMethod->getStatus($shippingMethod->status); ?></td>
					<td><?php echo $shippingMethod->createdAt;?></td>
					<td><?php echo $shippingMethod->updatedAt;?></td>
					<td><a href="<?php echo $this->getUrl('edit','shippingMethod',['id'=> $shippingMethod->methodId],false) ?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','shippingMethod',['id'=> $shippingMethod->methodId],false) ?>">Delete</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>
