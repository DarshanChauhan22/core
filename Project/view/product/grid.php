<?php $products = $this->getProducts(); ?>	
<?php $controllerCoreAction = new Controller_Core_Action(); ?>
<html>
<head>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
	
</head>
<body>
	<div class='container' style="text-align: center; ">
	<h1> Product Details </h1> 
	<form action="<?php echo $controllerCoreAction->getUrl('add','product',null,true) ?>" method="POST">
		<button type="submit" name="Add" class="Registerbtn"> Add New </button>
	</form>
	
	<div id='info'>
	<table border=1 width=100%>
		<tr>
			<th> Id </th>
			<th> Name </th>
			<th> Price </th>
			<th> Quantity </th>
			<th> Created_At </th>
			<th> Updated_At </th>
			<th> Status </th>
			<th> Action </th>
			<th> Media </th>
		</tr>
		<?php if($products): ?>
		
			<?php foreach ($products as $product): ?>		
				<tr>
		    		<td><?php echo $product->productId ?></td>
		    		<td><?php echo $product->name ?></td>
		    		<td><?php echo $product->price ?></td>
		    		<td><?php echo $product->quantity ?></td>
		    		<td><?php echo $product->createdAt ?></td>
		    		<td><?php echo $product->updatedAt ?></td>
		    		<td>
			    		<?php if ($product->status == 1):
			    			echo ' Active ';
			    		else:
			    			echo ' InActive ';
			    		endif; ?>
		    		</td>
		    		<td>
		    			<a href="<?php echo$controllerCoreAction->getUrl('delete','product',['id' =>  $product->productId],true) ?>">Delete</a> 
		    			<a href="<?php echo$controllerCoreAction->getUrl('edit','product',['id' =>  $product->productId],true) ?>">Update</a>
		    		</td>
		    		<td>
		    			<a href="<?php echo$controllerCoreAction->getUrl('edit','product_Media',['id' =>  $product->productId],true) ?>">Media</a>
		    		</td>
		    	</tr>
		  	<?php endforeach; ?>
		<?php else: ?>
			<tr><td colspan='8'>No Record Available</td></tr>
		<?php endif; ?>
 
	</table>
	</div>
</body>
</html>