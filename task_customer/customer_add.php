<html>
	<head>
		<title> Insert Form </title>
	</head>
	<body>
		<form name ="insert" action="customer_save.php" method="post">
			<table align="center">
				
				<tr>
					<td>First Name :-</td>
					<td><input type="text" name="firstName" id="firstName"/></td>
				</tr>
				<tr>
					<td>Last Name :-</td>
					<td><input type="text" name="lastName" id="lastName"/></td>
				</tr>
				<tr>
					<td>Mobile :-</td>
					<td><input type="text" name="mobile" id="mobile"/></td>
				</tr>
				<tr>
					<td>Email :-</td>
					<td><input type="text" name="email" id="email"/></td>
				</tr>
				<tr>
					<td>Status :-</td>
					<td><input type="text" name="status" id="status"/></td>
				</tr>
				<tr>
					
					<td><input type="hidden" name="createdAt" id="createdAt"/></td>
				</tr>
				<tr>
					
					<td><input type="hidden" name="updatedAt" id="updatedAt"/></td>
				</tr>
				<tr>
					<td><input type="submit" name="submit" value="SAVE"/>
					 <input type="submit" name="cancle" value="CANCLE"/></td>
				</tr>
			</table>
		
			
		</form>
	</body>
</html>