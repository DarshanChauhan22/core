<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Vendor_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/vendor/grid.php');
	}

	public function getVendors()
	{
		$vendor = Ccc::getModel('Vendor');
		$vendors = $vendor->fetchAll("select c.*,a.* from vendor c join vendor_address a on a.vendorId = c.vendorId;");
		return $vendors;
	}
}

?>