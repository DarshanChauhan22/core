<?php $salesmans = $this->getSalesmans(); ?>
<?php $perPageCount = $this->getPager()->getPerPageCount(); ?>


<script type="text/javascript">
	function url(ele) 
	{
		var page = ele.value;
		var pageUrl = "<?php echo $this->getUrl('grid','salesman',['p' => $this->getPager()->getStart()],true) ?>&ppr="+ele.value;
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
<button name='Start'><a href="<?php echo $this->getUrl('grid','salesman',['p' => $this->getPager()->getStart()]) ?>">Start</a></button>
<?php endif;?>

<?php if($this->getPager()->getPrev() == null):?>
<button name='Prev' disabled ><a>Previous</a></button>
<?php else: ?>
<button name='Previous'><a href="<?php echo $this->getUrl('grid','salesman',['p' => $this->getPager()->getPrev()]) ?>">Previous</a></button>
<?php endif;?>

<button name='Current'><a href="<?php echo $this->getUrl('grid','salesman',['p' => $this->getPager()->getCurrent()]) ?>">Current</a></button>

<?php if($this->getPager()->getNext() == null):?>
<button name='next' disabled ><a>Next</a></button>
<?php else: ?>
<button name='Next'><a href="<?php echo $this->getUrl('grid','salesman',['p' => $this->getPager()->getNext()]) ?>">Next</a></button>
<?php endif;?>

<?php if($this->getPager()->getNext() == null):?>
<button name='end' disabled ><a>End</a></button>
<?php else: ?>
<button name='End'><a href="<?php echo $this->getUrl('grid','salesman',['p' => $this->getPager()->getEnd()]) ?>">End</a></button>
<?php endif;?>



	<h1> salesman Details </h1> 
	<form action="<?php echo $this->getUrl('add','salesman',['p' => $this->getPager()->getEnd()],false) ?>" method="POST">
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
			    			<a href="<?php echo$this->getUrl('grid','salesman_customer',['id' =>  $salesman->salesmanId],true) ?>">Customer</a>
			    		</td>
			    		<td><?php echo $salesman->createdAt ?></td>
			    		<td><?php echo $salesman->updatedAt ?></td>
			    		<td>
			    			<a href="<?php echo$this->getUrl('edit','salesman',['id' =>  $salesman->salesmanId],false) ?>">Update</a>
			    		</td>
			    		<td>
			    			<a href="<?php echo$this->getUrl('delete','salesman',['id' =>  $salesman->salesmanId],false) ?>">Delete</a> 
			    		</td>
			   		</tr>
			 	<?php endforeach;?>
			<?php else:?>
				<tr><td colspan='10'>No Record Available</td></tr>			
			<?php endif; ?>
		</table>

