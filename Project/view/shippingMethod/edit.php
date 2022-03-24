<?php $shippingMethod = $this->getShippingMethod(); ?>
<?php //$this = new Controller_Core_Action(); ?>


<form action="<?php echo$this->getUrl('save','shippingMethod',null,false) ?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"> Shipping Method Information</td>
			</tr>

				<input type="hidden" name="shippingMethod[methodId]" value="<?php echo $shippingMethod->methodId ; ?>" placeholder="Not for user." readonly>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="shippingMethod[name]" value="<?php echo $shippingMethod->name ; ?>" ></td>
			</tr>

			<tr>
				<td width="10%">Note</td>
				<td><input type="text" name="shippingMethod[note]" value="<?php echo $shippingMethod->note ;?>"></td>
			</tr>

			<tr>
				<td width="10%">Price</td>
				<td><input type="number" name="shippingMethod[price]" value="<?php echo $shippingMethod->price ;?>"></td>
			</tr>

			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="shippingMethod[status]" value="<?php echo $shippingMethod->status; ?>">
						<?php foreach ($shippingMethod->getStatus() as $key => $value): ?>
              			<option <?php if($shippingMethod->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            			<?php endforeach; ?>
					</select>
				</td>
			</tr>

			<tr>
			<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href="<?php echo $this->getUrl('grid','shippingMethod',null,true) ?>">Cancel</a></button>
				</td>
		</tr>
		</table>
	</form>
