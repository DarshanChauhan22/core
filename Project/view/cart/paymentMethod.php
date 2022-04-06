<?php $paymentMethods = $this->getPaymentMethods(); //print_r($paymentMethods); die; ?>
<?php $cart = $this->getCart(); //print_r($cart); die; ?>


<h2>Payment Methods<h2>
  <!-- <form action="<?php// echo $this->getUrl('updatePaymentMethod') ?>" method="POST"> -->
<table border="1" width="100%" cellspacing="4">
    
            <?php foreach ($paymentMethods as $paymentMethod):?>
      <tr>
    <td width="10%"><?php echo $paymentMethod->name?></td>
      <td>
                <input type="radio" name="paymentMethod" value="<?php echo $paymentMethod->methodId ?>"<?php echo ($cart->paymentMethodId == $paymentMethod->methodId) ? 'checked' : '' ; ?>>
      </td>
  </tr>
             <?php endforeach; ?>  
             <tr> 
    <td>
        <button type="button" class="btn btn-success" onclick="savePaymentForm()">Save</button>
        
      </td>  
      </tr>          

</table>
<!-- </form> -->
<hr>
<script type="text/javascript">
  function savePaymentForm() 
  {
    //alert('button clicked');
    admin.setForm(jQuery('#indexForm'));
    admin.setUrl("<?php echo $this->getUrl('updatePaymentMethod') ?>");
    admin.load();
  }
  </script>