<?php require_once('Model\Core\Adapter.php'); 
	Ccc::loadClass('Controller_Core_Front');
	Ccc::loadClass('Controller_Core_Action');
	Ccc::loadClass('Model_Core_Request');
   date_default_timezone_set("Asia/Kolkata");
   $date = date('Y-m-d H:i:s');
   $controllerCoreAction = new Controller_Core_Action();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">


</head>
<body>
	<div>
		<a href="<?php echo $controllerCoreAction->getUrl('grid','category',null,true) ?>"><button type="button" class="cancel">Category</button></a>
		<a href="<?php echo $controllerCoreAction->getUrl('grid','product',null,true) ?>"><button type="button" class="cancel">Product</button></a>
		<a href="<?php echo $controllerCoreAction->getUrl('grid','customer',null,true) ?>"><button type="button" class="cancel">Customer</button></a>
		<a href="<?php echo $controllerCoreAction->getUrl('grid','admin',null,true) ?>"><button type="button" class="cancel">Admin</button></a>
		<a href="<?php echo $controllerCoreAction->getUrl('grid','config',null,true) ?>"><button type="button" class="cancel">Config</button></a><a href="<?php echo $controllerCoreAction->getUrl('grid','config',null,true) ?>"></a>
	</div>
</body>
</html>


<?php 


class Ccc
{
	protected static $front = null;

	public static function getFront()
	{
		if(!self::$front)
		{
			Ccc::loadClass('Controller_Core_Front');
			$front = new Controller_Core_Front();
			self::setFront($front);
		}
		return self::$front;
	}
	public static function setFront($front)
	{
		self::$front=$front;
		//return self::$front;
	}
	public static function loadFile($path)
	{
		require_once(getcwd().'/'.$path);
	}
	public static function loadClass($className)
	{
		$path = str_replace("_", "/", $className).'.php';
		Ccc::loadFile($path);
	}
	public static function init()
	{
		self::getFront()->init();

	}

	public static function getModel($className)
	{
		$className = 'Model_'.$className;
		self::loadClass($className);
		return new $className();
	}

	public static function getBlock($className)
	{
		$className='Block_'.$className;
		self::loadClass($className);
		return new $className();
	}
}
//$c = new Ccc();
//$c->getFront()->init();
Ccc::init();

?>