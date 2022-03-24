<?php Ccc::loadClass("Model_Core_Row"); ?>
<?php
class Model_Cart extends Model_Core_Row
{
	protected $customers = null;
	protected $billingAddress = null;
	protected $shippingAddress = null;
    protected $cartItem = Null;
	/*const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Active';
	const STATUS_DISABLED_LBL = 'InActive';*/

	public function __construct()
	{
		$this->setResourceClassName('Cart_Resource');
	}

	public function getCustomers($reload = false)
    {
        $customerModel = Ccc::getModel('Customer');
        

        if(!$this->cartId)
        {
            return $customerModel;
        }

        if($this->customers && !$reload)
        { 
            return $this->customers;
        }
        $customers = $customerModel->fetchAll("SELECT * from customer");
        if(!$customers)
        {
            return $customerModel;
        }
        $this->setCustomers($customers);
        return $customers;
    }

    public function setCustomers(Model_Customer $customer)
    {
        $this->customers = $customer;
        return $this;
    }

    public function getBillingAddress($reload = false)
    {
        $billingAddressModel = Ccc::getModel('Cart_Address');
        
        if(!$this->cartId)
        {
            return $billingAddressModel;
        }

        if($this->billingAddress && !$reload)
        { 
            return $this->billingAddressModel;
        }

        $billingAddress = $billingAddressModel->fetchRow("SELECT * from cart_address WHERE cartId = {$this->cartId} AND billing = 1");
        if(!$billingAddress)
        {
            return $billingAddressModel;
        print_r($billingAddressModel); die;
        }
        //$this->setBillingAddress($billingAddress);
        return $billingAddress;
    }

    public function setBillingAddress(Model_Cart_Address $address)
    {
        $this->billingAddress = $address;
        return $this;
    }

    
    public function getShippingAddress($reload = false)
    {
        $shippingAddressModel = Ccc::getModel('Cart_Address');
        
        if(!$this->cartId)
        {
            return $shippingAddressModel;
        }

        if($this->shippingAddress && !$reload)
        { 
            return $this->shippingAddress;
        }

        $shippingAddress = $shippingAddressModel->fetchRow("SELECT * from cart_address WHERE cartId = {$this->cartId} AND shipping = 1");
        if(!$shippingAddress)
        {
            return $shippingAddressModel;
        }
        $this->setShippingAddress($shippingAddress);
        return $shippingAddress;
    }

    public function setShippingAddress(Model_Cart_Address $address)
    {
        $this->shippingAddress = $address;
        return $this;
    }

     public function getCartItems($reload = false)
    {
        $cartItemModel = Ccc::getModel('Cart_Item');
        
        if(!$this->cartId)
        {
            return $cartItemModel;
        }

        if($this->cartItem && !$reload)
        { 
            return $this->cartItemModel;
        }

        $cartItem = $cartItemModel->fetchAll("SELECT * from cart_item WHERE cartId = {$this->cartId};");
        if(!$cartItem)
        {
            return $this->cartItemModel;
        }
        //$this->setCartItems($cartItem);
        return $cartItem;
    }

    public function setCartItems(Model_Cart_Item $cartItem)
    {
        $this->cartItem = $cartItem;
        return $this;
    }


	/*public function getStatus($key = null)
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
	}	*/
}

