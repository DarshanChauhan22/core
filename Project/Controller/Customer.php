<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Customer extends Controller_Core_Action{
	public function gridAction()
	{
		global $adapter; 
		$query = "SELECT 
					* 
				FROM customer";
		$query2 = "SELECT address 
				FROM customer c 
					JOIN  
				address a ON c.customerId = a.customerId";

				
		$customer = $adapter-> fetchAll($query);
		$address = $adapter-> fetchAll($query2);
		
		$view = $this->getView();
		
		$view->setTemplate('view/customer/grid.php');
		$view->addData('customer',$customer);
		$view->addData('address',$address);
		$view->toHtml();
		//require_once('view/customer/grid.php');
	}

	public function addAction()
	{
		$view = $this->getView();
		
		$view->setTemplate('view/customer/add.php')->toHtml();
		
		//require_once('view/customer/add.php');
	}

	public function editAction()
	{
		global $adapter;
		$request = new Model_Core_Request();
		$getId = $request->getRequest('id');
		$query = "SELECT * FROM Customer  
			   WHERE customerId=".$getId;
		$customer = $adapter-> fetchRow($query);
		$query2 = "SELECT 
                  a.* 
                FROM 
              address a 
                JOIN 
              customer c ON a.customerId = c.customerId WHERE a.customerId =".$getId;  
		$address = $adapter-> fetchRow($query2);
		$view = $this->getView();
		
		$view->setTemplate('view/customer/edit.php');
		$view->addData('customer',$customer);
		$view->addData('address',$address);
		$view->toHtml();
		
		//require_once('view/customer/edit.php');
	}
	protected function saveCustomer()
	{
		$request = new Model_Core_Request();
		$row = $request->getPost('customer'); 
		if (!isset($row)) 
		{
			throw new Exception("Invalid Request.", 1);				
		}
					
		global $adapter;
		global $date;
		//$row = $_POST['customer'];


		if (array_key_exists('customerId', $row)) 
		{
			if(!(int)$row['customerId'])
			{
				throw new Exception("Invalid Request.", 1);
			}
			$customerId = $row["customerId"];
			$query = "UPDATE customer 
				SET firstName='".$row['firstName']."',
					lastName='".$row['lastName']."',
					email='".$row['email']."',
					mobile='".$row['mobile']."',
					status='".$row['status']."',
					updatedAt='".$date."' 
				WHERE customerId='".$customerId."'";

			$update = $adapter->update($query);
			if(!$update)
			{ 
				throw new Exception("System is unable to update.", 1);
			}
			
		}
		else{
			$query = "INSERT INTO Customer(firstName,lastName,email,mobile,status,createdAt) 	VALUES('".$row['firstName']."',
					   '".$row['lastName']."',
					   '".$row['email']."',
					   '".$row['mobile']."',
					   '".$row['status']."',
					   '".$date."')";
			$customerId=$adapter->insert($query);
			if(!$customerId)
			{	
					throw new Exception("System is unable to insert.", 1);
			}
			
		}

		return $customerId;
	
	}

	protected function saveAddress($customerId)
	{
		$request = new Model_Core_Request();
		$row = $request->getPost('address'); 
		if (!isset($row)) 
		{
			throw new Exception("Invalid Request.", 1);				
		}
		global $adapter;
		//$row = $_POST['address'];
	
	
		$billing=2;	
		$shipping=2;

		if (array_key_exists('billing', $row) && $row['billing'] == 1) 
		{
				$billing = 1;			
		}
		if (array_key_exists('shipping', $row) && $row['shipping'] == 1) 
		{
				$shipping = 1;
		}
		$addressData = $adapter->fetchRow("SELECT * FROM address WHERE customerId = $customerId");
		
		if($addressData)
		{
			$query = "UPDATE address 
				SET address='".$row['address']."',
					city='".$row['city']."',
					state='".$row['state']."',
					country='".$row['country']."',
					postalCode='".$row['postalCode']."',
					billing='".$billing."',
					shipping='".$shipping."'
				WHERE customerId='".$customerId."'";
			$update = $adapter->update($query);
			if(!$update)
			{ 

				throw new Exception("System is unable to update.", 1);
			}
		}
		else
		{
			$query = "INSERT INTO address(customerId,address,city,state,country,postalCode,billing,shipping) 		
				VALUES($customerId,
					   '".$row['address']."',
					   '".$row['city']."',
					   '".$row['state']."',
					   '".$row['country']."',
					   '".$row['postalCode']."',
					   '".$billing."',
					   '".$shipping."')";
			$result=$adapter->insert($query);
			if (!$result) 
			{
				throw new Exception("System is unable to insert", 1);
			}
		}	
	}

	public function saveAction()
	{
		try
		{
			$customerId = $this->saveCustomer();
			$this->saveAddress($customerId);
			$this->redirect('index.php?c=customer&a=grid');
		} 
		catch (Exception $e) 
		{
			$this->redirect('index.php?c=customer&a=grid');
		}
	}

	public function deleteAction()
	{
		$request = new Model_Core_Request();
		try {
			$getId = $request->getRequest('id'); 
			if (!isset($getId)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			
			global $adapter;
			//$id=$_GET['id'];
			$query = "DELETE FROM Customer WHERE customerId = ".$getId;
			$delete = $adapter->delete($query); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->redirect('index.php?c=customer&a=grid');	
				
		} catch (Exception $e) {
			$this->redirect('Customer.php?a=gridAction');	
			//echo $e->getMessage();
		}

		
	}

	public function redirect($url)
	{
	
		header('location:'.$url);	
		exit();			
	}

	public function errorAction()
	{
		echo "error";
	}
}
?>