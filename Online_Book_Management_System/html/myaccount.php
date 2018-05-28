<html>
<body style="background:url(../images/red.jpg) no-repeat; background-size:  100% 100%;height:100%;width:100%">
<?php
session_start();
$currentid=$_SESSION['currentuserid'];
if(isset($_SESSION['updateaccsuccess']) && $_SESSION['updateaccsuccess']==1)
{
		$_SESSION['updateaccsuccess']=0;

	echo "<script>alert('Account updated successfully')</script>";

}
if(isset($_SESSION['changepasssuccess']) && $_SESSION['changepasssuccess']==1)
{
		$_SESSION['changepasssuccess']=0;

	echo "<script>alert('Password changed successfully')</script>";

}
require("dbconn.php");
$sql="SELECT * FROM user,userinfo where user.userid=$currentid and userinfo.userinfoid=$currentid and user.userid=userinfo.userinfoid";
$data=getJSONFromDB($sql);
$json=json_decode($data,true);
$fname=$json[0]['firstname'];
$lname=$json[0]['lastname'];
$uname=$json[0]['username'];
$phone=$json[0]['phone'];
$address=$json[0]['address'];
$email=$json[0]['email'];
$gender=$json[0]['gender'];
$dob=$json[0]['dateofbirth'];

echo "<form action='insertdb.php'>";
echo "<table style='float:left;height:630px;width:250px;'>";
echo "<tr><td><input type='submit' name='home' value='Home' style='width:250px;height:100px;background-color:black;color:white;font-size:15pt'></td></tr>";
echo "<tr><td><input type='submit' name='myaccount' value='My Account' style='width:250px;height:100px;background-color:black;color:white;font-size:15pt'></td></tr>";
echo "<tr><td><input type='submit' name='changepass' value='Change Password' style='width:250px;height:100px;background-color:black;color:white;font-size:15pt'></td></tr>";
echo "<tr><td><input type='submit' name='deleteacc' value='Delete Account' style='width:250px;height:100px;background-color:black;color:white;font-size:15pt'></td></tr>";
echo "</table>";

echo "<table style='float:left;margin-left:350px;margin-top:100px'>";
echo "<tr><td style='color:white;font-size:15pt'>FirstName:</td><td><input type='text'  name='fname' value='$fname' style='width:200px;height:30px'></td></tr>";
echo "<tr><td style='color:white;font-size:15pt'>LastName :</td><td><input type='text' name='lname' value='$lname' style='width:200px;height:30px'></td></tr>";
echo "<tr><td style='color:white;font-size:15pt'>Username :</td><td><input type='text' name='uname' value='$uname' style='width:200px;height:30px' readonly></td></tr>";
echo "<tr><td style='color:white;font-size:15pt'>Phone no.:</td><td><input type='text' name='phone' value=$phone style='width:200px;height:30px'></td></tr>";
echo "<tr><td style='color:white;font-size:15pt'>Address:</td><td><input type='text'  name='address' value='$address' style='width:200px;height:30px'></td><tr>";
echo "<tr><td style='color:white;font-size:15pt'>Email    :</td><td><input type='text'  name='email' value='$email' style='width:200px;height:30px'></td></tr>";
echo "<tr><td style='color:white;font-size:15pt'>Gender   :</td><td><input type='text'  name='gender' value='$gender' style='width:200px;height:30px'></td></tr>";
echo "<tr><td style='color:white;font-size:15pt'>Date Of Birth:</td><td><input type='text' name='dob' value='$dob' style='width:200px;height:30px'></td></tr>";
echo "<tr><td></td><td align='right' style='padding-top:50px'><input type='submit' value='Update Account' name='updateac' style='width:150px;height:40px;background-color:darkred;color:white'></td></tr>";
echo "</table>";
echo "</form>";
?>
</body>
</html>