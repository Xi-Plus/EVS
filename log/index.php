<html>
<?php
include_once("../func/sql.php");
include_once("../func/url.php");
include_once("../func/checklogin.php");
include_once("../func/consolelog.php");
$error="";
$message="";
$data=checklogin();
if($data==false)header("Location: ../login/?from=managebook");
else if($data["power"]<=1){
	$error="你沒有權限";
	insertlog($data["id"],0,"managebook",false,"no power");
	?><script>setTimeout(function(){history.back();},1000);</script><?php
}
?>
<head>
<meta charset="UTF-8">
<title>Log-EDAMS</title>
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
	if($data["power"]>=2){
?>
<center>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
	<td colspan="2" height="20"></td>
</tr>
<tr>
	<td colspan="2" align="center"><h1>log</h1></td>
</tr>
<tr>
	<td align="center">
		<table border="0" cellspacing="3" cellpadding="0">
		<tr>
			<td>
			<form action="" method="get">
				<input name="page" type="hidden" value="<?php echo ($_GET["page"]-1); ?>">
				<input name="" type="submit" value="上一頁" <?php echo ($_GET["page"]==0?"style='display:none;'":""); ?>>
			</form>
			</td>
			<td>
			<form action="" method="get"><input name="page" type="hidden" value="<?php echo ($_GET["page"]+1); ?>"><input name="" type="submit" value="下一頁"></form>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2" align="center">
		<table border="1" cellspacing="0" cellpadding="2">
		<tr>
			<td>operate</td>
			<td>affect</td>
			<td>type</td>
			<td>result</td>
			<td>action</td>
			<td>time</td>
		</tr>
		<?php
		$page=0;
		if(is_numeric($_GET["page"]))$page=$_GET["page"];
		$row=SELECT("*","log",null,[["time","DESC"]],[($page*30),30]);
		while($temp=mfa($row)){
		?>
			<tr>
			<td><?php echo $temp["operate"]; ?></td>
			<td><?php echo $temp["affect"]; ?></td>
			<td><?php echo $temp["type"]; ?></td>
			<td><?php echo $temp["result"]; ?></td>
			<td><?php echo $temp["action"]; ?></td>
			<td><?php echo $temp["time"]; ?></td>
			</tr>
		<?php
		}
		?>
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