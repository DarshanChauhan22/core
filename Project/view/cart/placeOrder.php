<?php $cartItems = $this->getCartItems(); ?>
<?php $cart = $this->getCart(); ?>

<?php $totalDiscount=0; ?>
<?php if($cartItems): ?>
<?php foreach ($cartItems as $cartItem)
 {
	$totalDiscount = $totalDiscount + $cartItem->discount ;
} 
 ?>
<?php endif; ?>
	<form  action="<?php echo $this->getUrl('saveOrder','order') ?>" method="POST">
<div style="float:right; margin-right: 50px;">
	<h2>Order Details</h2>

<table border="1" width="100%" cellspacing="4">


	<?php if(!$cartItems):?>
		<tr>
		<th width="100%">Sub Total</th>
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
		<td><?php echo $totalDiscount?></td>
	</tr>
	<tr>
		<th width="20%">Grand Total</th>
		<td>
			<?php echo $total + $cart->shippingAmount + $taxTotal - $totalDiscount?>
		</td>
	</tr>
<?php endif; ?>
	<td></td>
	<td>
		<button type="submit" name="submit" class="Registerbtn">Place Order</button>
	</td>
</table>
</div>
</form>