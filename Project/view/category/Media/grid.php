<?php $medias = $this->getMedias(); print_r($medias)?>	
<?php $id= $_GET['id'];?>	
<?php $mediaModel = Ccc::getModel('Category_Media')?>


	<form action="<?php echo $this->getUrl('save','category_media',['id' => $id],true) ?>" method="POST" align="center">
		<input class="btn btn-success" type="submit" name="update" value="UPDATE"> 
	<button class="btn btn-primary"  ><a href="<?php echo $this->getUrl('gridBlock','category',['id' => null]) ?>">Cancel</a></button>

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
						<td><img src="<?php echo $mediaModel->getImageUrl() . $media->image; ?>" width="100px" height="100px" alt="image"></td>
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
				<!-- <form align="center" action="<?php //echo $this->getUrl('add','category_media',null,false) ?>" method="POST" enctype="multipart/form-data"> -->
				<input type="file" name="image[]" id="fileToupload" class="fileToupload form-control" accept="image/*">
				<button type="submit" onclick="uploadFile()">Uploads</button>
				<!-- <input type="submit" onclick="uploadFile()" value="Upload" > -->
</form>

<script type="text/javascript">
	
	function uploadFile() {
		alert(123);
		var file_data = $('.fileToupload').prop('files')[0];
		var form_data = new FormData();
		form_data.append("file","file_data");
		$.ajax({
			url : "<?php echo $this->getUrl('add','category_media',null,false) ?>",
			type : "POST",
			dataType : "script",
			cache : false,
			contentType : false,
			processData : false,
			data : form_date,

			success:function(dat2){
				if(dat2==1) alert("success");
				else alert("un");
			}
		});
	}
</script>
