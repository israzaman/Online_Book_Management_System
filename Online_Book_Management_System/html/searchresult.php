<html>
<body style="background:url(../images/table.jpg) no-repeat ;background-size:  100% 100%;height:100%;width:100%;font-size:20px;color:white;">

<?php
session_start();
require("dbconn.php");

if($_REQUEST['category']=='Bookname')
{
	$bookname=$_REQUEST['searchlibrary'];

	$sql="Select * from bookinfo,bookrent where bookinfo.bookname='$bookname' and bookinfo.bookid=bookrent.bookid";
    $data=getJSONFromDB($sql);
    $json=json_decode($data,true);

	
}
else if($_REQUEST['category']=='Writer')
{
	$writer=$_REQUEST['searchlibrary'];
	$sql="Select * from bookinfo,bookrent where bookinfo.writer='$writer' and bookinfo.bookid=bookrent.bookid";
    $data=getJSONFromDB($sql);
    $json=json_decode($data,true);
}
else if($_REQUEST['category']=='Type')
{
	$Type=$_REQUEST['searchlibrary'];
	$sql="Select * from bookinfo,bookrent where bookinfo.booktype='$Type' and bookinfo.bookid=bookrent.bookid";
    $data=getJSONFromDB($sql);
    $json=json_decode($data,true);
}
else if($_REQUEST['category']=='Publicationdate')
{
	$Publicationdate=$_REQUEST['searchlibrary'];
	$sql="Select * from bookinfo,bookrent where bookinfo.publicationdate='$Publicationdate' and bookinfo.bookid=bookrent.bookid";
    $data=getJSONFromDB($sql);
    $json=json_decode($data,true);
	
}
else
{
	echo "<script>alert('Please select category and type something to search')</script>";
}
echo "<form action='insertdb.php'>";

echo "<input type='submit' name='home' value='Home' style='width:150px;height:40px;background-color:darkred;color:white;margin-left:700px'>";
echo "<input type='submit' name='request' value='Request for book' style='width:150px;height:40px;background-color:darkred;color:white;'>";
echo "<input type='submit' name='showuser' value='Show User' style='width:150px;height:40px;background-color:darkred;color:white;'>";
echo "<input type='submit' name='logout' value='Log Out' style='width:150px;height:40px;background-color:darkred;color:white;'>";


echo "<table width='100%' cellpadding='5' border='1'>";
		echo 	"<tbody>";
		echo 		"<tr>
						<th>Book ID</th>
						<th>Book Name</th> 
						<th>Writer</th>
						<th>Type</th>
						<th>Publication date</th>
						<th>Owner</th> 
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
			echo			"<td width='20' align='center'>".$json[$i]['owner']."</td>";
			echo			"<td width='20' align='center'>".$json[$i]['rentorsell']."</td>";
			echo			"<td width='20' align='center'>".$json[$i]['status']."</td>";


			echo		"</tr>";
		}
			echo 	"</tbody>";
			echo "</table>";
	


echo "</form>";




?>
</body>
</body>
</html>