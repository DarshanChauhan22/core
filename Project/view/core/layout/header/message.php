<center>
	
<?php 
$msg = Ccc::getBlock('Core_Message');
$ms = $msg->getMessages();
if($ms)
{
  	foreach ($ms as $key => $value)
  	{ 
		 print_r($value); 
	}
} 
?>

</center>