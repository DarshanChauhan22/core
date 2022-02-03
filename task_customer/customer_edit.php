
<?php

require('Adapter.php');
			$adapter->connect();
			$con = $adapter->getConnect();

			$id = $_GET['j'];
			
			$query ="select * from customer where id =  $id";

			$row = $adapter->fetchRow($query);
			

?>



<html>
			<center>
				<table>
				<form name="update" action="customer_save.php" method="post">
				<tr>
					<td>First Name :-</td>
					<td><input type="text" name="firstName" id="firstName" value="<?php echo $row['firstName']; ?>"/></td>
				</tr>
				<tr>
					<td>Last Name :-</td>
					<td><input type="text" name="lastName" id="lastName" value="<?php echo $row['lastName']; ?>"/></td>
				</tr>
				<tr>
					<td>Mobile :-</td>
					<td><input type="text" name="mobile" id="mobile" value="<?php echo $row['mobile']; ?>"/></td>
				</tr>
				<tr>
					<td>Email :-</td>
					<td><input type="text" name="email" id="email" value="<?php echo $row['email']; ?>"/></td>
				</tr>
				<tr>
					<td>status :-</td>
					<td><input type="text" name="status" id="status" value="<?php echo $row['status']; ?>"/></td>
				</tr>
				<tr>
					
					<td><input type="hidden" name="createdAt" id="createdAt" value="<?php echo $row['createdAt']; ?>"/></td>
				</tr>
				<tr>
					<td><input type="hidden" name="updatedAt" id="updatedAt" value="<?php echo $row['updatedAt']; ?>"/></td>
				</tr>
				<tr>
					<tr>
						<td colspan="2" align align="center"><input type="hidden" name="id" value="<?php echo $row['id'] ?>" /> 
						<input type="submit" name="submit" value="UPDATE" />
						<input type="submit" name="cancle" value="CANCLE" /></td>
					</tr>
				</table>
				</form>
			</center>
		</html>