
<!DOCTYPE html>
<?php
require("dbconn.php");
session_start();
if(isset($_SESSION['duplicateuser']) && $_SESSION['duplicateuser']==1)
{
	$_SESSION['duplicateuser']=0;
	echo "<script>alert('username already in use')</script>";
}
if(isset($_SESSION['invalidnum']) && $_SESSION['invalidnum']==1)
{
	$_SESSION['invalidnum']=0;
	echo "<script>alert('invalid number')</script>";
}
if(isset($_SESSION['invalidemail']) && $_SESSION['invalidemail']==1)
{
	$_SESSION['invalidemail']=0;
	echo "<script>alert('invalid email')</script>";
}
if(isset($_SESSION['invaliddate']) && $_SESSION['invaliddate']==1)
{
	$_SESSION['invaliddate']=0;
	echo "<script>alert('invalid date')</script>";
}
if(isset($_SESSION['passmatch']) && $_SESSION['passmatch']==1)
{
	$_SESSION['passmatch']=0;
	echo "<script>alert('password should match')</script>";
}
if(isset($_SESSION['passlength']) && $_SESSION['passlength']==1)
{
	$_SESSION['passlength']=0;
echo "<script>alert('password should be minimum 8 characters')</script>";
}

?>
<html>
<head>
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="../css/registerstyle.css">

<script>

function check()
{

flag=true;

m1=document.getElementById("m1");
m2=document.getElementById("m2");
m3=document.getElementById("m3");
m4=document.getElementById("m4");
m5=document.getElementById("m5");
m6=document.getElementById("m6");
m7=document.getElementById("m7");
m8=document.getElementById("m8");
m9=document.getElementById("m9");
m11=document.getElementById("m11");

if(document.getElementById("first").value.length==0)
{
m1.innerHTML="*";
m1.style.color="red";
m9.innerHTML="*required field";
m9.style.color="red";
flag=false;
}
if(document.getElementById("Last").value.length==0)
{
m2.innerHTML="*";
m2.style.color="red";
m9.innerHTML="*required field";
m9.style.color="red";
flag=false;
}
if(document.getElementById("username").value.length==0)
{
m3.innerHTML="*";
m3.style.color="red";
m9.innerHTML="*required fields";
m9.style.color="red";
flag=false;
}
if(document.getElementById("ph").value.length==0)
{
m4.innerHTML="*";
m4.style.color="red";
m9.innerHTML="*required fields";
m9.style.color="red";
flag=false;
}
if(document.getElementById("mail").value.length==0)
{
m5.innerHTML="*";
m5.style.color="red";
m9.innerHTML="*required fields";
m9.style.color="red";
flag=false;
}
if(document.getElementById("pass").value.length==0)
{
m7.innerHTML="*";
m7.style.color="red";
m9.innerHTML="*required fields";
m9.style.color="red";
flag=false;
}
if(document.getElementById("cpass").value.length==0)
{
m8.innerHTML="*";
m8.style.color="red";
m9.innerHTML="*required fields";
m9.style.color="red";
flag=false;
}
if(document.getElementById("add").value.length==0)
{
m11.innerHTML="*";
m11.style.color="red";
m9.innerHTML="*required fields";
m9.style.color="red";
flag=false;
}
if(document.getElementById("day").value.length==0 || document.getElementById("month").value.length==0 || document.getElementById("year").value.length==0)
{
m6.innerHTML="*";
m6.style.color="red";
m9.innerHTML="*required fields";
m9.style.color="red";
flag=false;
}

if(document.getElementById("male").checked || document.getElementById("female").checked)
{

}
else{
m10.innerHTML="*";
m10.style.color="red";
m9.innerHTML="*required fields";
m9.style.color="red";
flag=false;
}
if(document.getElementById("ph").value.length>12)
{
	alert("invalid number");
	flag=false;

}
if(document.getElementById("pass").value.length!=0 && document.getElementById("pass").value.length<8)
{
	flag=false;
	alert("password should be minimum 8 characters");
}
if(document.getElementById("pass").value!=document.getElementById("cpass").value)
{
	flag=false;
	alert("password not march");
}
if(document.getElementById("mail").value.length!=0)
{
	var x = document.getElementById("mail").value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        alert("Not a valid e-mail address");
        flag=false;
	}
}
<!-- if(document.getElementById("first").value.length!=0 && document.getElementById("last").value.length!=0 && document.getElementById("username").value.length!=0 && document.getElementById("ph").value.length!=0 && document.getElementById("mail").value.length!=0 && document.getElementById("pass").value.length!=0 && document.getElementById("cpass").value.length!=0 && document.getElementById("day").value.length!=0 && document.getElementById("month").value.length!=0 && document.getElementById("year").value.length!=0) -->
<!-- { -->
<!-- m9.innerHTML=""; -->
<!-- } -->
return flag;
}

