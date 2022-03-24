<?php $paymentMethods = $this->getPaymentMethods(); ?>

		<h1 align="center"> Payment Method Information </h1>	
		<button name='Add'><a href="<?php echo $this->getUrl('add','paymentMethod',null,false) ?>">Add</a></button>
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<th>PaymentMethod Id</th>
				<th>Name</th>
				<th>Note</th>
				<th>Status</th>
				<th>Created Date</th>
				<th>Updated Date</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php if(!$paymentMethods): ?>
				<tr>
					<td colspan="17">No Record available.</td>
				</tr>
			<?php else : ?>
				<?php foreach ($paymentMethods as $paymentMethod): ?>
				<tr>
					<td><?php echo $paymentMethod->methodId;?></td>
					<td><?php echo $paymentMethod->name;?></td>
					<td><?php echo $paymentMethod->note;?></td>
					<td><?php echo $paymentMethod->getStatus($paymentMethod->status); ?></td>
					<td><?php echo $paymentMethod->createdAt;?></td>
					<td><?php echo $paymentMethod->updatedAt;?></td>
					<td><a href="<?php echo $this->getUrl('edit','paymentMethod',['id'=> $paymentMethod->methodId],false) ?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','paymentMethod',['id'=> $paymentMethod->methodId],false) ?>">Delete</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>
