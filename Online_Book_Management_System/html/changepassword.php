<html>
<body style="background:url(../images/red.jpg) no-repeat; background-size:  100% 100%;height:100%;width:100%">
<?php
session_start();
if(isset($_SESSION['passwrong']) && $_SESSION['passwrong']==1)
{
	$_SESSION['passwrong']=0;
	echo "<script>alert('Wrong password')</script>";

}
if(isset($_SESSION['passlength']) && $_SESSION['passlength']==1)
{
	$_SESSION['passlength']=0;
	echo "<script>alert('password should be minimum 8 characters')</script>";

}
if(isset($_SESSION['passmatch']) && $_SESSION['passmatch']==1)
{
	$_SESSION['passmatch']=0;
	echo "<script>alert('password not match')</script>";

}
echo "<form action='insertdb.php'>";
echo "<table style='float:left;height:630px;width:250px'>";
echo "<tr><td><input type='submit' name='home' value='Home' style='width:250px;height:100px;background-color:black;color:white;font-size:15pt'></td></tr>";
echo "<tr><td><input type='submit' name='myaccount' value='My Account' style='width:250px;height:100px;background-color:black;color:white;font-size:15pt'></td></tr>";
echo "<tr><td><input type='submit' name='changepass' value='Change Password' style='width:250px;height:100px;background-color:black;color:white;font-size:15pt'></td></tr>";
echo "<tr><td><input type='submit' name='deleteacc' value='Delete Account' style='width:250px;height:100px;background-color:black;color:white;font-size:15pt'></td></tr>";
echo "</table>";

echo "<table style='float:left;margin-left:350px;margin-top:200px'>";
echo "<tr><td style='color:white;font-size:15pt'>Present Password:</td><td><input type='password'  name='ppass' placeholder='Enter present password' style='width:200px;height:30px'></td></tr>";
echo "<tr><td style='color:white;font-size:15pt'>New Password :</td><td><input type='password' name='npass' placeholder='Enter new password' style='width:200px;height:30px'></td></tr>";
echo "<tr><td style='color:white;font-size:15pt'>Retype Password :</td><td><input type='password' name='rnpass' placeholder='Retype new password' style='width:200px;height:30px'></td></tr>";
echo "<tr style='height:50px'></tr>";
echo "<tr><td></td><td><input type='submit' name='change' value='Change Password' style='width:150px;height:40px;background-color:darkred;color:white'></td></tr>";
echo "</table>";
echo "</form>";



?>
</body>
</html>