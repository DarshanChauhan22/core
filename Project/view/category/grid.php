<?php
	$categories = $this->getCategories();
	$categoriepath = $this->getCategoriePath();

	//$result = $this->getData('category');
	//$getCategoryToPath = $this->getData('getCategoryToPath');
		$controllerCoreAction = new Controller_Core_Action();
?>
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
				<tr>
					<th> Id </th>
				
					<th> Category Name </th>
					<th> Created At </th>
					<th> Updated At </th>
					<th> Status </th>
					<th> Action </th>
				</tr>
				<?php if($categories): ?>
					<?php foreach ($categories as $row):?>
						<tr>
				    		<td><?php echo $row["categoryId"] ?></td>
				    			
				    		<td><?php echo $categoriepath[$row['categoryId']];?>	
				    		<td><?php echo $row["createdAt"] ?></td>
				    		<td><?php echo $row["updatedAt"] ?></td>
				    		<td>
					    		<?php if ($row["status"] == 1): 
					    			echo ' Active ';
					    		else:
					    			echo ' InActive ';
					    		endif;?>
				    		</td>

				    		<td>
				    			<a href="<?php echo$controllerCoreAction->getUrl('delete','category',['id' =>  $row['categoryId']],true) ?>">Delete</a> 
				    			<a href="<?php echo$controllerCoreAction->getUrl('edit','category',['id' =>  $row['categoryId']],true) ?>">Update</a>
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
