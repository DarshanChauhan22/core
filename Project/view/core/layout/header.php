<?php $action = new Controller_Core_Action();
$header = $action->getLayout()->getHeader();
$menuGrid = Ccc::getBlock("Core_Layout_Header_Menu");
$header->addChild($menuGrid);
$message = Ccc::getBlock("Core_Message");
$header->addChild($message);?>

 <?php foreach ($header->getChildren() as $key => $child): 
 $child->toHtml(); ?>
<?php endforeach; ?>