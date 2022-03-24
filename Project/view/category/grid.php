<?php $categories = $this->getCategories(); ?>
<?php $categoriepath = $this->getCategoriePath(); //print_r($categoriepath); die;?>
<?php $perPageCount = $this->getPager()->getPerPageCount(); ?>
<?php $mediaModel = Ccc::getModel('Category_Media')?>

<script type="text/javascript">
	function url(ele) 
	{
		var page = ele.value;
		var pageUrl = "<?php echo $this->getUrl('grid','category',['p' => $this->getPager()->getStart()],true) ?>&ppr="+ele.value;
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
<button name='Start'><a href="<?php echo $this->getUrl('grid','category',['p' => $this->getPager()->getStart()]) ?>">Start</a></button>
<?php endif;?>

<?php if($this->getPager()->getPrev() == null):?>
<button name='Prev' disabled ><a>Previous</a></button>
<?php else: ?>
<button name='Previous'><a href="<?php echo $this->getUrl('grid','category',['p' => $this->getPager()->getPrev()]) ?>">Previous</a></button>
<?php endif;?>

<button name='Current'><a href="<?php echo $this->getUrl('grid','category',['p' => $this->getPager()->getCurrent()]) ?>">Current</a></button>

<?php if($this->getPager()->getNext() == null):?>
<button name='next' disabled ><a>Next</a></button>
<?php else: ?>
<button name='Next'><a href="<?php echo $this->getUrl('grid','category',['p' => $this->getPager()->getNext()]) ?>">Next</a></button>
<?php endif;?>

<?php if($this->getPager()->getNext() == null):?>
<button name='end' disabled ><a>End</a></button>
<?php else: ?>
<button name='End'><a href="<?php echo $this->getUrl('grid','category',['p' => $this->getPager()->getEnd()]) ?>">End</a></button>
<?php endif;?>



	
		<h1> Category Details </h1> 
		<form action="<?php echo $this->getUrl('add','category',null,false) ?>" method="POST">
			<button type="submit" name="Add" class="Registerbtn"> Add New </button>
		</form>

		<div id='info'>
			<table border=1 width=100%>
				<tr width=100px>
					<th> Id </th>
				
					<th> Category Name </th>
					<th> Created At </th>
					<th> Updated At </th>
					<th> Status </th>
					<th> Base </th>
					<th> Thumb </th>
					<th> Small </th>
					<th> Media </th>
					<th> Updatet </th>
					<th> Delete </th>
				</tr>
				<?php if($categories): ?>
					<?php foreach ($categories as $row):?>
						<tr>
				    		<td><?php echo $row->categoryId ?></td>
				    		<td><?php echo $categoriepath[$row->categoryId];?>	
				    		<td><?php echo $row->createdAt ?></td>
				    		<td><?php echo $row->updatedAt ?></td>
				    		<td>
				    		<?php echo $row->getStatus($row->status); ?>
			    		</td>
				    		<td>
				    			<?php if(!$row->baseImage): echo "No Image"; ?>
		    					<?php else:?>
				    			<img src="<?php echo $mediaModel->getImageUrl() . $row->baseImage; ?>" width="100px" height="100px" alt="image">
				    			<?php endif;?>
				    		</td>
		    				<td>
		    					<?php if(!$row->thumbImage): echo "No Image"; ?>
		    					<?php else:?>
		    					<img src="<?php echo $mediaModel->getImageUrl() . $row->thumbImage; ?>" width="100px" height="100px" alt="image">
		    					<?php endif;?>
		    				</td>
		    				<td>
		    					<?php if(!$row->smallImage): echo "No Image"; ?>
		    					<?php else:?>
		    					<img src="<?php echo $mediaModel->getImageUrl() . $row->smallImage; ?>" width="100px" height="100px" alt="image">
		    					<?php endif;?>
		    				</td>
				    		<td>
		    					<a href="<?php echo$this->getUrl('grid','category_Media',['id' =>  $row->categoryId],false) ?>">Media</a>
		    				</td>
				    		<td>
				    			<a href="<?php echo$this->getUrl('edit','category',['id' =>  $row->categoryId],false) ?>">Update</a>
				    		</td>
				    		<td>
				    			<a href="<?php echo$this->getUrl('delete','category',['id' =>  $row->categoryId],false) ?>">Delete</a> 
				    		</td>

				   		</tr>
				  	<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td colspan='8'>No Record Available</td>
					</tr>		
				<?php endif; ?>
			</table>
		
