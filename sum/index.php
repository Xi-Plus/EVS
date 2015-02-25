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
<title>Sum-EVS</title>
<?php
include_once("../res/meta.php");
meta();
?>
</head>
<body Marginwidth="-1" Marginheight="-1" Topmargin="0" Leftmargin="0">
<?php
include_once("../res/header.php");
$row=SELECT("*","vote_account",null,null,"all");
while($temp=mfa($row)){
	$array[$temp["id"]]=$_POST["v".$temp["id"]];
	str_replace("\r\n","",$temp["vote"]);
	$array=json_decode($temp["vote"],true);
	foreach($array as $i => $v){
		$vote[$i][$v]++;
	}
}
?>
<center>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
	<td class="dfromh" colspan="3">&nbsp;</td>
</tr>
<tr>
	<td align="center" valign="top">
		<h2>投票結果</h2>
		<form action="" method="post">
		<input name="vote" type="hidden" value="true">
		<table border="0" cellpadding="2" cellspacing="0">
		<tr>
			<td align="center" class="datatd">Name</td>
			<td align="center" class="datatd">Sum</td>
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
				<table border="0" cellpadding="2" cellspacing="0">
				<?php
					foreach($array as $i => $name){
				?>
				<tr>
					<td align="center" class="datatd"><?php echo $name; ?></td>
					<td align="center" class="datatd"><?php echo $vote[$temp["id"]][$i]*1; ?></td>
				</tr>
				<?php
					}
				?>
				</table>
			</td>
		</tr>
		<?php
		}
		?>
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