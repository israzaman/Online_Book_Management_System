<html>
<body style="background:url(../images/table.jpg) no-repeat ;background-size:  100% 100%;height:100%;width:100%;font-size:20px;color:white;">
<?php
session_start();
$_SESSION['er']=0;
if(isset($_SESSION['updatebook']) && $_SESSION['updatebook']==1)
{
	$_SESSION['updatebook']=0;
			echo "<script>alert('Book updated successfully')</script>";

}
if(isset($_SESSION['delbook']) && $_SESSION['delbook']==1)
{
	$_SESSION['delbook']=0;
			echo "<script>alert('Book deleted successfully')</script>";

}
if(isset($_SESSION['addbook']) && $_SESSION['addbook']==1)
{
	$_SESSION['addbook']=0;

	echo "<script>alert('Book added successfully')</script>";

}
if(isset($_SESSION['searchb']) && $_SESSION['searchb']==1)
{
	$_SESSION['searchb']=0;

	echo "<script>alert('No result found')</script>";

}
if(isset($_SESSION['showuser']) && $_SESSION['showuser']==1)
{
	$_SESSION['showuser']=0;

	echo "<script>alert('No result found')</script>";

}

require("dbconn.php");
if(isset($_SESSION['currentuserid']))
{
$currentid=$_SESSION['currentuserid'];
$sql="Select * from bookinfo,bookrent where bookinfo.userid=$currentid and bookrent.owner=$currentid and bookinfo.bookid=bookrent.bookid";
$data=getJSONFromDB($sql);
$json=json_decode($data,true);
echo "<form action='insertdb.php'>";
echo "<input type='submit' name='home' value='Home' style='width:150px;height:40px;background-color:darkred;color:white;margin-left:600px'>";
echo "<input type='submit' name='addnew' value='ADD NEW' style='width:150px;height:40px;background-color:darkred;color:white;'>";
echo "<input type='submit' name='updateordel' value='Update/Delete' style='width:150px;height:40px;background-color:darkred;color:white'>";
echo "<input type='submit' name='showuser' value='Show Requested User' style='width:150px;height:40px;background-color:darkred;color:white'>";
echo "<input type='submit' name='logout' value='Log Out' style='width:150px;height:40px;background-color:darkred;color:white'>";

echo "<table width='100%' cellpadding='5' border='1' style='margin-top:20px'>";
		echo 	"<tbody>";
		echo 		"<tr>
						<th>Book ID</th>
						<th>Book Name</th> 
						<th>Writer</th>
						<th>Type</th>
						<th>Publication date</th>
						<th>Borrower</th> 
						<th>Purpose</th> 
						<th>Status</th>
						
					</tr>";
		for($i=0;$i<sizeof($json);$i++)
		{		
			echo		"<tr>";
			echo			"<td width='20' align='center'>".$json[$i]['bookid']."</td>";
			echo			"<td width='30' align='center'>".$json[$i]['bookname']."</td>";
			echo			"<td width='30' align='center'>".$json[$i]['writer']."</td>";
			echo			"<td width='20' align='center'>".$json[$i]['type']."</td>";
			echo			"<td width='20' align='center'>".$json[$i]['publicationdate']."</td>";
			echo			"<td width='20' align='center'>".$json[$i]['borrower']."</td>";
			echo			"<td width='20' align='center'>".$json[$i]['rentorsell']."</td>";
			echo			"<td width='20' align='center'>".$json[$i]['status']."</td>";

			echo		"</tr>";
		}
			echo 	"</tbody>";
			echo "</table>";
	



echo "</form>";

}else
{
	$_SESSION['er']=1;
	header('location:login.php');
	
}

?>
</body>
</html>