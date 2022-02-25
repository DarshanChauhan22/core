<?php $customer = $this->getCustomer(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>
<html>
<head>
  
<body>
  <form action="<?php echo $controllerCoreAction->getUrl('save',null,null,true) ?>" method="POST">
  <table border="1" width="100%" cellspacing="4">
    <tr>
      <td colspan="2"><b>Personal Information</b></td>
    </tr>
    <tr>
      <td width="10%">First Name</td>
      <td><input type="text" name="customer[firstName]" value="<?php echo $customer->firstName ?>"></td>
    </tr>
    
    <tr>
      <td width="10%">Last Name</td>
      <td><input type="text" name="customer[lastName]" value="<?php echo $customer->lastName ?>"></td>
    </tr>
    <tr>
      <td width="10%">Email</td>
      <td><input type="text" name="customer[email]" value="<?php echo $customer->email ?>"></td>
    </tr>
    <tr>
      <td width="10%">Mobile</td>
      <td><input type="text" name="customer[mobile]" value="<?php echo $customer->mobile ?>"></td>
    </tr>
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="customer[status]">

          <?php if ($customer->status == 1):?>
              <option value='1'>Active</option>
              <option value='2'>InActive</option>
          <?php else: ?>
              <option value='2'>InActive</option>
                    <option value='1'>Active</option>
          <?php endif;?>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="2"><b>Address Information</b></td>
    </tr>
    <tr>
      <td width="10%">Address</td>
      <td><input type="text" name="address[address]" value="<?php echo $customer->address ?>"></td>
    </tr>
    
    <tr>
      <td width="10%">City</td>
      <td><input type="text" name="address[city]" value="<?php echo $customer->city ?>"></td>
    </tr>
    <tr>
      <td width="10%">State</td>
      <td><input type="text" name="address[state]" value="<?php echo $customer->state ?>"></td>
    </tr>
    <tr>
      <td width="10%">Postal Code</td>
      <td><input type="text" name="address[postalCode]" value="<?php echo $customer->postalCode ?>"></td>
    </tr>
    <tr>
      <td width="10%">Country</td>
      <td><input type="text" name="address[country]" value="<?php echo $customer->country ?>"></td>
    </tr>
    <tr>    
      <td>
        <?php if($customer->billing == '1'): ?>
          <input type="checkbox" name="address[billing]" value=1 checked>Billing Addres</td>
        <?php else: ?>
          <input type="checkbox" name="address[billing]" value=1>Billing Addres</td>
        <?php endif; ?>

      <td>
        <?php if($customer->shipping == '1'): ?>
          <input type="checkbox" name="address[shipping]" checked value=1> Shipping Address</td>
        <?php else: ?>
          <input type="checkbox" name="address[shipping]" value=1> Shipping Address</td>
        <?php endif; ?>

    </tr>
    <tr>
      <td width="25%">&nbsp;</td>
      <input type="hidden" name="customer[customerId]" value="<?php echo $customer->customerId ?>">
      <input type="hidden" name="address[addressId]" value="<?php echo $customer->addressId ?>">
      <td>
        <button type="submit" name="submit" class="Registerbtn">Update </button>
        <a href="<?php echo $controllerCoreAction->getUrl('grid','customer',null,true) ?>"><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </table>  
</form>
</body>
  </html>