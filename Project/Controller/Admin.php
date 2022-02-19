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
		
		//$adminTable->fetchRow("select * from admin where adminId = 7");
        //$adminTable->fetchAll("select * from admin");
	}
	public function gridAction()
	{
		Ccc::getBlock('Admin_grid')->toHtml();
		//index.php?c=category&a=grid&id=5&tab=menu

        //$this->getUrl(); //index.php?c=category&a=grid&id=5&tab=menu
        //$this->getUrl('save'); //index.php?c=category&a=save&id=5&tab=menu
        //$this->getUrl('save','admin'); //index.php?c=admin&a=save&id=5&tab=menu
        //$this->getUrl('save','category',['id' => 10]); //index.php?c=category&a=save&id=10&tab=menu
        //$this->getUrl('save','category',['id' => 10,'tab' => 'hello']); //index.php?c=category&a=save&id=10&tab=hello
        //$this->getUrl('save','category',['id' => 51,'tab' => 'asd'],false); //index.php?c=category&a=save&id=5
        //$this->getUrl('save','category',null,true); //index.php?c=category&a=save
        //$this->getUrl(null,'category',null,true); //index.php?c=category&a=grid
        //$this->getUrl(null,'category',['module' => 'Admin'],true); //index.php?c=category&a=grid&module=Admin
		/*$adminTable = new Model_Admin(); 
		
		global $adapter; 
		$query = "SELECT 
					* 
				FROM Admin";
			$admin=	$adminTable->fetchAll($query);
			//$admin = $adapter-> fetchAll($query);
		$view = $this->getView();
		$view->setTemplate('view/admin/grid.php');
		$view->addData('admin',$admin);
		$view->toHtml();
		//require_once('view/admin/grid.php');
		*/
	}

	public function addAction()
	{
		Ccc::getBlock('Admin_Add')->toHtml();
		/*
		$view = $this->getView();
		$view->setTemplate('view/admin/add.php')->toHtml();
		//require_once('view/admin/add.php');
		*/
	}

	public function editAction()
	{	
		 try 
		{
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id){
				throw new Exception("Id not valid.");
			}
			$adminModel = Ccc::getModel('Admin');
			$admin = $adminModel->fetchRow("SELECT * FROM admin WHERE adminId = {$id} ");
			if(!$admin){
				throw new Exception("unable to load admin.");
			}
			Ccc::getBlock('Admin_Edit')->addData('admin',$admin)->toHtml();	
				
		} 
		catch (Exception $e) 
		{
			echo $e->getMessage();
		}


		/*
		$adminTable = new Model_Admin(); 
		//global $adapter;
		//$request = new Model_Core_Request();
		$getId = $this->getRequest()->getRequest('id');
		$query = "SELECT * FROM Admin  
            WHERE adminId=".$getId;
      	//$admin = $adapter-> fetchRow($query);
		$admin = $adminTable->fetchRow($query);
      	
      	$view = $this->getView();
		$view->setTemplate('view/admin/edit.php');
		$view->addData('admin',$admin);
		$view->toHtml();
		//require_once('view/admin/edit.php');*/
	}
	
	public function saveAction()
	{
		$adminTable = Ccc::getModel('Admin');
		//$adminTable = new Model_Admin(); 
		//$request = new Model_Core_Request();
		try
		{
			$row = $this->getRequest()->getRequest('admin');
			if (!isset($row)) {
				throw new Exception("Invalid Request.", 1);				
			}			
			//$request = new Model_Core_Request();
			//$row = $request->getPost('admin');
			//$row = $_POST['admin'];

			if (array_key_exists('adminId', $row)) {
				if(!(int)$row['adminId']){
					throw new Exception("Invalid Request.", 1);
				}
				$adminId = $row["adminId"];
				
				$update=$adminTable->update($row,['adminId' => $adminId]);
		//$adminTable->delete(['adminId' => '6']);

				/*$query = "UPDATE Admin 
					SET firstName='".$row['firstName']."',
						lastName='".$row['lastName']."',
						email='".$row['email']."',
						password='".$row['password']."',
						mobile='".$row['mobile']."',
						status='".$row['status']."',
						updatedAt='".$date."' 
					WHERE adminId='".$adminId."'";

				$update = $adapter->update($query);*/

				if(!$update){ 
					throw new Exception("System is unable to update.", 1);
				}
				
			}
			else{
				
				$adminId = $adminTable->insert($row);

				/*$query = "INSERT INTO admin(firstName,lastName,email,password,mobile,status,createdAt) 	
				VALUES('".$row['firstName']."',
						   '".$row['lastName']."',
						   '".$row['email']."',
						   '".$row['password']."',
						   '".$row['mobile']."',
						   '".$row['status']."',
						   '".$date."')";
				$adminId=$adapter->insert($query);*/
				if(!$adminId)
				{	
						throw new Exception("System is unable to insert.", 1);
				}
				
			}
			//$this->getUrl('grid','admin',null,true);
			$this->redirect($this->getUrl('grid','admin',null,true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getUrl('grid','admin',null,true));
		}
	}

	public function deleteAction()
	{
		$adminTable = Ccc::getModel('Admin');
		//$adminTable = new Model_Admin(); 
		//$request = new Model_Core_Request();
		try 
		{	
			$getId = $this->getRequest()->getRequest('id'); 
			if (!isset($getId)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			$delete = $adminTable->delete(['adminId' => $getId]);
			/*$query = "DELETE FROM Admin WHERE adminId = ".$getId;
			$delete = $adapter->delete($query); */
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$rd = $this->getUrl('grid','admin');
			echo $rd;
			
			$this->redirect($this->getUrl('grid','admin',null,true));	
				
		} catch (Exception $e) {
			$this->redirect($this->getUrl('grid','admin',null,true));	
			//echo $e->getMessage();
		}

		
	}
	public function errorAction()
	{
		echo "errorAction";
	}
}
?>