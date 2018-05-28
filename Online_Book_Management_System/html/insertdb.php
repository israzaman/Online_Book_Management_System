<?php
session_start();
$_SESSION['empty']=0;
require("dbconn.php");
$sql1="";
$sql="";
$q="";
$query="";
$ok=0;
$_SESSION['duplicateuser']=0;
$_SESSION['invalidnum']=0;
$_SESSION['invalidemail']=0;
$_SESSION['invaliddate']=0;
$_SESSION['passmatch']=0;
$_SESSION['passlength']=0;
$_SESSION['updateaccsuccess']=0;
$_SESSION['changepasssuccess']=0;
$_SESSION['registersuccess']=0;
$_SESSION['passwrong']=0;
$_SESSION['delac']=0;
$_SESSION['addbook']=0;
if(isset($_REQUEST['fname']) && isset($_REQUEST['lname']) && isset($_REQUEST['phone']) && isset($_REQUEST['address']) && isset($_REQUEST['email']) && isset($_REQUEST['pass']) && isset($_REQUEST['gender']) && isset($_REQUEST['day']) && isset($_REQUEST['month']) && isset($_REQUEST['year'])){
	$date=$_REQUEST["year"]."-".$_REQUEST["month"]."-".$_REQUEST["day"];
	$q="SELECT username from user";
	$data=getJSONFromDB($q);
	$json=json_decode($data,true);
		for($i=0;$i<sizeof($json);$i++)
		{
			if($_REQUEST['uname']==$json[$i]['username'])
			{
             $ok=1;
			 $_SESSION['duplicateuser']=1;
			header('location:register.php');
			}
		}
		if($ok==0)
		{
			if(checkdate($_REQUEST['month'],$_REQUEST['day'],$_REQUEST['year']))
						{
							if($_REQUEST['pass']==$_REQUEST['cpass'] && strlen($_REQUEST['pass'])>=8)
							{
								$uname=$_REQUEST['uname'];
								$sql1="INSERT INTO user(usertype,username,password) VALUES ('user','".$_REQUEST['uname']."','".$_REQUEST['pass']."')";
								updateDB($sql1);
								$sql="INSERT INTO userinfo(userinfoid,firstname,lastname,phone,address,email,gender,dateofbirth) VALUES ((select userid from user where username='$uname'),'".$_REQUEST['fname']."','".$_REQUEST['lname']."','".$_REQUEST['phone']."','".$_REQUEST['address']."','".$_REQUEST['email']."','".$_REQUEST['gender']."','$date')";
								updateDB($sql);
								if(isset($_SESSION['success']) && $_SESSION['success']==1)
								{
								    $_SESSION['registersuccess']=1;
                                    header('location:login.php');
								}
							
							}
							else
							{
								if($_REQUEST['pass']!=$_REQUEST['cpass'])
								{
									$_SESSION['passmatch']=1;
                                    header('location:register.php');
								
								}
								if(strlen($_REQUEST['pass'])<8)
								{
									$_SESSION['passlength']=1;
                                    header('location:register.php');
								
								}
							}
						}
						else
						{
						$_SESSION['invaliddate']=1;
                        header('location:register.php');
						}
		}
			// if(is_numeric($_REQUEST['phone']) && strlen($_REQUEST['phone'])<=12)
			// {
				// $check=explode("@",$_GET['email']);

				// if(sizeof($check)==2)
				// {
				// $checkagain=explode(".",$check[1]);

					// if(sizeof($checkagain)==2)
					// {
						// if(checkdate($_REQUEST['month'],$_REQUEST['day'],$_REQUEST['year']))
						// {
							// if($_REQUEST['pass']==$_REQUEST['cpass'] && strlen($_REQUEST['pass'])>=8)
							// {
								// $uname=$_REQUEST['uname'];
								// $sql1="INSERT INTO user(usertype,username,password) VALUES ('user','".$_REQUEST['uname']."','".$_REQUEST['pass']."')";
								// updateDB($sql1);
								// $sql="INSERT INTO userinfo(userid,firstname,lastname,phone,address,email,gender,dateofbirth) VALUES ((select userid from user where username='$uname'),'".$_REQUEST['fname']."','".$_REQUEST['lname']."','".$_REQUEST['phone']."','".$_REQUEST['address']."','".$_REQUEST['email']."','".$_REQUEST['gender']."','$date')";
								// updateDB($sql);
								// if(isset($_SESSION['success']) && $_SESSION['success']==1)
								// {
								    // $_SESSION['registersuccess']=1;
                                    // header('location:login.php');
								// }
							
							// }
							// else
							// {
								// if($_REQUEST['pass']!=$_REQUEST['cpass'])
								// {
									// $_SESSION['passmatch']=1;
                                    // header('location:register.php');
								
								// }
								// if(strlen($_REQUEST['pass'])<8)
								// {
									// $_SESSION['passlength']=1;
                                    // header('location:register.php');
								
								// }
							// }
						// }
						// else
						// {
						// $_SESSION['invaliddate']=1;
                        // header('location:register.php');
						// }
					// }
					// else
					// {
						// $_SESSION['invalidemail']=1;
                        // header('location:register.php');
					
					// }
				// }
				// else
				// {
					// $_SESSION['invalidemail']=1;
					// header('location:register.php');
				
				// }
			// }
			// else
			// {
				// $_SESSION['invalidnum']=1;
				// header('location:register.php');
			// }
		// }

}

