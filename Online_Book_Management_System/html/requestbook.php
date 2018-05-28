<html>
<body style="background:url(../images/b.jpg) no-repeat ;background-size:  100% 100%;height:100%;width:100%;font-size:20px;color:white;">

<?php
session_start();
require('dbconn.php');
if(isset($_REQUEST['search']))
{
	if($_REQUEST['bid']=='')
	{
			echo "<script>alert('Please enter bookid to search')</script>";
	}
	else
	{
	$bookid=$_REQUEST['bid'];
	$sql="SELECT * from bookinfo,bookrent where bookinfo.bookid=$bookid and bookrent.bookid=$bookid and bookinfo.bookid=bookrent.bookid";
	$data=getJSONFromDB($sql);
	$json=json_decode($data,true);
	if($json==[])
	{
				echo "<script>alert('No results found')</script>";

	}
	else
	{
	$bookname=$json[0]['bookname'];
	$writer=$json[0]['writer'];
	$type=$json[0]['type'];
	$pdate=$json[0]['publicationdate'];
	$purpose=$json[0]['rentorsell'];
	$status=$json[0]['status'];
echo "<form action='requestbook.php'>";
echo "<input type='submit' name='home' value='Home' style='width:150px;height:40px;background-color:darkred;color:white;margin-left:1000px'>";
echo "<input type='submit' name='logout' value='Log Out' style='width:150px;height:40px;background-color:darkred;color:white'>";

echo "<table style='background-color:rgb(255,0,0,0.5);height:400px;width:600px;margin-left:400px;margin-top:80px;font-size:18pt'>";

echo "<tr><td>BookID:</td><td><input type='text'  name='bid' value='$bookid' ></td><td>
<input type='submit' name='search' value='Search' style='height:30px;width:100px;'></td></tr>";

echo "<tr><td>Bookname:</td><td><input type='text'  name='bname' value='$bookname'></td></tr>";
echo "<tr><td>Writer :</td><td><input type='text' name='writer' value='$writer'></td></tr>";
echo "<tr><td>Type :</td><td><input type='text' name='type' value='$type'></td></tr>";
echo "<tr><td>Publicationdate:</td><td><input type='text' name='pdate' value='$pdate'></td></tr>";
echo "<tr><td>Purpose:</td><td><input type='text' name='purpose' value='$purpose'></td></tr>";
echo "<tr><td>Status:</td><td><input type='text' name='status' value='$status'></td></tr>";

echo "</table>";
echo "<input type='submit' name='sendreq' value='Send Request' style='width:100px;height:40px;margin-left:900px;background-color:darkred;color:white'>";
echo "</form>";
	}
}
}
else
{
	echo "<form action='requestbook.php'>";
echo "<input type='submit' name='home' value='Home' style='width:150px;height:40px;background-color:darkred;color:white;margin-left:1000px'>";
echo "<input type='submit' name='logout' value='Log Out' style='width:150px;height:40px;background-color:darkred;color:white'>";

echo "<table style='background-color:rgb(255,0,0,0.5);height:400px;width:600px;margin-left:400px;margin-top:80px;font-size:18pt'>";

echo "<tr><td>BookID:</td><td><input type='text'  name='bid'  ></td><td>
<input type='submit' name='search' value='Search' style='height:30px;width:100px;'></td></tr>";
echo "<tr><td>Bookname:</td><td><input type='text'  name='bname' ></td></tr>";
echo "<tr><td>Writer :</td><td><input type='text' name='writer'></td></tr>";
echo "<tr><td>Type :</td><td><input type='text' name='type' ></td></tr>";
echo "<tr><td>Publicationdate:</td><td><input type='text' name='pdate' ></td></tr>";
echo "<tr><td>Purpose:</td><td><input type='text' name='purpose' ></td></tr>";
echo "<tr><td>Status:</td><td><input type='text' name='status' ></td></tr>";

echo "</table>";
echo "<input type='submit' name='sendreq' value='Send Request' style='width:100px;height:40px;margin-left:900px;background-color:darkred;color:white'>";
echo "</form>";
}
if(isset($_REQUEST['sendreq']))
{
	$currentid=$_SESSION['currentuserid'];
	$bookid=$_REQUEST['bid'];
	$q="Select owner,status from bookrent where bookid=$bookid";
	$data=getJSONFromDB($q);
	$json=json_decode($data,true);
	$owner=$json[0]['owner'];
	$stat=$json[0]['status'];
	if($currentid==$owner)
	{
		echo "<script>alert('error')</script>";
		
	}
	else
	{
		if($stat=='booked')
		{
					echo "<script>alert('already booked')</script>";

		}
		else{
	$sql="Update bookrent SET borrower='$currentid',status='booked' where bookid=$bookid";
	updateDB($sql);

	
		if(isset($_SESSION['success']) && $_SESSION['success']==1)
		{
			echo "<script>alert('Request sent successfully')</script>";
			// header('location:requestbook.php');

		}
		}
	}
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