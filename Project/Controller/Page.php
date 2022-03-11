<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Page');
Ccc::loadClass('Model_Core_Request');

class Controller_Page extends Controller_Core_Action{
	
	public function testAction()
	{
		$pageTable = new Model_Page(); 
		$pageTable->setTableName('page');
		$pageTable->setPrimaryKey('pageId');
	}
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
        $pageGrid = Ccc::getBlock("Page_Grid");
        $content->addChild($pageGrid);
        $this->renderLayout();
	}

	public function addAction()
	{
		$page = Ccc::getModel('Page');
		$content = $this->getLayout()->getContent();
        $pageAdd = Ccc::getBlock("Page_Edit")->addData("page", $page);
        $content->addChild($pageAdd);
        $this->renderLayout();	
	}

	public function editAction()
	{	
		try 
		{
			$message = $this->getMessage();
			$id = (int) $this->getRequest()->getRequest('id');
			if(!$id)
			{
				throw new Exception("Id not valid.");
			}
			$page = Ccc::getModel('Page')->load($id);
			if(!$page)
			{
				throw new Exception("unable to load page.");
			}
			$content = $this->getLayout()->getContent();
            $pageEdit = Ccc::getBlock("Page_Edit")->addData("page", $page);
            $content->addChild($pageEdit);
            $this->renderLayout();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getUrl('grid',null,null,true));
		}
	}
	
	public function saveAction()
	{
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d H:i:s");
		try
		{
			$message = $this->getMessage();
			$page = Ccc::getModel('Page');

			$row = $this->getRequest()->getRequest('page');

			if (!isset($row)) 
			{
				throw new Exception("Invalid Request.", 1);				
			}			


			 if(array_key_exists('pageId',$row) && $row['pageId'] == null)
       		 {
                $page->name = $row['name'];
                $page->code =  $row['code'];
                $page->content =  $row['content'];
                $page->status =  $row['status'];
                $page->createdAt =  $date;
                $page->updatedAt =  null;
                $result = $page->save();

                if(!$result)
                {
                	throw new Exception("Insert Unsuccessfully.",1);
                }
					$message->addMessage('Insert Successfully.');
        	}
        	else
        	{

                $page->load($row['pageId']);
                $page->pageId = $row["pageId"];
                 $page->name = $row['name'];
                $page->code =  $row['code'];
                $page->content =  $row['content'];
                $page->status =  $row['status'];
                //$page->createdAt = $row['createdAt'];
                $page->updatedAt =  $date;
                $result = $page->save();

                if(!$result)
                {
					throw new Exception("Update Unsuccessfully.",1);
                }
					$message->addMessage('Update Successfully.');
       			}

			$this->redirect($this->getUrl('grid','page',null,true));
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getUrl('grid',null,null,true));	
		}
	}

	public function deleteAction()
	{
		try 
		{	
			$message = $this->getMessage();
			$getId = $this->getRequest()->getRequest('id'); 
			$pageTable = Ccc::getModel('Page')->load($getId);
			if (!isset($getId)) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			$delete = $pageTable->delete(['pageId' => $getId]);
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.", 1);
										
			}
			$message->addMessage('Delete Successfully.');	
			$this->redirect($this->getUrl('grid','page',null,true));	
				
		} catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getUrl('grid',null,null,true));		
		}
	}
}
?>