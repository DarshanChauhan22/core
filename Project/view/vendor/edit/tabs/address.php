<?php $address = $this->getAddress(); //print_r($address); die;?>
<?php //$vendor = $vendorAddress['vendor']; //print_r($vendor); die;?>
<?php //$address = $vendorAddress['vendorAddress']; //print_r($vendorAddress); die;?>

  <table border="1" width="100%" cellspacing="4">
    <tr>
      <td colspan="2"><b>Address Information</b></td>
    </tr>
    <tr>
      <td width="10%">Address</td>
      <td><input type="text" name="address[address]" value="<?php echo $address->address ?>"></td>
    </tr>
    
    <tr>
      <td width="10%">City</td>
      <td><input type="text" name="address[city]" value="<?php echo $address->city ?>"></td>
    </tr> 
    <tr>
      <td width="10%">State</td>
      <td><input type="text" name="address[state]" value="<?php echo $address->state ?>"></td>
    </tr>
    <tr>
      <td width="10%">Postal Code</td>
      <td><input type="text" name="address[postalCode]" value="<?php echo $address->postalCode ?>"></td>
    </tr>
    <tr>
      <td width="10%">Country</td>
      <td><input type="text" name="address[country]" value="<?php echo $address->country ?>"></td>
    </tr>
    <tr>
      <td width="25%">&nbsp;</td>
      <input type="hidden" name="address[vendorAddressId]" value="<?php echo $address->vendorAddressId ?>">
      <td>
        <button type="submit" name="submit" class="Registerbtn">Save</button>
        <a href="<?php echo $this->getUrl('grid','vendor',null,false) ?>"><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </table>  
