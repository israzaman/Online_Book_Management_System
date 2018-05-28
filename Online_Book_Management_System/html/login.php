<!DOCTYPE html>

<?php

	
	
 session_start();
if(isset($_SESSION['loginfail']) && $_SESSION['loginfail']==1)
{
	$_SESSION['loginfail']=0;
	echo "<script>alert('Wrong username or password')</script>";
}
if(isset($_SESSION['registersuccess']) && $_SESSION['registersuccess']==1)
{
	$_SESSION['registersuccess']=0;
echo "<script>alert('successfully registered')</script>";
}
if(isset($_SESSION['delac']) && $_SESSION['delac']==1)
{
	$_SESSION['delac']=0;
echo "<script>alert('Account deleted successfully')</script>";
}
if(isset($_SESSION['er']) && $_SESSION['er']==1)
{
	$_SESSION['er']=0;
	echo "<script>alert('ERROR')</script>";
	
}
?>
<html>

<head>

<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="../css/loginstyle.css">

<script>

function validate(){
	flag=true;
	m = document.getElementById("msg");
	m2=document.getElementById("msg2");
	if(document.getElementById("username").value.length==0){
		m.innerHTML="You must enter username";
		m.style.color="red";
		flag=false;
	}
	if(document.getElementById("password").value.length==0){
		m2.innerHTML="You must enter password";
		m2.style.color="red";
		flag=false;
	}
	return flag;
}
function validate2()
{
    m = document.getElementById("msg");
	
	m.innerHTML="";
	
}
function validate3()
{
m2=document.getElementById("msg2");
m2.innerHTML="";
}
</script>


</head>

<body>

<h1>Find books in new and easy way</h1>
<div id="login">
<form action="test.php" method="post" id="loginform">
<img src="../images/user-icon.png"><br><br>
<b>UserName:<b><br><span id="msg"></span><br><input onkeyup="validate2()" type="text"  id="username" name="uname" placeholder="Enter username"><br>
<b>Password:<b><br><span id="msg2"></span><br><input type="password" onkeyup="validate3()" id="password" name="pass" placeholder="Enter password"><br><br>
<input type="submit" onclick="return validate();" name="submit" value="Log In"><br><br>
</form>
<a href="register.php">REGISTER</a>
</div>
</body>




</html>