<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Page'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>

<?php
class Controller_Page extends Controller_Core_Action
{
	
	public function gridAction()
	{
		$this->setTitle("Page Grid");
		$content = $this->getLayout()->getContent();
        $pageGrid = Ccc::getBlock("Page_Grid");
        $content->addChild($pageGrid);
        $this->renderLayout();
	}

	public function addAction()
	{
		$this->setTitle("Page Add");
		$page = Ccc::getModel('Page');
		$content = $this->getLayout()->getContent();
        $pageAdd = Ccc::getBlock("Page_Edit")->setData(['page'=> $page]);
        $content->addChild($pageAdd);
        $this->renderLayout();	
	}

	public function editAction()
	{	
		try 
		{
			$this->setTitle("Page Edit");
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
            $pageEdit = Ccc::getBlock("Page_Edit")->setData(['page'=> $page]);
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
		$message = $this->getMessage();
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d H:i:s");
		
		try
        {
            $row = $this->getRequest()->getPost('page');
            if (!$row) 
            {
                throw new Exception("Invalid Request.");             
            } 
            $pageId = (int)$this->getRequest()->getRequest('id');
            $page = Ccc::getModel('Page')->load($pageId);

            if(!$page)
            {
            	$page = Ccc::getModel('Page');
            	$page->setData($row);
               	$page->createdAt = $date;
            }
            else
            {
            	$page->setData($row);
            	$page->updatedAt = $date;
            }
            $result = $page->save();

            if (!$result)
            {
                throw new Exception("Update Unsuccessfully");
            }
            $message->addMessage('Update Successfully'); 
            $this->redirect($this->getUrl('grid','page',['id' => null],false));
        }
        catch(Exception $e)
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);         
            $this->redirect($this->getUrl('grid','page',null,true));
        }

}
	
	
	public function deleteAction()
	{
		try 
		{	
			$message = $this->getMessage();
			$getId = $this->getRequest()->getRequest('id'); 
			$pageTable = Ccc::getModel('Page')->load($getId);
			if (!$getId) 
			{
				throw new Exception("Invalid Request.");
			}
			$delete = $pageTable->delete(['pageId' => $getId]);
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.");
										
			}
			$message->addMessage('Delete Successfully.');	
			$this->redirect($this->getUrl('grid',null,['id' => null],false));	
				
		} catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getUrl('grid',null,['id' => null],false));		
		}
	}
}
