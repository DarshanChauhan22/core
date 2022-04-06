<?php $shippingMethods = $this->getShippingMethods(); //print_r($shippingMethods); die; ?>
<?php $cart = $this->getCart(); //print_r($cart); die; ?>

<h2>Shipping Methods<h2>
   <!--  <form action="<?php //echo $this->getUrl('updateShippingMethod') ?>" method="POST"> -->
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
         <button type="button"class="btn btn-success"  onclick="saveShippinForm()">Save</button>
        
      </td>     
      </tr>    

</table>
<!-- </form> -->
<hr>

<script type="text/javascript">
  function saveShippinForm() 
  {
    //alert('button clicked');
    admin.setForm(jQuery('#indexForm'));
    admin.setUrl("<?php echo $this->getUrl('updateShippingMethod') ?>");
    admin.load();
  }
  </script>