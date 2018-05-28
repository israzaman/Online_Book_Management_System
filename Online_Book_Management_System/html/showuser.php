<html>
<body style="background:url(../images/b.jpg) no-repeat ;background-size:  100% 100%;height:100%;widht:100%;font-size:20px;color:white;">

<?php
session_start();
$_SESSION['showuser']=0;
require('dbconn.php');
if(isset($_REQUEST['search']))
{
	if($_REQUEST['uid']=='')
	{
			echo "<script>alert('Please enter userid to search')</script>";
	}
	else
	{
	$userid=$_REQUEST['uid'];
	$sql="SELECT * from userinfo where userinfoid=$userid";
	$data=getJSONFromDB($sql);
	$json=json_decode($data,true);
	if($json==[])
	{
		echo "<script>alert('No results found')</script>";

	}
	else
	{
	$firstname=$json[0]['firstname'];
	$lastname=$json[0]['lastname'];
	$phone=$json[0]['phone'];
	$address=$json[0]['address'];
	$email=$json[0]['email'];
	$gender=$json[0]['gender'];
echo "<form action='showuser.php'>";
echo "<input type='submit' name='home' value='Home' style='width:150px;height:40px;background-color:darkred;color:white;margin-left:1000px'>";
echo "<input type='submit' name='logout' value='Log Out' style='width:150px;height:40px;background-color:darkred;color:white'>";

echo "<table style='background-color:rgb(255,0,0,0.5);height:400px;width:600px;margin-left:400px;margin-top:100px;font-size:18pt'>";
echo "<tr><td>UserID:</td><td><input type='text'  name='uid' value='$userid' style='width:200px' ></td><td>
<input type='submit' name='search' value='Search' style='height:30px;width:100px;'></td></tr>";

echo "<tr><td>FirstName:</td><td><input type='text'  name='fname' value='$firstname' style='width:200px'></td></tr>";
echo "<tr><td>LastName :</td><td><input type='text' name='lname' value='$lastname' style='width:200px'></td></tr>";
echo "<tr><td>Phone :</td><td><input type='text' name='phone' value='$phone' style='width:200px'></td></tr>";
echo "<tr><td>Address:</td><td><input type='text' name='address' value='$address' style='width:200px'></td></tr>";
echo "<tr><td>Email:</td><td><input type='text' name='email' value='$email' style='width:200px'></td></tr>";
echo "<tr><td>Gender:</td><td><input type='text' name='gender' value='$gender' style='width:200px'></td></tr>";

echo "</table>";
echo "</form>";
	}
	}
}
else
{
	echo "<form action='showuser.php'>";
echo "<input type='submit' name='home' value='Home' style='width:150px;height:40px;background-color:darkred;color:white;margin-left:1000px'>";
echo "<input type='submit' name='logout' value='Log Out' style='width:150px;height:40px;background-color:darkred;color:white'>";
echo "<table style='background-color:rgb(255,0,0,0.5);height:400px;width:600px;margin-left:400px;margin-top:100px;font-size:18pt'>";
echo "<tr><td>UserID:</td><td><input type='text'  name='uid'  style='width:200px'></td><td>
<input type='submit' name='search' value='Search' style='height:30px;width:100px;'></td></tr>";

echo "<tr><td>FirstName:</td><td><input type='text'  name='fname' style='width:200px'></td></tr>";
echo "<tr><td>LastName :</td><td><input type='text' name='lname' style='width:200px'></td></tr>";
echo "<tr><td>Phone :</td><td><input type='text' name='phone' style='width:200px'></td></tr>";
echo "<tr><td>Address:</td><td><input type='text' name='address' style='width:200px'></td></tr>";
echo "<tr><td>Email:</td><td><input type='text' name='email' style='width:200px'></td></tr>";
echo "<tr><td>Gender:</td><td><input type='text' name='gender' style='width:200px'></td></tr>";
echo "</table>";
echo "</form>";
}
if(isset($_REQUEST['home']))
{
	header('location:homepage.html');
}
if(isset($_REQUEST['logout']))
{
	header('location:login.php');
}


?>
</body>
</html>