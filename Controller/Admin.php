<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Admin');
Ccc::loadClass('Model_Core_Request');


class Controller_Admin extends Controller_Core_Action{
	
	public function testAction()
	{
		$adminTable = new Model_Admin(); 
		$adminTable->setTableName('admin');
		$adminTable->setPrimaryKey('adminId');

		
		/*$adminTable->insert(['firstName' => 'fgf' , 'lastName' => 'kghg' , 'email' => 'kjkb.com' ,'password' => 'akkkbc' , 'status' => '1' ]);
        exit();*/
		/*$adminTable->update(['firstName' => 'mmmf' , 'lastName' => 'mmhg' , 'email' => 'mmkb.com' ,'password' => 'mmmkkbc' , 'status' => '1'],['adminId' => 8]);*/
		//$adminTable->delete(['adminId' => '6']);
		
		$adminTable->fetchRow("select * from admin where adminId = 7");
        //$adminTable->fetchAll("select * from admin");
	}
	public function gridAction()
	{
		global $adapter; 
		$query = "SELECT 
					* 
				FROM Admin";
		$admin = $adapter-> fetchAll($query);
		$view = $this->getView();
		$view->setTemplate('view/admin/grid.php');
		$view->addData('admin',$admin);
		$view->toHtml();
		//require_once('view/admin/grid.php');
	}

	public function addAction()
	{
		$view = $this->getView();
		$view->setTemplate('view/admin/add.php')->toHtml();
		
		//require_once('view/admin/add.php');
	}

	public function editAction()
	{
		global $adapter;
		$request = new Model_Core_Request();
		$getId = $request->getRequest('id');
      	$query = "SELECT * FROM Admin  
            WHERE adminId=".$getId;
      	$admin = $adapter-> fetchRow($query);
      	$view = $this->getView();
		$view->setTemplate('view/admin/edit.php');
		$view->addData('admin',$admin);
		$view->toHtml();
		//require_once('view/admin/edit.php');
	}
	
	public function saveAction()
	{
		$request = new Model_Core_Request();
		try
		{
			$row = $request->getPost('admin'); 
			if (!isset($row)) {
				throw new Exception("Invalid Request.", 1);				
			}			
			global $adapter;
			global $date;
			//$request = new Model_Core_Request();
			//$row = $request->getPost('admin');
			//$row = $_POST['admin'];

			if (array_key_exists('adminId', $row)) {
				if(!(int)$row['adminId']){
					throw new Exception("Invalid Request.", 1);
				}
				$adminId = $row["adminId"];
				$query = "UPDATE Admin 
					SET firstName='".$row['firstName']."',
						lastName='".$row['lastName']."',
						email='".$row['email']."',
						password='".$row['password']."',
						mobile='".$row['mobile']."',
						status='".$row['status']."',
						updatedAt='".$date."' 
					WHERE adminId='".$adminId."'";

				$update = $adapter->update($query);

				if(!$update){ 
					throw new Exception("System is unable to update.", 1);
				}
				
			}
			else{
				if($row['password'] !=$row['confirmPassword'])
				{
					throw new Exception("password must be same.", 1);

				}
				$query = "INSERT INTO admin(firstName,lastName,email,password,mobile,status,createdAt) 	
				VALUES('".$row['firstName']."',
						   '".$row['lastName']."',
						   '".$row['email']."',
						   '".$row['password']."',
						   '".$row['mobile']."',
						   '".$row['status']."',
						   '".$date."')";
				$adminId=$adapter->insert($query);
				if(!$adminId)
				{	
						throw new Exception("System is unable to insert.", 1);
				}
				
			}
			$this->redirect('index.php?c=admin&a=grid');
		} 
		catch (Exception $e) 
		{
			$this->redirect('index.php?c=admin&a=grid');
		}
	}

	public function deleteAction()
	{
		$request = new Model_Core_Request();
		try 
		{	
			$getId = $request->getRequest('id'); 
			if (!isset($getId)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			
			global $adapter;
			$query = "DELETE FROM Admin WHERE adminId = ".$getId;
			$delete = $adapter->delete($query); 
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$this->redirect('index.php?c=admin&a=grid');	
				
		} catch (Exception $e) {
			$this->redirect('admin.php?a=gridAction');	
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
		echo "errorAction";
	}
}
?>