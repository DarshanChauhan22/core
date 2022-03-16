
<?php $vendors = $this->getVendors(); //print_r($vendors); die;?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>
<?php $perPageCount = $this->getPager()->getPerPageCount(); ?>


<script type="text/javascript">
	function url(ele) 
	{
		var page = ele.value;
		var pageUrl = "<?php echo $controllerCoreAction->getUrl('grid','vendor',['p' => $this->getPager()->getStart()],true) ?>&ppr="+ele.value;
		window.open(pageUrl,"_self");	
	}
</script>

		
<select name="page" id="page" onchange="url(this)">
	<?php foreach ($this->getPager()->getPerPageCountOptions() as $perPage): ?>
		<?php if($perPageCount == $perPage): ?>
		<option selected='selected' value="<?php echo $perPage; ?>"> 
			<?php echo $perPage; ?>	
			</option>
		<?php else:?>
			<option value="<?php echo $perPage; ?>"> 
			<?php echo $perPage; ?>	
			</option>
		<?php endif; ?>
	<?php endforeach; ?>
</select>

<?php if($this->getPager()->getPrev() == null):?>
<button name='Start' disabled ><a>Start</a></button>
<?php else: ?>
<button name='Start'><a href="<?php echo $controllerCoreAction->getUrl('grid','vendor',['p' => $this->getPager()->getStart()]) ?>">Start</a></button>
<?php endif;?>

<?php if($this->getPager()->getPrev() == null):?>
<button name='Prev' disabled ><a>Previous</a></button>
<?php else: ?>
<button name='Previous'><a href="<?php echo $controllerCoreAction->getUrl('grid','vendor',['p' => $this->getPager()->getPrev()]) ?>">Previous</a></button>
<?php endif;?>

<button name='Current'><a href="<?php echo $controllerCoreAction->getUrl('grid','vendor',['p' => $this->getPager()->getCurrent()]) ?>">Current</a></button>

<?php if($this->getPager()->getNext() == null):?>
<button name='next' disabled ><a>Next</a></button>
<?php else: ?>
<button name='Next'><a href="<?php echo $controllerCoreAction->getUrl('grid','vendor',['p' => $this->getPager()->getNext()]) ?>">Next</a></button>
<?php endif;?>

<?php if($this->getPager()->getNext() == null):?>
<button name='end' disabled ><a>End</a></button>
<?php else: ?>
<button name='End'><a href="<?php echo $controllerCoreAction->getUrl('grid','vendor',['p' => $this->getPager()->getEnd()]) ?>">End</a></button>
<?php endif;?>



	<h1> Vendor Details </h1> 
	<form action="<?php echo $controllerCoreAction->getUrl('add','vendor',['p' => $this->getPager()->getEnd()],false) ?>" method="POST">
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
		    			<a href="<?php echo $controllerCoreAction->getUrl('edit','vendor',['id' =>  $vendor->vendorId],false) ?>">Update</a>
		    		</td>
		    		<td>
		    			<a href="<?php echo $controllerCoreAction->getUrl('delete','vendor',['id' =>  $vendor->vendorId],false) ?>">Delete</a> 
		    		</td>
		   		</tr>
		 	<?php endforeach;?>
		<?php else:?>
			<tr><td colspan='10'>No Record Available</td></tr>			
		<?php endif; ?>
 
	</table>
	
