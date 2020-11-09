<?php
error_reporting(0);
$rule=$_REQUEST['rule'];
$con=mysqli_connect("localhost",root,"");
$db=mysqli_select_db($con,"newdatabase");

		$name=$_REQUEST['name'];
		$email=$_REQUEST['email'];
		$password1=$_REQUEST['password'];
		$password=md5($password1);
		$cpassword=$_REQUEST['confirm_password'];
		$confirm_password=md5($cpassword);
		$contact=$_REQUEST['contact'];
		$address=$_REQUEST['address'];
		$pincode=$_REQUEST['pincode'];
			$id=$_REQUEST['id'];

	switch($rule)
	{
		case"insert":
		{
			if($password!=$confirm_password)
			{
				echo"Password and confirm password must be same";
			}
			else
			{
			$emp=mysqli_query($con,"SELECT * FROM `tab2` WHERE `email`='$email' ");
			while($row1=mysqli_fetch_assoc($emp))
			{
				$dbemail=$email;
			}
			if($dbemail==$email)
			{
				echo"Email is already registerd";
			}
			else
			{
			$ab=mysqli_query($con,"INSERT INTO `tab2`(`name`, `email`, `password`, `contact`, `address`, `pincode`) VALUES ('$name','$email','$password','$contact','$address','$pincode')");
			if($ab)
			{
				echo"Inserted";
			}
			else
			{
				echo"Data not inserted";
			}
			}
			}			
		}
		break;
		case "login":
		{
			if(!empty($email)&&!empty($password1))
			{
			$abc=mysqli_query($con,"SELECT * FROM `tab2` WHERE `email`='$email' && `password`='$password' ");
			if(mysqli_num_rows($abc)>0)
			{
				
			while($row2=mysqli_fetch_assoc($abc))
			{
				$dat[]=$row2;
				$empt=array("status"=>'1',"message"=>$dat);
			}
			echo json_encode($empt);
			}
		
			else
			{
				$empt=array("status"=>'0',"message"=>'Your entered credentials did not match');
				
				echo json_encode($empt);
			}
			
			}
			else
			{
				$empt=array("status"=>'0',"message"=>'Email and Passwords can not be empty');
				echo json_encode($empt);
			}
		}
		break;
		
	case"update":
	{
		//echo $id;die;
				$res=mysqli_query($con,"select * from `tab2` where `id`='$id'");
		
				while($row=mysqli_fetch_assoc($res))
				{
					$dbname=$row['name'];
					$dbemail=$row['email'];
					$dbcontact=$row['contact'];
					$dbaddress=$row['address'];
					$dbpassword=$row['password'];
					$dbpincode=$row['pincode'];
				}
				if(empty($name)){
				$name=$dbname;
				}
				if(empty($email)){
					$email=$dbemail;
				}
				if(empty($contact)){
					$contact=$dbcontact;
				}
				if(empty($address)){
					$address=$dbaddress;
				}
				if(empty($password)){
					$password=$dbpassword;
				}
				if(empty($pincode)){
					$pincode=$dbpincode;
				}		
		$res=mysqli_query($con,"UPDATE `tab2` SET `name`='$name',`email`='$email',`password`='$password',`contact`='$contact',`address`='$address',`pincode`='$pincode' WHERE `id`='$id'");
		
			$rr1=mysqli_query($con,"SELECT * FROM `tab2` WHERE `id`='$id'");
              if(mysqli_num_rows($rr1) > 0) 
			  {
                while($row=mysqli_fetch_assoc($rr1))
               {
                  $dat[]=$row;
                 $empt=array("status"=>'1',"data"=>$dat);
               }
             echo json_encode($empt);   
           }
        
      else
           {
            $empt = array("status"=>'0',"message"=>'Please enter valid id');
              echo json_encode($empt); 
           }
		/*if($res)
			echo"Updated";
		else
			echo"not updated";*/
		
	
	}
	break;
	case"merge":
	{
		//$id=$_REQUEST['id'];
		$name=$_REQUEST['name'];
		$contact=$_REQUEST['contact'];
		$Address=$_REQUEST['Address'];
		$address=$_REQUEST['address'];
		$pincode=$_REQUEST['pincode'];
		$dob=$_REQUEST['dob'];
		
		$a1=mysqli_query($con,"select * from `firsttab`");
						
		$arr1=array();
		while($row=mysqli_fetch_assoc($a1))
		{
			$arr1[]=$row;

		}
		//2nd variable
		
		$a2=mysqli_query($con,"select * from `info`");
		while($r1=mysqli_fetch_assoc($a2))
		{
		
			$arr2[]=$r1;
		}
		//print_r($arr1);
		
		$arr3=array_merge($arr1,$arr2);
		echo json_encode($arr3);
		
	}
	break;
	
	
		
		default:
		{
			echo"error";
		}
	}


?>