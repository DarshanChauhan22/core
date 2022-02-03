<?php
		
			require('Adapter.php');
			$adapter->connect();
			$query ="select * from product";

			$row = $adapter->fetchAll($query);
			
?>
			<table width="100%" border="1">
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

					foreach($row as $data)
					{

						echo "<tr><td>". $data['product_id'] ."</td>";
						echo "<td>" . $data['name'] ."</td>";
						echo "<td>" . $data['price']."</td>";
						echo "<td>" . $data['quantity'] ."</td>";
						echo "<td>" . $data['status'] ."</td>";
						echo "<td>" . $data['created_at'] ."</td>";
						echo "<td>" . $data['updated_at'] ."</td>";
						echo "<td align='center'><a href='product_edit.php?j=" . $data['product_id'] ."'>Edit</a></td>";
						echo	"<td><a href='product_delete.php?j=" . $data['product_id'] ."'>Delete</a></td></tr>";
					}					
				?>
			</table>
			<br>
			<center>
			<form action="product_add.php" method="post">
				<input type="submit" name="sub" value="Add New">
			</form>
			</center>
<?php	
		
?>
