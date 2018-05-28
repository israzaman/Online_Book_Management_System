<?php
require("dbconn.php");
$q = $_REQUEST["searchlibrary"];

$hint = "";
if(isset($_REQUEST['category']) && $_REQUEST['category']=='Bookname'){
	$sql="select distinct bookname from bookinfo ";
$data=getJSONFromDB($sql);
$json=json_decode($data,true);
	if ($q !== "") {
		$q = strtolower($q);
		$len=strlen($q);
		for($i=0;$i<sizeof($json);$i++){
			if (stristr($q, substr($json[$i]['bookname'], 0, $len))) {
				if ($hint === "") {
					$hint = $json[$i]['bookname'];
				} else {
					$name=$json[$i]['bookname'];
					$hint .= ", $name";
				}
			}
		}
	}
 }
 else if(isset($_REQUEST['category']) && $_REQUEST['category']=='Writer'){
	 $sql="select distinct writer from bookinfo ";
$data=getJSONFromDB($sql);
$json=json_decode($data,true);
	if ($q !== "") {
		$q = strtolower($q);
		$len=strlen($q);
		for($i=0;$i<sizeof($json);$i++){
			if (stristr($q, substr($json[$i]['writer'], 0, $len))) {
				if ($hint === "") {
					$hint = $json[$i]['writer'];
				} else {
					$name=$json[$i]['writer'];
					$hint .= ", $name";
				}
			}
		}
	}
 }
  else if(isset($_REQUEST['category']) && $_REQUEST['category']=='Type'){
	  $sql="select distinct booktype from bookinfo ";
$data=getJSONFromDB($sql);
$json=json_decode($data,true);
	if ($q !== "") {
		$q = strtolower($q);
		$len=strlen($q);
		for($i=0;$i<sizeof($json);$i++){
			if (stristr($q, substr($json[$i]['booktype'], 0, $len))) {
				if ($hint === "") {
					$hint = $json[$i]['booktype'];
				} else {
					$name=$json[$i]['booktype'];
					$hint .= ", $name";
				}
			}
		}
	}
 }
  else if(isset($_REQUEST['category']) && $_REQUEST['category']=='Publicationdate'){
	  $sql="select distinct publicationdate from bookinfo ";
$data=getJSONFromDB($sql);
$json=json_decode($data,true);
	if ($q !== "") {
		$q = strtolower($q);
		$len=strlen($q);
		for($i=0;$i<sizeof($json);$i++){
			if (stristr($q, substr($json[$i]['publicationdate'], 0, $len))) {
				if ($hint === "") {
					$hint = $json[$i]['publicationdate'];
				} else {
					$name=$json[$i]['publicationdate'];
					$hint .= ", $name";
				}
			}
		}
	}
 }
  else if(isset($_REQUEST['category']) && $_REQUEST['category']==''){
	echo "select atleast one category to search";
	echo "<br>";
 }
//Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no suggestion" : $hint;




?>