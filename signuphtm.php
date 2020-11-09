<?php
$con=mysqli_connect("localhost","root","");
$db=mysqli_select_db($con,"newdatabase");
error_reporting(0);
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password1=$_POST['password'];
	$password=md5($password1);
	$address=$_POST['address'];
	$age=$_POST['age'];
	$gender=$_POST['gender'];
	
	
	
	$email=$_REQUEST['email'];
	
	$dat=mysqli_query($con,"select * from `person` WHERE email='$email'");
	while($row1=mysqli_fetch_assoc($dat))
	{
		$dbemail=$row1['email'];
	}
	if($dbemail==$email)
	{
		echo"Email already exist";
	}
	else{

	
	$res=mysqli_query($con,"INSERT INTO `person`(`name`, `email`, `password`, `address`, `age`, `gender`) VALUES ('$name','$email','$password','$address','$age','$gender')");
	if($res)
	{
		echo"Registered Successfully";
		
	}
	else{
		echo"Not registered";
	}
	
	}
	
}

?>

<!DOCTYPE HTML>
<HTML>
	<HEAD><TITLE>Signup page</TITLE>
	</HEAD>
	<BODY>
		<FORM method="POST">
			<TABLE border="1" align="right" cellspacing="2" cellpadding="10">
				<th>Signup</th>
				
				<tr>
					<td>Name:</td>
					<td> <input type="text" name='name' id="name" value="" /></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td> <input type="text" name='email' id="text" value="" required /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password" id="password" value=""/></td>
					
				</tr>
				
				<tr>
					<td>Address:</td>
					<td> <input type="text" name='address' id="address" value="" /></td>
				</tr>
				
				<tr>
					<td>Age:</td>
					<td> <input type="text" name='age' id="age" value="" /></td>
				</tr>
				
				<tr>
					<td>Gender:</td>
					<td> 
						<input type="radio" name="gender" value="male"> Male
						<input type="radio" name="gender" value="female"> Female
						<input type="radio" name="gender" value="other"> Other
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" name="submit" value="submit"/>
					</td>
				</tr>
			
			</TABLE>
			
			
		</FORM>
	</BODY>
</HTML>