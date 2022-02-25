<?php $configs = $this->getconfigs(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>

<html>
<head>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
	
</head>
<body>
	<div class='container' style="text-align: center; ">
	<h1> Config Details </h1> 
	<form action="<?php echo $controllerCoreAction->getUrl('add','config',null,true) ?>" method="POST">
		<button type="submit" name="Add" class="Registerbtn"> Add New </button>
	</form>

	<div id='info'>
		<table border=1 width=100%>
			<tr>
				<th> Id </th>
				<th> Name </th>
				<th> Code </th>
				<th> Value </th>
				<th> Status </th>
				<th> Create Date </th>
				<th> Action </th>
			</tr>
			<?php if($configs):
				foreach ($configs as $config): ?>
					<tr>
			      		<td><?php echo $config->configId ?></td>
			    		<td><?php echo $config->name; ?></td>
			    		<td><?php echo $config->code; ?></td>
			    		<td><?php echo $config->value; ?></td>
			    		
			    		
			    		<td>
				    		<?php if ($config->status == 1):
				    			echo 'Active';
				    		else:
				    			echo 'InActive';
				    		endif; ?>
			    		</td>
			    		<td><?php echo $config->createdAt; ?></td>
			    		
			    		<td>
			    			<a href="<?php echo$controllerCoreAction->getUrl('delete','config',['id' =>  $config->configId],true) ?>">Delete</a> 
			    			<a href="<?php echo$controllerCoreAction->getUrl('edit','config',['id' =>  $config->configId],true) ?>">Update</a>
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