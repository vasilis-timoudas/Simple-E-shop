<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html> <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Login@AISMARKET</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<form method="post" action="login.php" align="center">
<p><font size="+2"><b>WELCOME TO OUR e-SHOP</b></font></p>
<table align="center">
	<tr><td><b>Username (e-mail)</b></td><td><input type="text" name="user" value=""/></td></tr>
	<tr><td><b>Password</b></td><td><input type="password" name="pass" value=""/></td></tr>
	<tr style="height:50px"><td colspan="2"><input type="submit" value="Login" style="width:100px"/></td></tr>
</table>
</form>
</body>
</html>
