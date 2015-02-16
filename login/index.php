<html>
<?php
include_once("../func/checklogin.php");
include_once("../func/sql.php");
include_once("../func/url.php");
include_once("../func/log.php");
$error="";
$message="";
$noshow=true;
$nosignup=true;
if(checklogin()){
	$message="你已經登入了";
	$noshow=false;
	?><script>setTimeout(function(){history.back();},1000)</script><?php
}else if(isset($_POST['user'])){
	$row = mfa(SELECT(array("id","pwd"),"account",array(array("id",$_POST['user']))));
	if($row==""){
		$error="無此帳號";
		insertlog(0,0,"login",false,"no user");
	}else if($row["pwd"]!=$_POST["pwd"]){
		$error="密碼錯誤";
		insertlog(0,$row["id"],"login",false,"wrong password");
	}else{
		$cookie=md5(uniqid(rand(),true));
		setcookie("ELMScookie", $cookie, time()+86400*7, "/");
		INSERT("session",array(array("id",$row["id"]),array("cookie",$cookie)));
		insertlog(0,$row["id"],"login");
		$message="登入成功";
		$noshow=false;
		?><script>setTimeout(function(){location="../<?php echo ($_GET["from"]==""?"home":$_GET["from"]);?>";},3000)</script><?php
	}
}
?>
<head>
<meta charset="UTF-8">
<title>登入-EDAMS </title>
<link href="login.css" rel="stylesheet" type="text/css">
<?php
include_once("../res/meta.php");
meta();
?>
</head>
<body Marginwidth="-1" Marginheight="-1" Topmargin="0" Leftmargin="0">
<?php
	include_once("../res/header.php");
	if($error!=""){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" valign="middle" bgcolor="#F00" class="message"><?php echo $error;?></td>
	</tr>
</table>
<?php
	}
	if($message!=""){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" valign="middle" bgcolor="#0A0" class="message"><?php echo $message;?></td>
	</tr>
</table>
<?php
	}
	if($noshow){
?>
<center>
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="dfromh" colspan="3"></td>
	</tr>
	<tr>
		<td valign="top">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center"><h1>登入</h1></td>
				</tr>
				<tr>
					<td>
						<form method="post">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td valign="top" class="inputleft">座號：</td>
									<td valign="top" class="inputright"><input name="user" type="text" value="<?php echo $_POST['user'];?>" maxlength="32"></td>
								</tr>
								<tr>
									<td valign="top" class="inputleft">密碼：</td>
									<td valign="top" class="inputright"><input name="pwd" type="password"></td>
								</tr>
								<tr>
									<td height="45" colspan="2" align="center" valign="top"><input type="submit" value="登入"></td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</center>
<?php
	}
?>
</body>
</html>