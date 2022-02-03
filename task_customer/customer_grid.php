<?php
		
			require('Adapter.php');
			$adapter->connect();
			$query ="select * from customer";

			$row = $adapter->fetchAll($query);
			
?>
			<table width="100%" border="1">
				<tr>
					<th align="center">ID</th>
					<th align="center">First Name</th>
					<th align="center">Last Name</th>
					<th align="center">Mobil</th>
					<th align="center">Email</th>
					<th align="center">Status</th>
					<th align="center">Created At</th>
					<th align="center">Updated At</th>
					<th align="center">Edit</th>
					<th align="center">Delete</th>
				</tr>
				<?php

					foreach($row as $data)
					{

						echo "<tr><td>". $data['id'] ."</td>";
						echo "<td>" . $data['firstName'] ."</td>";
						echo "<td>" . $data['lastName']."</td>";
						echo "<td>" . $data['mobile'] ."</td>";
						echo "<td>" . $data['email'] ."</td>";
						echo "<td>" . $data['status'] ."</td>";
						echo "<td>" . $data['createdAt'] ."</td>";
						echo "<td>" . $data['updatedAt'] ."</td>";
						echo "<td align='center'><a href='customer_edit.php?j=" . $data['id'] ."'>Edit</a></td>";
						echo	"<td><a href='customer_delete.php?j=" . $data['id'] ."'>Delete</a></td></tr>";
					}					
				?>
			</table>
			<br>
			<center>
			<form action="customer_add.php" method="post">
				<input type="submit" name="sub" value="Add New">
			</form>
			</center>
<?php	
		
?>
