<?php
		

		print_r(date('d-m-y h:i:s'));
			require('Adapter.php');
			$adapter->connect();
			
			$query ="select * from category";

			$row = $adapter->fetchAll($query);
			
?>
			<table width="100%" border="1">
				<tr>
					<th align="center">ID</th>
					<th align="center">Name</th>
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
						echo "<td>" . $data['name'] ."</td>";
						echo "<td>" . $data['status'] ."</td>";
						echo "<td>" . $data['created_at'] ."</td>";
						echo "<td>" . $data['updated_at'] ."</td>";
						echo "<td align='center'><a href='category_edit.php?j=" . $data['id'] ."'>Edit</a></td>";
						echo	"<td><a href='category_delete.php?j=" . $data['id'] ."'>Delete</a></td></tr>";
					}					
				?>
			</table>
			<br>
			<center>
			<form action="category_add.php" method="post">
				<input type="submit" name="sub" value="Add New">
			</form>
			</center>
<?php	
		
?>
