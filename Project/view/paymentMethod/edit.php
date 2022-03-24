<?php $paymentMethod = $this->getPaymentMethod(); ?>
<?php //$controllerCoreAction = new Controller_Core_Action(); ?>


<form action="<?php echo$this->getUrl('save','paymentMethod',null,false) ?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"> PaymentMethod Information</td>
			</tr>
				<input type="hidden" name="paymentMethod[methodId]" value="<?php echo $paymentMethod->methodId ; ?>" placeholder="Not for user." readonly>

				

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="paymentMethod[name]" value="<?php echo $paymentMethod->name ; ?>" ></td>
			</tr>

			<tr>
				<td width="10%">Note</td>
				<td><input type="text" name="paymentMethod[note]" value="<?php echo $paymentMethod->note ;?>"></td>
			</tr>

			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="paymentMethod[status]" value="<?php echo $paymentMethod->status; ?>">
						<?php foreach ($paymentMethod->getStatus() as $key => $value): ?>
              			<option <?php if($paymentMethod->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            			<?php endforeach; ?>
					</select>
				</td>
			</tr>

			<tr>
			<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href="<?php echo $this->getUrl('grid','paymentMethod',null,true) ?>">Cancel</a></button>
				</td>
		</tr>
		</table>
	</form>
