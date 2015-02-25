<!DOCTYPE html>
<?php
include_once("../func/sql.php");
include_once("../func/url.php");
include_once("../func/checklogin.php");
include_once("../func/consolelog.php");
$data=checklogin();
if($data==false)header("Location: ../login/?from=vote");
?>
<head>
<meta charset="UTF-8">
<title>Vote-EVS</title>
<?php
include_once("../res/meta.php");
meta();
?>
</head>
<body Marginwidth="-1" Marginheight="-1" Topmargin="0" Leftmargin="0">
<?php
include_once("../res/header.php");
if(($_POST["vote"])){
	$row=SELECT("*","vote_votelist",null,null,"all");
	while($temp=mfa($row)){
		$array[$temp["id"]]=$_POST["v".$temp["id"]];
	}
	UPDATE("vote_account",array(array("vote",json_encode($array))),array(array("id",$data["id"])));
	$message="已送出";
}
?>
<center>
<?php
if($message){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" valign="middle" bgcolor="#0A0" class="message" height="50"><?php echo $message;?></td>
	</tr>
</table>
<?php
}
?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
	<td class="dfromh" colspan="3">&nbsp;</td>
</tr>
<tr>
	<td align="center" valign="top">
		<h2>投票列表</h2>
		<form action="" method="post">
		<input name="vote" type="hidden" value="true">
		<table border="0" cellpadding="2" cellspacing="0">
		<tr>
			<td align="center" class="datatd">Name</td>
			<td align="center" class="datatd">Vote</td>
		</tr>
		<?php
		$row=mfa(SELECT("*","vote_account",array(array("id",$data["id"]))));
		str_replace("\r\n","",$row["vote"]);
		$acct=json_decode($row["vote"],true);
		
		$row=SELECT("*","vote_votelist",null,null,"all");
		while($temp=mfa($row)){
			str_replace("\r\n","",$temp["vote"]);
			$array=json_decode($temp["vote"],true);
		?>
		<tr>
			<td class="datatd"><?php echo $temp["name"]; ?></td>
			<td class="datatd">
				<select name="v<?php echo $temp["id"]; ?>">
					<option value="0" selected="selected">廢票</option>
					<?php
						foreach($array as $i => $name){
					?>
					<option value="<?php echo $i; ?>" <?php echo($acct[$temp["id"]]==$i?'selected="selected"':''); ?>><?php echo $name; ?></option>
					<?php
						}
					?>
				</select>
			</td>
		</tr>
		<?php
		}
		?>
		<tr>
			<td align="center" class="datatd" colspan="2"><input name="送出" type="submit" value="送出"></td>
		</tr>
		</table>
		</form>
	</td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</center>
</body>
</html>