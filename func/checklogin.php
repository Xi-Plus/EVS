<?php
include_once("sql.php");
function checklogin(){
	if($_COOKIE["EVScookie"]=="")return false;
	$row = mfa(SELECT(array("id"),"session",array(array("cookie",$_COOKIE["EVScookie"])),null,array(0,1)));
	if($row=="")return false;
	return mfa(SELECT(array("id","name"),"account",array(array("id",$row["id"])),null,array(0,1)));
}
?>