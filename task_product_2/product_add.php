<html>
	<head>
		<title> Insert Form </title>
	</head>
	<body>
		<form name ="insert" action="product_save.php" method="post">
			<table align="center">
				
				<tr>
					<td>Name :-</td>
					<td><input type="text" name="sname" id="sname"/></td>
				</tr>
				<tr>
					<td>price :-</td>
					<td><input type="text" name="sprice" id="sprice"/></td>
				</tr>
				<tr>
					<td>quantity :-</td>
					<td><input type="text" name="squan" id="squan"/></td>
				</tr>
				<tr>
					<td>status :-</td>
					<td><input type="text" name="sstatus" id="sstatus"/></td>
				</tr>
				<tr>
					
					<td><input type="hidden" name="screated" id="screated"/></td>
				</tr>
				<tr>
					
					<td><input type="hidden" name="supdated" id="supdated"/></td>
				</tr>
				<tr>
					<td><input type="submit" name="submit" value="SAVE"/>
					 <input type="submit" name="cancle" value="CANCLE"/></td>
				</tr>
			</table>
		
			
		</form>
	</body>
</html>