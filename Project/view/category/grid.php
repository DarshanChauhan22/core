<?php $categories = $this->getCategories(); ?>
<?php $categoriepath = $this->getCategoriePath(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>
<html>
<head>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
	
  
</style>
</head>
<body>
	<div class = 'container'style="text-align: center; ">
		<h1> Category Details </h1> 
		<form action="<?php echo $controllerCoreAction->getUrl('add','category',null,true) ?>" method="POST">
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
				    			<img src="<?php echo 'Media/category/' . $row->baseImage; ?>" width="100px" height="100px" alt="image">
				    			<?php endif;?>
				    		</td>
		    				<td>
		    					<?php if(!$row->thumbImage): echo "No Image"; ?>
		    					<?php else:?>
		    					<img src="<?php echo 'Media/category/' . $row->thumbImage; ?>" width="100px" height="100px" alt="image">
		    					<?php endif;?>
		    				</td>
		    				<td>
		    					<?php if(!$row->smallImage): echo "No Image"; ?>
		    					<?php else:?>
		    					<img src="<?php echo 'Media/category/' . $row->smallImage; ?>" width="100px" height="100px" alt="image">
		    					<?php endif;?>
		    				</td>
				    		<td>
		    					<a href="<?php echo$controllerCoreAction->getUrl('grid','category_Media',['id' =>  $row->categoryId],true) ?>">Media</a>
		    				</td>
				    		<td>
				    			<a href="<?php echo$controllerCoreAction->getUrl('edit','category',['id' =>  $row->categoryId],true) ?>">Update</a>
				    		</td>
				    		<td>
				    			<a href="<?php echo$controllerCoreAction->getUrl('delete','category',['id' =>  $row->categoryId],true) ?>">Delete</a> 
				    		</td>

				   		</tr>
				  	<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td colspan='8'>No Record Available</td>
					</tr>		
				<?php endif; ?>
			</table>
		</div>	
	</div>
</body>
</html>
