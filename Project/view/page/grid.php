<?php $pages = $this->getPages(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>

<html>
<head>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
	
</head>
<body>
	<div class='container' style="text-align: center; ">
	<h1> Page Details </h1> 
	<form action="<?php echo $controllerCoreAction->getUrl('add','page',null,true) ?>" method="POST">
		<button type="submit" name="Add" class="Registerbtn"> Add New </button>
	</form>

	<div id='info'>
		<table border=1 width=100%>
			<tr>
				<th> Id </th>
				<th> Name </th>
				<th> Code </th>
				<th> Content </th>
				<th> Status </th>
				<th> Create Date </th>
				<th> Update Date </th>
				<th> Update </th>
				<th> Delete </th>
			</tr>
			<?php if($pages):
				foreach ($pages as $page): ?>
					<tr>
			      		<td><?php echo $page->pageId ?></td>
			    		<td><?php echo $page->name ?></td>
			    		<td><?php echo $page->code ?></td>
			    		<td><?php echo $page->content ?></td>
			    		
			    		<td>
				    		<?php echo $page->getStatus($page->status); ?>
			    		</td>
			    		</td>
			    		<td><?php echo $page->createdAt ?></td>
			    		<td><?php echo $page->updatedAt ?></td>
			    		<td>
			    			<a href="<?php echo$controllerCoreAction->getUrl('edit','page',['id' =>  $page->pageId],true) ?>">Update</a>
			    			</td>
			    			<td> 
			    			<a href="<?php echo$controllerCoreAction->getUrl('delete','page',['id' =>  $page->pageId],true) ?>">Delete</a>
			    		</td>
			   		</tr>
			 	<?php endforeach;?>
			<?php else:?>
				<tr><td colspan='10'>No Record Available</td></tr>			
			<?php endif; ?>
		</table>
	</div>
</body>
</html>