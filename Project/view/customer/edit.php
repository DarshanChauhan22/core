
<?php $customer = $this->getCustomer();// print_r($customer); die; ?>
<?php $billingAddress = $this->getBillingAddress(); //print_r($billingAddress); die;  ?>
<?php $shippingAddress = $this->getShippingAddress(); //print_r($shippingAddress->addressId); die; ?>

  <form action="<?php echo $this->getUrl('save',null,null,false) ?>" method="POST">
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
      <td><input type="text" id="billingAddress" name="billingAddress[address]" value="<?php echo $billingAddress->address ?>"></td>
    </tr>
    
    <tr>
      <td width="10%">City</td>
      <td><input type="text" id="billingCity" name="billingAddress[city]" value="<?php echo $billingAddress->city ?>"></td>
    </tr>
    <tr>
      <td width="10%">State</td>
      <td><input type="text" id="billingState" name="billingAddress[state]" value="<?php echo $billingAddress->state ?>"></td>
    </tr>
    <tr>
      <td width="10%">Postal Code</td>
      <td><input type="text" id="billingPostalcode" name="billingAddress[postalCode]" value="<?php echo $billingAddress->postalCode ?>"></td>
    </tr>
    <tr>
      <td width="10%">Country</td>
      <td><input type="text" id="billingCountry" name="billingAddress[country]" value="<?php echo $billingAddress->country ?>"></td>
    </tr>
    <tr>
      <td colspan="2"><input type="checkbox" name="same" <?php if($billingAddress->same == 1):?> checked <?php endif; ?> onclick="showHide(this)">Mark Shipping as Billing</td>
    </tr>
  </table>
  

  <script type="text/javascript">
      function showHide(checkbox) {
        var shippingAddress = document.getElementById('shipping');
        shippingAddress.style.display = checkbox.checked ? "none" : "block";
      }
    </script>
    

   <div id="shipping" <?php if($billingAddress->same != 1): ?> style="display:block;" <?php else: ?> style="display:none;" <?php endif; ?>>
    <table border="1" width="100%" cellspacing="4">
    <tr>
      <td colspan="2"><b>Shipping Information</b></td>
    </tr>
    <tr>
      <td width="10%">Address</td>
      <td><input type="text" id="shippingAddress" name="shippingAddress[address]" value="<?php echo $shippingAddress->address ?>"></td>
    </tr>
    
    <tr>
      <td width="10%">City</td>
      <td><input type="text" id="shippingCity" name="shippingAddress[city]" value="<?php echo $shippingAddress->city ?>"></td>
    </tr>
    <tr>
      <td width="10%">State</td>
      <td><input type="text" id="shippingState" name="shippingAddress[state]" value="<?php echo $shippingAddress->state ?>"></td>
    </tr>
    <tr>
      <td width="10%">Postal Code</td>
      <td><input type="text" id="shippingPostalcode" name="shippingAddress[postalCode]" value="<?php echo $shippingAddress->postalCode ?>"></td>
    </tr>
    <tr>
      <td width="10%">Country</td>
      <td><input type="text" id="shippingCountry" name="shippingAddress[country]" value="<?php echo $shippingAddress->country ?>"></td>
    </tr>
  

    <tr>
      <td width="10%">&nbsp;</td>
      <input type="hidden" name="customer[customerId]" value="<?php echo $customer->customerId ?>">
      <!-- <input type="hidden" name="billingAddress[addressId]" value="<?php //echo $billingAddress->addressId ?>">
      <input type="hidden" name="shippingAddress[addressId]" value="<?php //echo $shippingAddress->addressId ?>"> -->
      
    </tr>    
  </table>  
</div>
 <button type="submit" name="submit" class="Registerbtn">Save </button>
        <a href="<?php echo $this->getUrl('grid','customer',null,true) ?>"><button type="button" class="cancelbtn">Cancel</button></a>
</form>
