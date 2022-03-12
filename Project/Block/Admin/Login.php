<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Admin_Login extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/admin/login.php');
	}

	public function getMessages()
	{
		$model = Ccc::getModel('Admin_Message');
		$messages = $model->getMessages();
		$model->unsetMessage();
		return $messages;
	}
}