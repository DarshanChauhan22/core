<?php
Ccc::loadClass('Model_Core_View');
Ccc::loadClass('Model_Core_Request');


class Controller_Core_Action{
	
	
	public $view = null;

	public function getAdapter()
    {
        global $adapter;
        return $adapter;
    }
	
	public function redirect($url)
	{
		header('location:'.$url);	
		exit();			
	}

	public function setView($view)
	{
		$this->view = $view;
		return $this;
	}

	public function getView()
	{
		if(!$this->view){
			$this->setView(new Model_Core_View);
		}
		return $this->view;
	}

	public function getRequest()
	{
		return Ccc::getFront()->getRequest();
		//var_dump($a);
		//exit();
	}
	public function getUrl($action=null,$controller=null,array $parameters=null,$resetParam=false)
    {
    	echo '<pre>';
    				$uri = $_SERVER['REQUEST_URI'];
					$query_str = parse_url($uri, PHP_URL_QUERY);
					parse_str($query_str, $query_params);
					//print_r($query_params); // cur url  in arry
					//print_r($query_str);  //cur url in string


					$arr = [
					    'c' => $controller,
					    'a' => $action,
					];
					$c5 = http_build_query($arr); 


					$ad = array_merge($query_params,$arr);
					$c4 = http_build_query($ad);                //c a cur url
					//echo $c4;
					//exit();


					$abc = array_merge($arr,$parameters);  
					$c3 = http_build_query($abc);               // c a parameter
					//echo $c3;


					$var = array_merge($query_params,$abc);
					//print_r($var);						     // all
					$c1 = http_build_query($var);
						
				
    	if($action!=null)
    	{
    		if($controller!=null)
    		{
    			if($parameters!=null)
    			{
    				echo $c1;
    				exit();
    			}echo $c4;
    			exit();
    		}echo $c5;
    		exit();
    	}
		echo $query_str;
		exit();


       /*
        //print_r($parameters);
       //$c1 = http_build_query($arr);
       //$c2 = http_build_query($parameters); 
       //print_r($url1 = $c1 . '&' . $c2);
       
    /* 
        $action = null;
        $controller = null;
        $parameters = [];

    */
       // $resetParam = false;
    
}
}
?>