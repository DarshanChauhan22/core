
<?php

require('Adapter.php');
			$adapter->connect();
			$con = $adapter->getConnect();

			$id = $_GET['j'];
			
			$query ="select * from product where product_id =  $id";

			$row = $adapter->fetchRow($query);
			

?>



<html>
			<center>
				<table>
				<form name="update" action="product_save.php method="post">
				<tr>
					<td>Name :-</td>
					<td><input type="text" name="sname" id="sname" value="<?php echo $row['name']; ?>"/></td>
				</tr>
				<tr>
					<td>price :-</td>
					<td><input type="text" name="sprice" id="sprice" value="<?php echo $row['price']; ?>"/></td>
				</tr>
				<tr>
					<td>quantity :-</td>
					<td><input type="text" name="squan" id="squan" value="<?php echo $row['quantity']; ?>"/></td>
				</tr>
				<tr>
					<td>status :-</td>
					<td><input type="text" name="sstatus" id="sstatus" value="<?php echo $row['status']; ?>"/></td>
				</tr>
				<tr>
					<td>Created At :-</td>
					<td><input type="text" name="screated" id="screated" value="<?php echo $row['created_at']; ?>"/></td>
				</tr>
				<tr>
					<td>Updated At :-</td>
					<td><input type="text" name="supdated" id="supdated" value="<?php echo $row['updated_at']; ?>"/></td>
				</tr>
				<tr>
					<tr>
						<td colspan="2" align align="center"><input type="hidden" name="id" value="<?php echo $row->product_id; ?>" /> 
						<input type="submit" name="submit" value="UPDATE" /></td>
					</tr>
				</table>
				</form>
			</center>
		</html>