<html>
<body>
<?php
require("dbconn.php");
session_start();
$_SESSION['loginfail']=0;
$uname=$_REQUEST["uname"];
$pass=$_REQUEST["pass"];
$error=0;
$sql="SELECT * FROM user";
$data=getJSONFromDB($sql);
$json=json_decode($data,true);
for($i=0;$i<sizeof($json);$i++)
{
	if($_REQUEST['uname']==$json[$i]['username'] && $_REQUEST['pass']==$json[$i]['password'] )
	{
		$error=1;
		$_SESSION['currentuserid']=$json[$i]['userid'];
		header('location:homepage.html');
		
		
	}
}
if($error==0)
{
	 $_SESSION['loginfail']=1;
			header('location:login.php');
}



?>
</body>
</html>