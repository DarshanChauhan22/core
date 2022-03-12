<?php $action = new Controller_Core_Action();?>
<?php 

    $header = $action->getLayout()->getHeader();
    $menuGrid = Ccc::getBlock("Core_Layout_Header_Menu");
    $header->addChild($menuGrid);
    $message = Ccc::getBlock("Core_Message");
    $header->addChild($message);?>

    <?php foreach ($header->getChildren() as $key => $child): 
     echo $child->toHtml(); ?>
    <?php endforeach; ?>