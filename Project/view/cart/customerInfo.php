<?php $customer = $this->getCustomer(); ?>



<div id='info'>
    <h2>Customer Info <h2>
        <table border=1 width=100%>
            <tr>
                <th> Id </th>
                <th> First Name </th>
                <th> Last Name </th>
                
            </tr>
            <?php if($customer):?>
                    <tr>
                        <td><?php echo $customer->customerId ?></td>
                        <td><?php echo $customer->firstName ?></td>
                        <td><?php echo $customer->lastName ?></td>
                        
            <?php else:?>
                <tr><td colspan='10'>No Record Available</td></tr>          
            <?php endif; ?>
        </table>
        <hr>
    
