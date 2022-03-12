
<?php $salesmanCustomers = $this->getsalesmanCustomers(); ?>
<?php $salesmanCustomersNo = $this->getsalesmanCustomersNot(); ?>
<?php $controllerCoreAction = new Controller_Core_Action();?>

<form action="<?php echo $controllerCoreAction->getUrl('save',null,null,false)  ?>" method="POST"> 
<table border="1" width="100%">
	<tr>
		<th>Customer ID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Action</th>
		<th>Price</th>
	</tr>
	<?php if(!$salesmanCustomers): ?>
		<tr>No Customer</tr>
	<?php else: ?>
	<?php foreach ($salesmanCustomers as $salesmanCustomer): ?>
		<tr>
			<td><?php echo $salesmanCustomer->customerId; ?></td>
			<td><?php echo $salesmanCustomer->firstName; ?></td>
			<td><?php echo $salesmanCustomer->lastName; ?></td>
			<td><?php echo $salesmanCustomer->email; ?></td>
			<td><input type="checkbox" name="salesmanCustomer[customer][]" value="" disabled></td>
			
			<td><a href="<?php echo $controllerCoreAction->getUrl('grid','customer_price',['id' => Ccc::getFront()->getRequest()->getRequest('id') , 'customerId' => $salesmanCustomer->customerId],true); ?>">Price</a></td>
		</tr>
	<?php endforeach; ?>
	<?php endif;?>
</table>
<br>
<br>
<br>
<table border="1" width="100%">
	
	<tr>
		<th>Customer ID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Action</th>
	</tr>
	<?php if(!$salesmanCustomersNo): ?>
		<tr>No Customer</tr>
	<?php else: ?>
	<?php foreach ($salesmanCustomersNo as $salesmanCustomer): ?>
		<tr>
			<td><?php echo $salesmanCustomer->customerId; ?></td>
			<td><?php echo $salesmanCustomer->firstName; ?></td>
			<td><?php echo $salesmanCustomer->lastName; ?></td>
			<td><?php echo $salesmanCustomer->email; ?></td>
			<td><input type="checkbox" name="salesmanCustomer[customerNo][]" value="<?php echo $salesmanCustomer->customerId ?>"></td>

		</tr>
	<?php endforeach; ?>
	<?php endif;?>

       <td>
        <button type="submit" name="submit" class="Registerbtn">Save </button>
        <a href="<?php echo $controllerCoreAction->getUrl('grid','salesman',null,true) ?>"><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
         
</table>
</form>