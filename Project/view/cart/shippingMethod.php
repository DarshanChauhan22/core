<?php $shippingMethods = $this->getShippingMethods(); ?>
<?php $cart = $this->getCart(); ?>

<h2>Shipping Methods<h2>
    <form action="<?php echo $this->getUrl('updateShippingMethod') ?>" method="POST">
<table border="1" width="100%" cellspacing="4">
    
            <?php foreach ($shippingMethods as $shippingMethod):?>
      <tr>
    <td width="10%"><?php echo $shippingMethod->name?></td>
    <td width="10%"><?php echo $shippingMethod->price?></td>
      <td>
                <input type="radio" name="shippingMethod" value="<?php echo $shippingMethod->methodId?>" <?php echo ($cart->shippingMethodId == $shippingMethod->methodId) ? 'checked' : '' ; ?>>
      </td>
  </tr>
             <?php endforeach; ?>  
             <tr> 
    <td>
        <button type="submit" name="submit" class="Registerbtn">Save </button>
        
      </td>     
      </tr>    

</table>
</form>
<hr>