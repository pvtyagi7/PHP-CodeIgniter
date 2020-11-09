<?php
error_reporting(0);
$rule=$_REQUEST['rule'];
$con=mysqli_connect("localhost","root","");
$db=mysqli_select_db($con,"newdatabase");
switch($rule)
{
	case"insert":
	{
		$Name=$_REQUEST['Name'];
		$contact=$_REQUEST['contact'];
		$Address=$_REQUEST['Address'];

		
		$reg=mysqli_query($con,"INSERT INTO `firsttab`(`Name`, `contact`, `Address`) VALUES ('$Name','$contact','$Address')");
		
		if($reg){
		echo "values Inserted";
		}
		else{
			
			echo "Not Inserted";
		}
		
	}
	break;
	
	
	case"join":
	{
	$res=mysqli_query($con,"select * from `firsttab` inner join `info` ON (firsttab.id=info.id)");
		
 while($row=mysqli_fetch_assoc($res))
 {
	 $row1[]=$row;
	 $emp=array("data"=>$row1);
 }	 
 echo json_encode($emp);
 //echo"Join Created";
	}
	break;
	case"update":
	{
		$name=$_REQUEST['name'];
		$id=$_REQUEST['id'];
		$contact=$_REQUEST['contact'];
		$Address=$_REQUEST['Address'];
		
		$res=mysqli_query($con,"select * from `firsttab` where id='$id'");
		
 while($row=mysqli_fetch_assoc($res))
 {
	 $dbname=$row['name'];
	 $dbcontact=$row['contact'];
	 $dbAddress=$row['Address'];
	 
 }
		if(empty($contact))
			$contact=$dbcontact;
		if(empty($name))
			$name=$dbname;
		if(empty($Address))
			$Address=$dbAddress;
		
		$res=mysqli_query($con,"update firsttab set name='$name',contact='$contact',Address='$Address' where id='$id';");
		
		if($res)
		{
			echo"Updated";
		}
		else
			echo"Not updated";
	}
	break;
	case"delete":
	{
		$id=$_REQUEST['id'];
		$del=mysqli_query($con,"DELETE from `firsttab` where id='$id';");
		if($del)
			echo"Row Deleted";
		else
			echo"Not Deleted";
	}
	break;
	
		case"signup":
	{
		$name=$_REQUEST['name'];
		$email=$_REQUEST['email'];
		$password=$_REQUEST['password'];
		$emp=mysqli_query($con,"SELECT * FROM `tab1` WHERE email='$email'");
		 while($row1=mysqli_fetch_assoc($emp))
		 {
			 $dbemail=$row1['email'];
		 }
		 if($dbemail==$email)
		 {
			 echo"This email id already has been registered";
		 }
		 else{
		$res=mysqli_query($con,"INSERT INTO `tab1`(`name`, `email`, `password`) VALUES ('$name','$email','$password')");
       if($res)
	   {
		   echo "inserted";
		 }
		 }
	}	
		break;
	
	/*case"signin":
	{
		$Name=$_REQUEST['Name'];
		$Password=($_REQUEST['Password'];
		$reg1=mysqli_query($con,"INSERT INTO `firsttab`(`Name`, `Password`) VALUES ('$NAME','$Password'));
		if($reg)
		{
			echo "Login Successful";
			
		}
		else
			echo"Data not Found";
		
	}
	break;
	*/
	default:
	{
		echo "error";
	}
}
?>