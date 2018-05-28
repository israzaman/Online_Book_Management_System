<html>
<body style="background:url(../images/b.jpg) no-repeat ;background-size:  100% 100%;height:100%;width:100%;font-size:20px;color:white;">

<?php
session_start();
$_SESSION['updatebook']=0;
$_SESSION['delbook']=0;
$_SESSION['searchb']=0;

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
		$_SESSION['searchb']=1;
		header('location:mylibrary.php');

	}
	else{
	$bookname=$json[0]['bookname'];
	$writer=$json[0]['writer'];
	$type=$json[0]['type'];
	$pdate=$json[0]['publicationdate'];
	$purpose=$json[0]['rentorsell'];
	echo "<form action='updatelibrary.php'>";
echo	"<input type='submit' name='library' value='My library' style='width:150px;height:40px;background-color:darkred;color:white;margin-left:800px'>";

echo "<input type='submit' name='home' value='Home' style='width:150px;height:40px;background-color:darkred;color:white;'>";
echo "<input type='submit' name='logout' value='Log Out' style='width:150px;height:40px;background-color:darkred;color:white'>";

echo "<table style='background-color:rgb(255,0,0,0.5);height:400px;width:600px;margin-left:400px;font-size:18pt;margin-top:100px;'>";

echo "<tr><td>BookID:</td><td><input type='text'  name='bid' value='$bookid' style='width:200px'></td><td>
<input type='submit' name='search' value='Search' style='height:30px;width:100px;'></td></tr>";
echo "<tr><td>Bookname:</td><td><input type='text'  name='bname' value='$bookname' style='width:200px'></td></tr>";
echo "<tr><td>Writer :</td><td><input type='text' name='writer' value='$writer' style='width:200px'></td></tr>";
echo "<tr><td>Type :</td><td><select name='type'  name='n' style='width:200px'>
                             <option value='novel' selected>Novel</option>
                             <option value='academic'  selected>Academic</option></td></tr>";
echo "<tr><td>Publicationdate:</td><td><input type='text' name='pdate' value='$pdate' style='width:200px'></td></tr>";
echo "<tr><td>Purpose:</td><td><select name='purpose' value='$purpose' style='width:200px'>
                             <option value='rent' selected>Rent</option>
                             <option value='sale' selected>Sale</option></td></tr>";
echo "</table>";
echo "<input type='submit' name='updatelibrary' value='Update' style='width:150px;height:40px;background-color:darkred;color:white;font-size:12pt;margin-left:700px'>";
echo "<input type='submit' name='deletelibrary' value='Delete' style='width:150px;height:40px;background-color:darkred;color:white;font-size:12pt'>";
echo "</form>";
	
	 }
	}
}
else
{
echo "<form action='updatelibrary.php'>";
echo "<input type='submit' name='library' value='My library' style='width:150px;height:40px;background-color:darkred;color:white;margin-left:800px'>";
echo "<input type='submit' name='home' value='Home' style='width:150px;height:40px;background-color:darkred;color:white;'>";
echo "<input type='submit' name='logout' value='Log Out' style='width:150px;height:40px;background-color:darkred;color:white'>";

echo "<table style='background-color:rgb(255,0,0,0.5);height:400px;width:600px;margin-left:400px;margin-top:100px;font-size:18pt'>";

echo "<tr><td>BookID:</td><td><input type='text'  name='bid' style='width:200px'></td><td>
<input type='submit' name='search' value='Search' style='height:30px;width:100px;'></td></tr>";
echo "<tr><td>Bookname:</td><td><input type='text'  name='bname' style='width:200px'></td></tr>";
echo "<tr><td>Writer :</td><td><input type='text' name='writer' style='width:200px'></td></tr>";
echo "<tr><td>Type :</td><td><select name='type' style='width:200px'>
                             <option value='novel'>Novel</option>
                             <option value='academic'>Academic</option>
							  <option value='horror'>Horror</option>
						   <option value='sciencefiction'>Science Fiction</option>

</td></tr>";
echo "<tr><td>Publicationdate:</td><td><input type='text' name='pdate' style='width:200px'></td></tr>";
echo "<tr><td>Purpose:</td><td><select name='purpose' style='width:200px'>
                             <option value='rent'>Rent</option>
                             <option value='sale'>Sale</option></td></tr>";
echo "</table>";
echo "<input type='submit' name='updatelibrary' value='Update' style='width:150px;height:40px;background-color:darkred;color:white;font-size:12pt;margin-left:700px'>";
echo "<input type='submit' name='deletelibrary' value='Delete' style='width:150px;height:40px;background-color:darkred;color:white;font-size:12pt'>";
echo "</form>";
}
if(isset($_REQUEST['updatelibrary']))
{
	
	$bookid=$_REQUEST['bid'];
	$bookname=$_REQUEST['bname'];
	$writer=$_REQUEST['writer'];
	$type=$_REQUEST['type'];
	$pdate=$_REQUEST['pdate'];
	$purpose=$_REQUEST['purpose'];
	$q="Update bookrent SET rentorsell='$purpose' where bookid=$bookid";
	updateDB($q);
	$sql="Update bookinfo SET bookname='$bookname',writer='$writer',booktype='$type',publicationdate=$pdate where bookid=$bookid";
	updateDB($sql);
	
	if(isset($_SESSION['success']) && $_SESSION['success']==1)
	{
		$_SESSION['updatebook']=1;
		header('location:mylibrary.php');

	}
}
if(isset($_REQUEST['deletelibrary']))
{
	$bookid=$_REQUEST['bid'];
	$q="Delete from bookrent where bookid=$bookid";
	updateDB($q);
	$sql="Delete from bookinfo where bookid=$bookid";
	updateDB($sql);
	
	if(isset($_SESSION['success']) && $_SESSION['success']==1)
	{

		$_SESSION['delbook']=1;
		header('location:mylibrary.php');
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
if(isset($_REQUEST['library']))
{
		header('location:mylibrary.php');

}

?>
</body>
</html>