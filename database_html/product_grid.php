<?php
	class connect
	{
		function view()
		{
			require("connection.php");
			$rs=mysqli_query($con,"select * from product");
			
?>
			<table align="center" widht="50%" border="1">
				<tr>
					<th align="center">ID</th>
					<th align="center">Name</th>
					<th align="center">Price</th>
					<th align="center">Quantity</th>
					<th align="center">Status</th>
					<th align="center">Created At</th>
					<th align="center">Updated At</th>
					<th align="center">Edit</th>
					<th align="center">Delete</th>
				</tr>
				<?php

					while($row = mysqli_fetch_array($rs))
					{

						echo "<tr><td>". $row['product_id'] ."</td>";
						echo "<td>" . $row['name'] ."</td>";
						echo "<td>" . $row['price']."</td>";
						echo "<td>" . $row['quantity'] ."</td>";
						echo "<td>" . $row['status'] ."</td>";
						echo "<td>" . $row['created_at'] ."</td>";
						echo "<td>" . $row['updated_at'] ."</td>";
						echo "<td align='center'><a href='product_edit.php?j=" . $row['product_id'] ."'>Edit</a></td>";
						echo	"<td><a href='product_delete.php?j=" . $row['product_id'] ."'>Delete</a></td></tr>";
					}					
				?>
			</table>
			<br>
			<center>
			<form action="insert.html">
				<input type="submit" name="sub" value="Insert Data">
			</form>
			</center>
<?php	
		}
	}
	$obj = new connect();
	$obj->view();
?>
