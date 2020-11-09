<?php
error_reporting(0);
$rule=$_REQUEST['rule'];
$con=mysqli_connect("localhost","root","");
$db=mysqli_select_db($con,"test");
switch($rule)
{
	case "register":
	{
		$name=$_REQUEST['name'];
		$email=$_REQUEST['email'];
		$contact=$_REQUEST['contact'];
		$password=$_REQUEST['password'];
		$address=$_REQUEST['address'];
		$college_name=$_REQUEST['college_name'];
		
$res=mysqli_query($con,"INSERT INTO `register`(`name`, `email`, `contact`,`password`,`address`,`college_name`) VALUES ('$name','$email','$contact','$password','$address','$college_name')");
$res1=mysqli_query($con,"SELECT * from `register`");
while($row=mysqli_fetch_assoc($res1))
{
	$dd[]=$row;
	$ere=array("status"=>'1',"data"=>$dd);
}
	echo json_encode($ere);
	}
	break;
	case"signin":
	{
		$name=$_REQUEST['name'];
		$email=$_REQUEST['email'];
		$password=$_REQUEST['password'];
		$contact=$_REQUEST['contact'];
		$college_name=$_REQUEST['college_name'];
		$address=$_REQUEST['address'];
		$pan_card=$_REQUEST['pan_card'];
		$gender=$_REQUEST['gender'];
		$res=mysqli_query($con,"INSERT INTO `details`(`name`, `email`, `password`, `contact`, `college_name`, `address`, `pan_card`, `gender`)VALUES ('$name', '$email', '$password', '$contact', '$college_name', '$address', '$pan_card', '$gender')");
		if($res)
		{
			$ere=array("status"=>'1',"message"=>'inserted');
			echo json_encode($ere);
		}
		else{
			$ere=array("status"=>'0',"message"=>'not');
	        echo json_encode($ere);
		}
	}
	break;
	
	default:
	{
		echo "error occured";
	}
}


?>