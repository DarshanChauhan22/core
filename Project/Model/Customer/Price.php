<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Customer_Price extends Model_Core_Row
{
	
	public function __construct()
	{
		$this->setResourceClassName('Customer_Price_Resource');
		parent::__construct();
	}

	public function getCustomer($reload = false)
    {
        $customerModel = Ccc::getModel('Customer');
        
        if(!$this->customerId)
        {
            return $customerModel;
        }

        if($this->customer && !$reload)
        { 
            return $this->customer;
        }
        $customer = $customerModel->fetchRow("SELECT * from customer WHERE customerId = {$this->customerId}");
        if(!$customer)
        {
            return $customerModel;
        }
        $this->setCustomer($customer);
        return $customer;
    }

    public function setCustomer(Model_Customer $customer)
    {
        $this->customer = $customer;
        return $this;
    }
}