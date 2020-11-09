<?php
error_reporting(0);
$con=mysqli_connect("localhost","root","");
$db=mysqli_select_db($con,"newdatabase");
if(isset($_POST['submit']))
{
	$email=$_POST['email'];
	$pass1=$_POST['password'];
	$password=md5($pass1);

	$res=mysqli_query($con,"SELECT * FROM `registration` WHERE `email`='$email' && `password`='$password'");
		
	if(mysqli_num_rows($res)>0)
	{
		while($row=mysqli_fetch_assoc($res))
		{
			echo"Welcome ".$row['name'];
		}


	}
	else
		echo"Entered Credentials Did not matched";
}

?>


<html>
	<head>
		<title>My Webpage</title>
	</head>
	<body>
	<form method="post">
		<table border="1" align="center">
			<th>Sign in</th>
			<tr>
				<td>Email: </td>
				<td> <input type="text" name= "email" value=""/> </td>
			</tr>

			<tr>
				<td>Password:</td>
				<td><input type="password" name="password" value=""/> </td>
			</tr>

			<tr>
				<td>
					<input type="submit" name="submit"/>
				</td>
				<td><a href="mytest.php">Create an account</a></td>
			</tr>
		</table>
	</form>
	</body>
</html>