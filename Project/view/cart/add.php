
<?php $customers = $this->getCustomers();?>

<table border="1" width="100%" cellspacing="4">
	
	<td width="10%">Customer List</td>
      <td>
        <select name="customers" onchange="submitForm(this)">
            <option>Select Customer</option>
            <?php foreach ($customers as $customer):?>
                <option value="<?php echo $customer->customerId?>">
                	<?php echo $customer->customerId . " - " . $customer->firstName . " " . $customer->lastName; ?>
                </option>
             <?php endforeach; ?>            
            
        </select>
      </td>
  </tr>

</table>
</form>

<script type="text/javascript">
    function submitForm(ele) 
    {
        var page = ele.value;
        var pageUrl = "<?php echo $this->getUrl('cartCheck','cart',null,true) ?>&id="+ele.value;
        window.open(pageUrl,"_self");   
    }
</script>

    