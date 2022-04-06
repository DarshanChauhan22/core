
<?php $cartItems = $this->getCartItems(); //print_r($cartItems); die; ?>
<?php $cart = $this->getCart(); //print_r($cart); die; ?>
<?php $totalDiscount=0; ?>
<?php if($cartItems): ?>
<?php foreach ($cartItems as $cartItem)
{
	$totalDiscount = $totalDiscount + $cartItem->discount * $cartItem->quantity;
} 
?>
<?php endif;?>

<h2>Order Details</h2>
<!-- <form  action="<?php //echo $this->getUrl('saveOrder','order') ?>" method="POST"> -->
<table border="1" width="50%" cellspacing="0">


	<?php if(!$cartItems):?>
		<tr>
		<th width="20%">Sub Total</th>
		<td>0</td>
	</tr>
	<tr>
		<th width="20%">Shipping Amount</th>
		<td>0</td>
	</tr>
	<tr>
		<th width="20%">Tax</th>
		<td>0</td>
	</tr>
	<tr>
		<th width="20%">Discount</th>
		<td>0</td>
	</tr>
	<tr>
		<th width="20%">Grand Total</th>
		<td>0</td>
	</tr>
<?php else:?>
	<tr>
		<th width="20%">Sub Total</th>
		<td>
			<?php $total = 0;?>
			<?php foreach ($cartItems as $cartItem) 
				{
					$mul = $cartItem->quantity * $cartItem->price;
					$total = $mul + $total;
				}
				?>
			<?php echo $total;?>
		</td>
	</tr>
	<tr>
		<th width="20%">Shipping Amount</th>
		<td>
			<?php echo $cart->shippingAmount?>
		</td>
	</tr>
	<tr>
		<th width="20%">Tax</th>
		<td>
			<?php $taxTotal = 0;?>
			<?php foreach ($cartItems as $cartItem) 
				{
					$taxTotal = $taxTotal + $cartItem->taxAmount;
				}
				?>
			<?php echo $taxTotal;?>
		</td>
	</tr>
	<tr>
		<th width="20%">Discount</th>
		<td><?php echo $totalDiscount; ?></td>
	</tr>
	<tr>
		<th width="20%">Grand Total</th>
		<td>
			<?php echo ($total + $cart->shippingAmount + $taxTotal) - $totalDiscount;?>
		</td>
	</tr>
<?php endif; ?>
	<td></td>
	<td>
		<button type="button" class="btn btn-success" onclick="placeOrder()">Place Order</button>
	</td>
</table>
<!-- </form> -->


<script type="text/javascript">
	function placeOrder() 
	{
		//alert('button clicked');
		admin.setForm(jQuery('#indexForm'));
		admin.setUrl("<?php echo $this->getUrl('saveOrder','order') ?>");
		alert(admin.getUrl());
		admin.load();
	}
</script>

