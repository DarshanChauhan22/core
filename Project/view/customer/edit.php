<pre>
<?php $customer = $this->getCustomer(); //print_r($customer);  ?>
<?php $billingAddress = $this->getBillingAddress(); //print_r($billingAddress->addressId); die;  ?>
<?php $shippingAddress = $this->getShippingAddress(); //print_r($shippingAddress->addressId); die; ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>

  <form action="<?php echo $controllerCoreAction->getUrl('save',null,null,false) ?>" method="POST">
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
         <?php foreach ($customer->getStatus() as $key => $value): ?>
              <option <?php if($customer->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
          <?php endforeach; ?>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="2"><b>Billing Information</b></td>
    </tr>
    <tr>
      <td width="10%">Address</td>
      <td><input type="text" id="billingAddress" name="billingaddress[address]" value="<?php echo $billingAddress->address ?>"></td>
    </tr>
    
    <tr>
      <td width="10%">City</td>
      <td><input type="text" id="billingCity" name="billingaddress[city]" value="<?php echo $billingAddress->city ?>"></td>
    </tr>
    <tr>
      <td width="10%">State</td>
      <td><input type="text" id="billingState" name="billingaddress[state]" value="<?php echo $billingAddress->state ?>"></td>
    </tr>
    <tr>
      <td width="10%">Postal Code</td>
      <td><input type="text" id="billingPostalcode" name="billingaddress[postalCode]" value="<?php echo $billingAddress->postalCode ?>"></td>
    </tr>
    <tr>
      <td width="10%">Country</td>
      <td><input type="text" id="billingCountry" name="billingaddress[country]" value="<?php echo $billingAddress->country ?>"></td>
    </tr>
  <tr><td>
    Same As Billing Address</td><td><input type="checkbox" id="checkbox" name="checkbox" value="<?php echo $billingAddress->checkbox ?>" onclick="SetBilling(this.checked);">
</td></tr>

    <script type="text/javascript">
      function SetBilling(checked) 
      {
        if(checked)
        {
          document.getElementById('shippingAddress').value = document.getElementById('billingAddress').value;
          document.getElementById('shippingCity').value = document.getElementById('billingCity').value;
          document.getElementById('shippingState').value = document.getElementById('billingState').value;
          document.getElementById('shippingCountry').value = document.getElementById('billingCountry').value;
          document.getElementById('shippingPostalcode').value = document.getElementById('billingPostalcode').value;

          /*document.getElementById('shippingAddress').disabled = document.getElementById('checkbox').checked; 
          document.getElementById('shippingCity').disabled = document.getElementById('checkbox').checked; 
          document.getElementById('shippingState').disabled = document.getElementById('checkbox').checked; 
          document.getElementById('shippingCountry').disabled = document.getElementById('checkbox').checked; 
          document.getElementById('shippingPostalcode').disabled = document.getElementById('checkbox').checked; */
        }
        else
        {
          document.getElementById('shippingAddress').value = '';
          document.getElementById('shippingCity').value = '';
          document.getElementById('shippingState').value = '';
          document.getElementById('shippingCountry').value = '';
          document.getElementById('shippingPostalcode').value = '';
        }
        if(checked)
        {
          document.getElementById('shippingAddress').value != document.getElementById('billingAddress').value;
          document.getElementById('shippingCity').value != document.getElementById('billingCity').value;
          document.getElementById('shippingState').value != document.getElementById('billingState').value;
          document.getElementById('shippingCountry').value != document.getElementById('billingCountry').value;
          document.getElementById('shippingPostalcode').value != document.getElementById('billingPostalcode').value;
          return unchecked;
        }
      }

      /*function fun1(this.value) 
      {
        document.getElementById('shippingAddress').value != document.getElementById('billingAddress').value;
        document.getElementById('shippingAddress').value = unchecked;
      }*/
    </script>

    <tr>
      <td colspan="2"><b>Shipping Information</b></td>
    </tr>
    <tr>
      <td width="10%">Address</td>
      <td><input type="text" id="shippingAddress" name="shippingaddress[address]" value="<?php echo $shippingAddress->address ?>" onchange="fun1(this)"></td>
    </tr>
    
    <tr>
      <td width="10%">City</td>
      <td><input type="text" id="shippingCity" name="shippingaddress[city]" value="<?php echo $shippingAddress->city ?>"></td>
    </tr>
    <tr>
      <td width="10%">State</td>
      <td><input type="text" id="shippingState" name="shippingaddress[state]" value="<?php echo $shippingAddress->state ?>"></td>
    </tr>
    <tr>
      <td width="10%">Postal Code</td>
      <td><input type="text" id="shippingPostalcode" name="shippingaddress[postalCode]" value="<?php echo $shippingAddress->postalCode ?>"></td>
    </tr>
    <tr>
      <td width="10%">Country</td>
      <td><input type="text" id="shippingCountry" name="shippingaddress[country]" value="<?php echo $shippingAddress->country ?>"></td>
    </tr>

    <tr>
      <td width="25%">&nbsp;</td>
      <input type="hidden" name="customer[customerId]" value="<?php echo $customer->customerId ?>">
      <input type="hidden" name="billingaddress[addressId]" value="<?php echo $billingAddress->addressId ?>">
      <input type="hidden" name="shippingaddress[addressId]" value="<?php echo $shippingAddress->addressId ?>">
      <td>
        <button type="submit" name="submit" class="Registerbtn">Save </button>
        <a href="<?php echo $controllerCoreAction->getUrl('grid','customer',null,true) ?>"><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </table>  
</form>
