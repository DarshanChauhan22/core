
<?php

require('Adapter.php');
			$adapter->connect();
			$con = $adapter->getConnect();

			$id = $_GET['j'];
			
			$query ="select * from category where id =  $id";

			$row = $adapter->fetchRow($query);
			

?>



<html>
			<center>
				<table>
				<form name="update" action="category_save.php" method="post">
				<tr>
					<td>Name :-</td>
					<td><input type="text" name="sname" id="sname" value="<?php echo $row['name']; ?>"/></td>
				</tr>
				<tr>
					<td>status :-</td>
					<td><input type="text" name="sstatus" id="sstatus" value="<?php echo $row['status']; ?>"/></td>
				</tr>
				<tr>
					<td><input type="hidden" name="screated" id="screated" value="<?php echo $row['created_at']; ?>"/></td>
				</tr>
				<tr>
					<td><input type="hidden" name="supdated" id="supdated" value="<?php echo $row['updated_at']; ?>"/></td>
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