<?php $salesmanCustomers = $this->getsalesmanCustomers(); //print_r($salesmanCustomers) ?>
<?php $salesmanCustomersNo = $this->getsalesmanCustomersNot(); //print_r($salesmanCustomersNo) ?>


<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
               <tr>
    <th>Customer ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Action</th>
    <th>Price</th>
  </tr>
  <?php if(!$salesmanCustomers): ?>
    <tr>No Customer</tr>
  <?php else: ?>
  <?php foreach ($salesmanCustomers as $salesmanCustomer): ?>
    <tr>
      <td><?php echo $salesmanCustomer->customerId; ?></td>
      <td><?php echo $salesmanCustomer->firstName; ?></td>
      <td><?php echo $salesmanCustomer->lastName; ?></td>
      <td><?php echo $salesmanCustomer->email; ?></td>
      <td><input type="checkbox" name="salesmanCustomer[customer][]" value="" disabled></td>
      
      <td><button type="button" value="<?php echo $salesmanCustomer->customerId;?>" class="price btn btn-success">Price</button>
        <!-- <a href="<?php //echo $this->getUrl('grid','customer_price',['id' => Ccc::getFront()->getRequest()->getRequest('id') , 'customerId' => $salesmanCustomer->customerId],true); ?>">Price</a> --></td>
    </tr>
  <?php endforeach; ?>
  <?php endif;?>
</table>
<br>
<br>
<br>
<table id="example2" class="table table-bordered table-hover">
  
  <tr>
    <th>Customer ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Action</th>
  </tr>
  <?php if(!$salesmanCustomersNo): ?>
    <tr>No Customer</tr>
  <?php else: ?>
  <?php foreach ($salesmanCustomersNo as $salesmanCustomer): ?>
    <tr>
      <td><?php echo $salesmanCustomer->customerId; ?></td>
      <td><?php echo $salesmanCustomer->firstName; ?></td>
      <td><?php echo $salesmanCustomer->lastName; ?></td>
      <td><?php echo $salesmanCustomer->email; ?></td>
      <td><input type="checkbox" name="salesmanCustomer[customerNo][]" value="<?php echo $salesmanCustomer->customerId ?>"></td>

    </tr>
  <?php endforeach; ?>
  <?php endif;?>

       <td>
        <!-- <button type="submit" name="submit" class="Registerbtn">Save </button> -->
        <button type="button" class="btn btn-success" onclick="saveCustomerPrice()">Save</button>
        <!-- <a href="<?php //echo $this->getUrl('grid','salesman',null,true) ?>"><button type="button" class="cancelbtn">Cancel</button></a> -->
      </td>
              </table>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  

</div>



<script type="text/javascript">

   function saveCustomerPrice() {
    admin.setForm(jQuery('#indexForm'));
     // alert(admin.getForm());
    admin.setUrl("<?php echo $this->getUrl('save','salesman_Customer',null,false)?>");
      alert(admin.getUrl());
      admin.load();
  }
  function customerPrice() {
    admin.setForm(jQuery('#indexForm'));
    admin.setUrl("<?php echo $this->getUrl('gridBlock','customer_price',['id' => Ccc::getFront()->getRequest()->getRequest('id') , 'customerId' => $salesmanCustomer->customerId],true); ?>");
      //alert(admin.getUrl());
      admin.load();
  }

  $('.price').click(function()
{
    var data = $(this).val();
    admin.setForm(jQuery('#indexForm'));
    admin.setUrl("<?php echo $this->getUrl('addBlock','salesman',['tab' => 'price'],false)?>&customerId="+data);
    //alert(admin.getUrl());
    admin.load();
})
  </script>