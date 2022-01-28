<?php

/*revers*/
$a=array("a"=>"Volvo","b"=>"BMW","c"=>"Toyota");
print_r(array_reverse($a));

/*combine*/
echo "<br>";
echo "<br>";
$a1=array("red","green");
$a2=array("blue","yellow");
print_r(array_merge($a1,$a2));

/*flip*/
echo "<br>";
echo "<br>";
$a3=array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");
print_r(array_flip($a3));

/*key exist*/
echo "<br>";
echo "<br>";
$a4=array("Volvo"=>"XC90","BMW"=>"X5");
if (array_key_exists("Volvo",$a4))
  {
  echo "Key exists";
  }
else
  {
  echo "Key does not exist";
  }

/*show key name*/
echo "<br>";
echo "<br>";
$a5=array("Volvo"=>"XC90","BMW"=>"X5","Toyota"=>"Highlander");
print_r(array_keys($a5));

/*pop*/
echo "<br>";
echo "<br>";
$a6=array("red","green","blue");
;
print_r(array_pop($a6));

/*product*/
echo "<br>";
echo "<br>";
$a=array(5,3);
echo(array_product($a));

/*push*/
echo "<br>";
echo "<br>";
$a=array("red","green");
array_push($a,"blue","yellow","black");
print_r($a);

/*replace*/
echo "<br>";
echo "<br>";
$a1=array("red","green");
$a2=array("blue","yellow");
print_r(array_replace($a1,$a2));

/*search*/
echo "<br>";
echo "<br>";
$a=array("a"=>"red","b"=>"green","c"=>"blue");
echo array_search("red",$a);

/*shift*/
echo "<br>";
echo "<br>";
$a=array("a"=>"red","b"=>"green","c"=>"blue");
array_shift($a);
print_r ($a);

/*slice*/
echo "<br>";
echo "<br>";
$a=array("red","green","blue","yellow","brown");
print_r(array_slice($a,3));

/*splice*/
echo "<br>";
echo "<br>";
$a1=array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");
$a2=array("a"=>"purple","b"=>"orange","c"=>"black");
array_splice($a1,0,3,$a2);
print_r($a1);

/*sum*/
echo "<br>";
echo "<br>";
$a=array(5,5,5);
echo array_sum($a);

/*arsort*/
echo "<br>";
echo "<br>";
$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
arsort($age);
print_r($age);

/*asort*/
echo "<br>";
echo "<br>";
$age=array("Peter"=>"37","Ben"=>"36","Joe"=>"33");
asort($age);
print_r($age);

/*count*/
echo "<br>";
echo "<br>";
$cars=array("Volvo","BMW","Toyota");
echo count($cars);

/*current*/
echo "<br>";
echo "<br>";
$people = array("Peter", "Joe", "Glenn", "Cleveland");
echo current($people);

/*each*/
echo "<br>";
echo "<br>";
$people = array("Peter", "Joe", "Glenn", "Cleveland");
print_r (each($people));

/*end*/
echo "<br>";
echo "<br>";
$people = array("Peter", "Joe", "Glenn", "Cleveland");
echo end($people);

/*krsort*/
echo "<br>";
echo "<br>";
$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
krsort($age);
print_r($age);

/*ksort*/
echo "<br>";
echo "<br>";
$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
ksort($age);
print_r($age);
?>