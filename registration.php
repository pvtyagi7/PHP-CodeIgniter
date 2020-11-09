<?php
error_reporting(0);
$rule=$_REQUEST['rule'];
$con=mysqli_connect("localhost","root","");
$db=mysqli_select_db($con,"newdatabase");
switch($rule)
{
	case"insert":
	{
		$name=$_REQUEST['name'];
		$contact=$_REQUEST['contact'];
		$pincode=$_REQUEST['pincode'];
		$age=$_REQUEST['age'];
		
		$tmp=mysqli_query($con,"INSERT INTO `tab2`(`name`,`contact`,`pincode`,`age`) values ('$name','$contact','$pincode','$age')");
		if($tmp)
			echo"Data Inserted";
		else
			echo"Not Inserted";
	}
	break;
	
	case"update":
	{
		$id=$_REQUEST['id'];
		$name=$_REQUEST['name'];
		$contact=$_REQUEST['contact'];
		$pincode=$_REQUEST['pincode'];
		$age=$_REQUEST['age'];
		$res=mysqli_query($con,"select * from `tab2` where id='$id'");
		while($row=mysqli_fetch_assoc($res))
		{
			$dbname=row['name'];
			$dbcontact=row['contact'];
			$dbpincode=row['pincode'];
			$dbage=row['age'];
			
		}
		if(empty($name))
			$name=$dbname;
		if(empty($contact))
			$contact=$dbcontact;
		if(empty($age))
			$age=$dbage;
		if(empty($pincode))
			$pincode=$dbpincode;
		
		$res=mysqli_query($con,"UPDATE `tab2` SET `name`='$name', `contact`='$contact', `age`='$age', `pincode`=$pincode where `id`='$id'");
		
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
		
/*		if($res>0)
			echo"updated";
		else
			echo"Not updated";
*/		
	}
	break;
	
	case"delete":
	{
		$id=$_REQUEST['id'];
		$res=mysqli_query($con,"delete from `tab2` where id='$id'");
		
		if($res)
			echo"record Deleted";
		else
			echo"Not Deleted";
	}
	break;
	case"join":
	{
		
		$res=mysqli_query($con,"SELECT `name` from `info` left join `firsttab` ON (info.id=firsttab.id)");
		while($row=mysqli_fetch_assoc($res))
		{
			$row1[]=$row;
			$emp=array("data"=>$row1);
			
		}
		echo json_encode($emp);

	}
	break;
	
	case"registration":
	{
		$name=$_REQUEST['name'];
		$email=$_REQUEST['email'];
		$password=$_REQUEST['password'];
		$contact=$_REQUEST['contact'];
		$address=$_REQUEST['address'];
		$res=mysqli_query($con,"select* from `registration` where `email`='$email'");
		
		
		
		/*while($row=mysqli_fetch_assoc($res))
		{
			
			$dbemail=row['email'];
		echo dbemail;
		}
			if($dbemail==$email)
			{
				echo"Email aleady exist";
			}
			else
			{
				$res1=mysqli_query($con,"insert into `registration`(`name`,`email`,`password`,`contact`,`address`) values('$name','$email','$password','$contact','$address')");
				$res2=mysqli_query($con,"select * from `registration` where `email`='$email'");
				while($row=mysqli_fetch_assoc($res2))
				{
					$dat[]=$row;
					$empt=array("status"=>1,"message"=>$dat);
				}
				echo json_encode($empt);
				
			} */	
	}
	break;
	
	 case "login":
        {
            $email=$_REQUEST['email'];
            $password1=$_REQUEST['password'];
			$password=$password1;
			
            //$password= md5($password1);
            if(!empty($password1) && !empty($email))
			{
				$res2=mysqli_query($con,"SELECT * FROM `registration` WHERE `email`='$email' && `password`='$password' ");
				if(mysqli_num_rows($res2) > 0)
				{	
					while($row=mysqli_fetch_assoc($res2))
					{
						$dat[]=$row;
						$empt=array("status"=>'1',"message"=>$dat);
					}
					echo json_encode($empt);  
				}
				else
				{
                    $empt = array("status"=>'0',"message"=>'Your entered credential did not match');
                    echo json_encode($empt);
				}
			}
			else
			{
                   $empt = array("status"=>'0',"message"=>'Email and Password fields can not be empty');
                   echo json_encode($empt);
            }
        }
		break;
   	
	default:
	{
		echo"error";
	}
}

?>