if(isset($_REQUEST['updateac']))
{
	$firstname=$_REQUEST['fname'];
	$lastname=$_REQUEST['lname'];
	$contactno=$_REQUEST['phone'];
	$address=$_REQUEST['address'];
	$email=$_REQUEST['email'];
	$gender=$_REQUEST['gender'];
	$birthdate=$_REQUEST['dob'];
	$currentid=$_SESSION['currentuserid'];
	if(is_numeric($_REQUEST['phone']) && strlen($_REQUEST['phone'])<=12)
	{
		$check=explode("@",$_GET['email']);

		if(sizeof($check)==2)
		{
		$checkagain=explode(".",$check[1]);

			if(sizeof($checkagain)==2)
			{
				if($_REQUEST['gender']=='male' || $_REQUEST['gender']=='female')
				{
				
					$sql="UPDATE userinfo SET firstname='$firstname',lastname='$lastname',address='$address',email='$email',phone='$contactno',gender='$gender',dateofbirth='$birthdate' WHERE userid='$currentid'";
					updateDB($sql);
					if(isset($_SESSION['success']) && $_SESSION['success']==1)
					{
							 $_SESSION['updateaccsuccess']=1;
							header('location:myaccount.php');
				
					}	
					else
					{
						echo "<script>alert('invalid gender:male or female')</script>";
					}	
				}
			}
			else
			{
			echo "<script>alert('invalid email')</script>";
			}
		}
		else
		{
		echo "<script>alert('invalid email')</script>";
		}
	}
	else
	{
	echo "<script>alert('invalid number')</script>";
	}
}

if(isset($_REQUEST['home']))
{
	header('location:homepage.html');
}	
if(isset($_REQUEST['myaccount']))
{
	header('location:myaccount.php');
}	
if(isset($_REQUEST['changepass']))
{
	header('location:changepassword.php');
}
if(isset($_REQUEST['change']))
{
	$currentid=$_SESSION['currentuserid'];
	$sql="SELECT password from user where userid=$currentid";
	$data=getJSONFromDB($sql);
	$json=json_decode($data,true);
	$pass=$json[0]['password'];
	if($pass==$_REQUEST['ppass'])
	{
		if($_REQUEST['npass']==$_REQUEST['rnpass'] && strlen($_REQUEST['npass'])>=8)
		{
			$newpass=$_REQUEST['npass'];
			echo $currentid;
			$q="UPDATE user SET password=$newpass where userid='$currentid'";
			updateDB($q);
			if(isset($_SESSION['success']) && $_SESSION['success']==1)
			{
		                  $_SESSION['changepasssuccess']=1;
							header('location:myaccount.php');
		
			}	
		}
		else
		{
			if($_REQUEST['npass']!=$_REQUEST['rnpass'])
			{
				$_SESSION['passmatch']=1;
				header('location:changepassword.php');
			}
			if(strlen($_REQUEST['npass'])<8)
			{
				$_SESSION['passlength']=1;
				header('location:changepassword.php');
			}
		}
	}
	else
	{
		$_SESSION['passwrong']=1;
							header('location:changepassword.php');
	}
}

if(isset($_REQUEST['deleteacc']))
{
	$currentid=$_SESSION['currentuserid'];
	
	$sql="DELETE FROM userinfo WHERE userid=$currentid";
	updateDB($sql);
	$q="DELETE FROM user WHERE userid=$currentid";
	updateDB($q);
	$s="DELETE FROM bookinfo WHERE bookinfo.userid=$currentid";
	updateDB($s);
	$l="DELETE FROM bookrent WHERE owner=$currentid";
	updateDB($l);
	if(isset($_SESSION['success']) && $_SESSION['success']==1)
	{
                $_SESSION['delac']=1;
				header('location:login.php');
	}
}
if(isset($_REQUEST['addnew']))
{
	header('location:addnewlibrary.php');
}
if(isset($_REQUEST['addnewtolibrary']))
{
	$currentid=$_SESSION['currentuserid'];
	$sql="INSERT INTO bookinfo(bookname,userid,writer,type,publicationdate) VALUES ('".$_REQUEST['bname']."',$currentid,'".$_REQUEST['writer']."','".$_REQUEST['type']."','".$_REQUEST['pdate']."')";
	updateDB($sql);
	$q="INSERT INTO bookrent(bookid,owner,rentorsell,status) VALUES ((select MAX(bookid) from bookinfo),$currentid,'".$_REQUEST['purpose']."','available')";
	updateDB($q);
	if(isset($_SESSION['success']) && $_SESSION['success']==1)
	{
		$_SESSION['addbook']=1;
		header('location:mylibrary.php');

	}
}
if(isset($_REQUEST['updateordel']))
{
	header('location:updatelibrary.php');
}	
if(isset($_REQUEST['request']))
{
	header('location:requestbook.php');
}
if(isset($_REQUEST['showuser']))
{
	header('location:showuser.php');
}
if(isset($_REQUEST['logout']))
{
	
    unset($_SESSION['currentuserid']);
	session_unset();
	session_destroy();
	
	 header('location:login.php');
	

}
if(isset($_REQUEST['library']))
{
	header('location:mylibrary.php');
}

?>