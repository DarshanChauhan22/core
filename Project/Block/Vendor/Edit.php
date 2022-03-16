<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Vendor_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/vendor/edit.php');
	}
	public function getVendor()
	{
		$vendor = $this->getData('vendor');
		$vendorAddress = $this->getData('vendorAddress');
		return ['vendor' => $vendor , 'vendorAddress' => $vendorAddress];
	}
}

