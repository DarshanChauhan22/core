<?php $medias = $this->getMedias(); ?>	
<?php $controllerCoreAction = new Controller_Core_Action(); ?>

	

	<form action="<?php echo $controllerCoreAction->getUrl('save','product_media',null,false) ?>" method="POST" align="center">
		<input type="submit" name="update" value="UPDATE"> 
	<button ><a href="<?php echo $controllerCoreAction->getUrl('grid','product',null,false) ?>">Cancel</a></button>

		<table border=1 width=100%>
			<tr>
				<th>Image Id</th>
					<th>Image</th>
					<th>Base</th>
					<th>Thumb</th>
					<th>Small</th>
					<th>Gallary</th>
					<th>Status</th>
					<th>Remove</th>
			</tr>
			<?php if($medias): ?>
			
				<?php foreach ($medias as $media): ?>		
					<tr>
			    		<td><?php echo $media->imageId ; ?></td>
						<td><img src="<?php echo 'Media/product/' . $media->image; ?>" width="100px" height="100px" alt="image"></td>
						<td><input type="radio" name="media[base]" value="<?php echo $media->imageId?>"<?php echo ($media->base==1) ? 'checked' : '' ; ?>></td>
						<td><input type="radio" name="media[thumb]" value="<?php echo $media->imageId?>"<?php echo ($media->thumb==1) ? 'checked' : '' ;?>></td>
						<td><input type="radio" name="media[small]" value="<?php echo $media->imageId?>"<?php echo ($media->small==1) ? 'checked' : '' ;?>></td>
						<td><input type="checkbox" name="media[gallery][]" value="<?php echo $media->imageId ?>"<?php echo ($media->gallery==1) ? 'checked' : '' ; ?>></td>
						<td><input type="checkbox" name="media[status][]" value="<?php echo $media->imageId ?>"<?php echo ($media->status==1) ? 'checked' : '' ; ?>></td>
						<td><input type="checkbox" name="media[remove][]" value="<?php echo $media->imageId ?>"></td>	
			    		
			    	</tr>
			  	<?php endforeach; ?>
			<?php else: ?>
				<tr><td colspan='8'>No Record Available</td></tr>
			<?php endif; ?>
	 
		</table>
	</form>
	<br>
	<br>
	<br>
	<br>
				<form align="center" action="<?php echo $controllerCoreAction->getUrl('add','product_media',null,false) ?>" method="POST" enctype="multipart/form-data">
				<input type="file" name="image[]" value="Chouse Image" accept="image/*">
				<input type="submit" name="submit" value="Upload">
</form>


