<?php $products = $this->getProducts(); ?>	
<?php $controllerCoreAction = new Controller_Core_Action(); ?>

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
			<th> Sku </th>
			<th> Created_At </th>
			<th> Updated_At </th>
			<th> Status </th>
			<th> Base </th>
			<th> Thumb </th>
			<th> Small </th>
			<th> Media </th>
			<th> Update </th>
			<th> Delete </th>
			
		</tr>
		<?php if($products): ?>
		
			<?php foreach ($products as $product): ?>		
				<tr>
		    		<td><?php echo $product->productId ?></td>
		    		<td><?php echo $product->name ?></td>
		    		<td><?php echo $product->price ?></td>
		    		<td><?php echo $product->quantity ?></td>
		    		<td><?php echo $product->sku ?></td>
		    		
		    		<td><?php echo $product->createdAt ?></td>
		    		<td><?php echo $product->updatedAt ?></td>
		    		<td>
				    		<?php echo $product->getStatus($product->status); ?>
			    	</td>

		    		<td>
		    			<?php if(!$product->baseImage): echo "No Image"; ?>
		    			<?php else:?><img src="<?php echo 'Media/product/' . $product->baseImage; ?>" width="100px" height="100px">
		    		<?php endif;?>
		    		</td>
		    		<td>
		    			<?php if(!$product->thumbImage): echo "No Image"; ?>
		    			<?php else:?>
		    			<img src="<?php echo 'Media/product/' . $product->thumbImage; ?>" width="100px" height="100px" alt="image">
		    			<?php endif;?>
		    		</td>
		    		<td>
		    			<?php if(!$product->smallImage): echo "No Image"; ?>
		    			<?php else:?>
		    			<img src="<?php echo 'Media/product/' . $product->smallImage; ?>" width="100px" height="100px" alt="image">
		    			<?php endif;?>
		    		</td>
		    		<td>
		    			<a href="<?php echo$controllerCoreAction->getUrl('grid','product_Media',['id' =>  $product->productId],true) ?>">Media</a>
		    		</td>
		    		<td>
		    			<a href="<?php echo$controllerCoreAction->getUrl('edit','product',['id' =>  $product->productId],true) ?>">Update</a>
		    		</td>
		    		<td>
		    			<a href="<?php echo$controllerCoreAction->getUrl('delete','product',['id' =>  $product->productId],true) ?>">Delete</a> 
		    		</td>
		    		
		    	</tr>
		  	<?php endforeach; ?>
		<?php else: ?>
			<tr><td colspan='8'>No Record Available</td></tr>
		<?php endif; ?>
 
	</table>
	</div>
