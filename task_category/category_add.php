<html>
	<head>
		<title> Insert Form </title>
	</head>
	<body>
		<form name ="insert" action="category_save.php" method="post">
			<table align="center"  width="50%" cellpadding="5" cellspacing="5">
				
				<tr>
					<td>Name :-</td>
					<td><input type="text" name="sname" id="sname"/></td>
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