<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['addbook']) && $_SESSION['addbook']==1)
{
	$_SESSION['addbook']=0;

	echo "<script>alert('Book added successfully')</script>";

}

?>
<html style="background:url(../images/b.jpg) no-repeat ;background-size: 100% 100%;height:100%;width:100%;font-size:20px;color:white;">
<head>
<script>
function check()
{

flag=true;

m2=document.getElementById("m2");
m3=document.getElementById("m3");
m4=document.getElementById("m4");

if(document.getElementById("bname").value.length==0)
{
m2.innerHTML="*";
m2.style.color="red";
flag=false;
}
if(document.getElementById("w").value.length==0)
{
m3.innerHTML="*";
m3.style.color="red";
flag=false;
}
if(document.getElementById("pyr").value.length==0)
{
m4.innerHTML="*";
m4.style.color="red";
flag=false;
}

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

</script>
</head>
<body >

<form action="insertdb.php">
<input type='submit' name='library' value='My library' style='width:150px;height:40px;background-color:darkred;color:white;margin-left:800px'>
<input type='submit' name='home' value='Home' style='width:150px;height:40px;background-color:darkred;color:white;'>
<input type='submit' name='logout' value='Log Out' style='width:150px;height:40px;background-color:darkred;color:white'>
<h1 style="margin-left:450px">Add new book to library</h1>

<table style="background-color:rgb(255,0,0,0.5);height:400px;width:600px;margin-left:400px">

<tr><td><span id="m2"></span>Bookname :</td><td><input type="text" onkeyup="uncheck2()" name="bname" id="bname" placeholder="Enter Bookname" style='width:200px;height:30px'></td></tr>
<tr><td><span id="m3"></span>Writer :</td><td><input type="text" onkeyup="uncheck3()" name="writer" id="w" placeholder="Enter Writername" style='width:200px;height:30px'></td></tr>
<tr><td><span id="m4"></span>Publication Year:</td><td><input type="text" onkeyup="uncheck4()" name="pdate" id="pyr" placeholder="Enter Publication Year" style='width:200px;height:30px'></td></tr>


<tr><td>BookType   :</td><td>
<select name="type" style="width:200px">
  <option value="academic">Academic</option>
  <option value="horror">Horror</option>
  <option value="novel">Novel</option>
  <option value="sciencefiction">Science Fiction</option>
</select>
</td></tr>
<tr><td>Purpose:</td><td><select name="purpose" style="width:200px">
                             <option value="rent">Rent</option>
                             <option value="sale">Sale</option></td></tr>

<tr><td></td><td align="left" style="padding-top:50px"><input type="submit" onclick="return check();" name="addnewtolibrary" value="ADD TO LIBRARY" style="width:150px;height:40px;background-color:darkred;color:white"></td></tr>
</table>
</form>
</body>
</html>