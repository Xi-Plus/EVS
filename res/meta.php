<link href="../res/css.css" rel="stylesheet" type="text/css">
<link rel="icon" href="../res/icon.ico" type="image/x-icon">
<?php
function meta($array=null){
	$meta["title"]="EVS";
	$meta["type"]="website";
	$meta["description"]="此系統用於投票。";
	$meta["url"]="http://".url();
	$meta["image"]="";
	if($array!=null){
		foreach($array as $temp){
			$meta[$temp[0]]=$temp[1];
		}
	}
	?>
	<meta property="og:title" content="<?php echo $meta["title"];?>"/>
	<meta property="og:type" content="<?php echo $meta["type"];?>"/>
	<meta property="og:description" content="<?php echo $meta["description"];?>"/>
	<meta property="og:url" content="<?php echo $meta["url"];?>"/>
	<meta property="og:image" content="<?php echo $meta["image"];?>"/>
<?php
}
?>