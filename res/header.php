<?php
include_once("../func/url.php");
include_once("../func/checklogin.php");
include_once("../func/sql.php");
$login=checklogin();
?>
<script src="../res/jquery.min.js"></script>
<script>
/*
function keyFunction(){
	if ((event.altKey) && (event.keyCode!=18)){
		switch(event.keyCode){
			case 49: location="../data";break;
			case 50: location="../search";break;
			case 51: location="../user";break;
			<?php
			if($login["power"]>=2){
			?>
			case 52: location="../borrow";break;
			case 53: location="../return";break;
			case 54: location="../managebook";break;
			case 55: location="../manageuser";break;
			case 56: location="../log";break;
			<?php
			}
			?>
			case 48: location="../<?php echo ($login?"logout":"login");?>";break;
		}
	}
}
window.onkeydown=keyFunction;
document.onkeydown=keyFunction;
*/
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%" height="80" align="center" valign="middle" bgcolor="#F0F0F0" style="font-weight: bold;">
			<span style="font-size: 36px; color: #888;">E-</span><span style="font-size: 36px">V</span><span style="font-size: 36px; color: #888;">S</span>
			<br>
			<span style="color: #999">E-Voting Systems</span><br>
			<span style="color: #999">電子化投票系統</span>
		</td>
		<td bgcolor="#F0F0F0" style="text-align: right" colspan="2"><div id="headerimg" style="display:none;"></div></td>
		<script>if(document.body.clientWidth>=700)headerimg.style.display="";</script>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="20" valign="middle" bgcolor="#0000FF" style="color: #FFF">
			<div style="float:left;">&nbsp;&nbsp;&nbsp;&nbsp;<a href="../home" target="_parent" style="color:#FFF" >Home</a>&nbsp;|&nbsp;<a href="../vote" target="_parent" style="color:#FFF">Vote</a></div><?php if($login["power"]>=2){ ?><div style="float:left;"></div>
			<?php } ?>
		</td>
		<td height="20" valign="middle" bgcolor="#0000FF" style="text-align: right; color: #FFF;">
			<?php 
			if($login==false){
			?>
			<a href="../login" target="_parent" style="color:#FFF">登入/註冊</a>
			<?php
			}
			else{echo "目前登入: ".$login["id"]."(".het($login["name"]).")";
			?>
			<a href="../logout" target="_parent" style="color:#FFF">登出</a>
			<?php
			}
			?>
			&nbsp;&nbsp;
		</td>
	</tr>
</table>