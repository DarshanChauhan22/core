<?php

/*class name*/
echo "<br>";
echo "<br>";
class foo {
    function name()
    {

    }
}
$bar = new foo();
echo "Its name is " , get_class($bar);

/*class exist*/
echo "<br>";
echo "<br>";
class MyClas{}
if (class_exists('MyClass')) {
    echo "class exist";}

 else {
    echo "class not exist"; 
}


/*call class*/
echo "<br>";
echo "<br>";
class a3 {
    static public function test() {
        var_dump(get_called_class());
    }
}

a3::test();


/*extend class*/
echo "<br>";
echo "<br>";
class a1 {
    static public function test() {
        var_dump(get_called_class());
    }
}

class a2 extends a1 {
}

a1::test();
a2::test();



/*method call*/
echo "<br>";
echo "<br>";
class myclass2 {
    
    function myfunc1()
    {
        return(true);
    }
    function myfunc2()
    {
        return(true);
    }
}

$class_methods = get_class_methods('myclass2');
foreach ($class_methods as $method_name) {
    echo "$method_name";
}


/*get var*/
echo "<br>";
echo "<br>";
class myclass {

    var $var1; 
    var $var2 = "xyz";
    var $var3 = 100;
}

$my_class = new myclass();

$class_vars = get_class_vars(get_class($my_class));

foreach ($class_vars as $name => $value) {
    echo "$name : $value\n";
}



/*declare class*/
echo "<br>";
echo "<br>";
class d1{}
print_r(get_declared_classes());


/*declare intefaces*/
echo "<br>";
echo "<br>";
print_r(get_declared_interfaces());



/*declare trait*/
echo "<br>";
echo "<br>";

trait FooTrait
{
}

$array = get_declared_traits();

var_dump($array);



/*declare trait
echo "<br>";
echo "<br>";
class A
{
    public $public = 1;

    protected $protected = 2;

    private $private = 3;
}

class B extends A
{
    private $private = 4;
}

$object = new B;
$object->dynamic = 5;
$object->{'6'} = 6;

var_dump(get_mangled_object_vars($object));



$arrayObject = new AO(['x' => 'y']);
$arrayObject->dynamic = 2;

var_dump(get_mangled_object_vars($arrayObject));*/

/*get object var*/
echo "<br>";
echo "<br>";
class s1 {
    private $a;
    public $b = 1;
    public $c;
    private $d;
    static $e;

    public function test() {
        
    }
}
$test = new s1;
var_dump(get_object_vars($test));



/*get parent class*/
echo "<br>";
echo "<br>";
class Dad {
    function __construct()
    {
    // implements some logic
    }
}

class Child extends Dad {
    function __construct()
    {
        echo "I'm " , get_parent_class($this) , "'s son\n";
    }
}
$doo = new child();



/*interface exist*/
echo "<br>";
echo "<br>";
interface MyInterface{

}
 class MyClass12 implements MyInterface
    {
        // Methods
    }
if (interface_exists('MyInterface')) {
   echo("exist");
}

/*isa*/
echo "<br>";
echo "<br>";
class WidgetFactory
{
  var $oink = 'moo';
}

$WF = new WidgetFactory();

if (is_a($WF, 'WidgetFactory')) {
  echo "yes, \$WF is still a WidgetFactory\n";
}


/*isa subclass*/
echo "<br>";
echo "<br>";
class WidgetFactory1
{
  var $oink = 'moo';
}

// define a child class
class WidgetFactory_Child extends WidgetFactory1
{
  var $oink = 'oink';
}

$WF = new WidgetFactory1();
$WFC = new WidgetFactory_Child();

if (is_subclass_of($WFC, 'WidgetFactory1')) {
  echo "yes, \$WFC is a subclass of WidgetFactory1\n";
} else {
  echo "no, \$WFC is not a subclass of WidgetFactory\n";
}


if (is_subclass_of('WidgetFactory_Child', 'WidgetFactory1')) {
  echo "yes, WidgetFactory_Child is a subclass of WidgetFactory\n";
} else {
  echo "no, WidgetFactory_Child is not a subclass of WidgetFactory\n";
}


/*method exist*/
echo "<br>";
echo "<br>";
$directory = new Directory('.');
var_dump(method_exists($directory,'read'));



/*property exist*/
echo "<br>";
echo "<br>";
class myClass13 {
    public $mine;
    private $xpto;
    static protected $test;

    static function test() {
        var_dump(property_exists('myClass13', 'xpto')); 
    }
}

var_dump(property_exists('myClass13', 'mine'));   
var_dump(property_exists(new myClass13, 'mine')); 
var_dump(property_exists('myClass13', 'xpto'));   
var_dump(property_exists('myClass13', 'bar'));    
var_dump(property_exists('myClass13', 'test'));  


/*trait exist*/
echo "<br>";
echo "<br>";
trait World {

    private static $instance;
    protected $tmp;

}

if ( trait_exists( 'World2' ) ) {
    echo("exist");
}
else
{echo("not exist");}


/*alise*/
echo "<br>";
echo "<br>";
class foo12 { }

class_alias('foo12', 'bar12');

$a = new foo12;
$b = new bar12;

var_dump($a);
var_dump($b);

/*enum exist*/
echo "<br>";
echo "<br>";
if (enum_exists(Suit::class)) {
    $myclass = Suit::Hearts;
}
?>