<br>
<center>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>

<div>
		<a href="<?php echo $controllerCoreAction->getUrl('grid','category',null,true) ?>"><button type="button" class="cancel">Category</button></a>
		<a href="<?php echo $controllerCoreAction->getUrl('grid','product',null,true) ?>"><button type="button" class="cancel">Product</button></a>
		<a href="<?php echo $controllerCoreAction->getUrl('grid','customer',null,true) ?>"><button type="button" class="cancel">Customer</button></a>
		<a href="<?php echo $controllerCoreAction->getUrl('grid','admin',null,true) ?>"><button type="button" class="cancel">Admin</button></a>
		<a href="<?php echo $controllerCoreAction->getUrl('grid','config',null,true) ?>"><button type="button" class="cancel">Config</button></a>
		<a href="<?php echo $controllerCoreAction->getUrl('grid','salesman',null,true) ?>"><button type="button" class="cancel">Sales Man</button></a>
		<a href="<?php echo $controllerCoreAction->getUrl('grid','page',null,true) ?>"><button type="button" class="cancel">Page</button></a>
		<a href="<?php echo $controllerCoreAction->getUrl('grid','vendor',null,true) ?>"><button type="button" class="cancel">Vendor</button></a>
</div>
</center>
<br>