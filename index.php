<?php require_once('Model\Core\Adapter.php'); 
	Ccc::loadClass('Controller_Core_Front');
	Ccc::loadClass('Model_Core_Request');
   date_default_timezone_set("Asia/Kolkata");
   $date = date('Y-m-d H:i:s');
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">


</head>
<body>
	<div class='index'>
		<a href="index.php?c=category&a=grid"><button type="button" class="cancel">Category</button></a>
		<a href="index.php?c=product&a=grid"><button type="button" class="cancel">Product</button></a>
		<a href="index.php?c=customer&a=grid"><button type="button" class="cancel">Customer</button></a>
		<a href="index.php?c=admin&a=grid"><button type="button" class="cancel">Admin</button></a>
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
}
//$c = new Ccc();
//$c->getFront()->init();
Ccc::init();

?>