function uncheck1()
{
m1=document.getElementById("m1");
m1.innerHTML="";
}
function uncheck2()
{
m2=document.getElementById("m2");
m2.innerHTML="";
}
function uncheck3()
{
m3=document.getElementById("m3");
m3.innerHTML="";
}
function uncheck4()
{
m4=document.getElementById("m4");
m4.innerHTML="";
}
function uncheck5()
{
m5=document.getElementById("m5");
m5.innerHTML="";
}
function uncheck6()
{
m6=document.getElementById("m6");
if(document.getElementById("day").value.length!=0 && document.getElementById("month").value.length!=0 && document.getElementById("year").value.length!=0)
{
m6.innerHTML="";
}
}
function uncheck7()
{
m7=document.getElementById("m7");
m7.innerHTML="";
}
function uncheck8()
{
m8=document.getElementById("m8");
m8.innerHTML="";
}
function uncheck11()
{
m11=document.getElementById("m11");
m11.innerHTML="";
}
function uncheck10()
{
m10=document.getElementById("m10");
if(document.getElementById("male").checked==true || document.getElementById("female").checked==true)
{
m10.innerHTML="";
}
}
</script>
</head>

<body>

<h1>Create an Account</h1>

<form action="insertdb.php">
<table>
<tr><td><span id="m1"></span>FirstName:</td><td><input type="text" onkeyup="uncheck1()" name="fname" id="first" placeholder="Enter FirstName"></td></tr>
<tr><td><span id="m2"></span>LastName :</td><td><input type="text" onkeyup="uncheck2()" name="lname" id="Last" placeholder="Enter LastName"></td></tr>
<tr><td><span id="m3"></span>Username :</td><td><input type="text" onkeyup="uncheck3()" name="uname" id="username" placeholder="Enter Username"></td></tr>
<tr><td><span id="m4"></span>Phone no.:</td><td><input type="text" onkeyup="uncheck4()" name="phone" id="ph" placeholder="Enter PhoneNumber"></td></tr>
<tr><td><span id="m11"></span>Address:</td><td><input type="text" onkeyup="uncheck11()" name="address" id="add" placeholder="Enter address"></td><tr>
<tr><td><span id="m5"></span>Email    :</td><td><input type="text" onkeyup="uncheck5()" name="email" id="mail" placeholder="Enter Email"></td></tr>
<tr><td><span id="m10"></span>Gender   :</td><td><input type="radio" onclick="uncheck10()" name="gender" id="male" value="male" checked>Male
          <input type="radio" name="gender" onclick="uncheck10()" id="female" value="female" >Female</td></tr>
<tr><td><span id="m6"></span>Date Of Birth:</td><td>Day:<input type="text" onkeyup="uncheck6()" style="width:50px" name="day" id="day">Month:<input type="text" onkeyup="uncheck6()" style="width:50px" name="month" id="month">Year:<input type="text" onkeyup="uncheck6()" style="width:50px" name="year" id="year"></td></tr>
<tr><td><span id="m7"></span>Password:</td><td><input type="password" onkeyup="uncheck7()" style="width:300px;height:25px;font-size:18px" name="pass" id="pass" placeholder="Enter Password"></td></tr>
<tr><td><span id="m8"></span>Confirm Password:</td><td><input type="password" onkeyup="uncheck8()" style="width:300px;height:25px;font-size:18px" name="cpass" id="cpass" placeholder="Retype Password"></td></tr>
<tr><td></td><td align="right" style="padding-top:50px"><input type="submit" onclick="return check();" value="Submit" name="register" style="width:150px;height:40px"></td></tr>
</table>
<span id="m9"></span>
</form>
</body>
</html>