<?php Ccc::loadClass("Model_Core_Row"); ?>
<?php
class Model_Vendor extends Model_Core_Row
{
	protected $vendorAddress ;

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Active';
	const STATUS_DISABLED_LBL = 'InActive';

	public function __construct()
	{
		$this->setResourceClassName('Vendor_Resource');
		parent::__construct();
	}

	public function getStatus($key = null)
	{		
		
		$statues = [self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
					self::STATUS_DISABLED => self::STATUS_DISABLED_LBL];

		if(!$key)
		{
			return $statues;
		}

		if(array_key_exists($key , $statues))
		{
			return $statues[$key];
		}

		return self::STATUS_DEFAULT;
	}

	public function getVendorAddress($reload = false)
	{
		//print_r($this); die;
		$vendorAddressModel = Ccc::getModel('Vendor_Address');
		if(!$this->vendorId)
		{ 
			return $vendorAddressModel;
		}
		if($this->vendorAddress && !$reload)
		{ 	
			return $this->vendorAddressModel;
		}

		$vendorAddress = $vendorAddressModel->fetchRow("SELECT * from vendor_address WHERE vendorId = {$this->vendorId}");
		//print_r("SELECT * from vendor_address WHERE vendorId = {$this->vendorId}"); die;
		if(!$vendorAddress)
		{
			return $vendorAddressModel;
		}
		$this->setVendorAddress($vendorAddress);
		return $vendorAddress;
	}

	public function setVendorAddress(Model_Vendor_Address $address)
	{
		$this->vendorAddress = $address;
		return $this;
	}
}

