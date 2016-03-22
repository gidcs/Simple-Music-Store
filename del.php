<?php
	
require_once("config.inc.php");

if(isset($_GET["no"])){
	$wanted = $_GET["no"] - 1;
	$lines = file($list_file);
	foreach($lines as $key=>$line){
		if($key==$wanted){
			$field = explode(",", $line);
			$del_file = str_replace("\n","",$field[1]);
		}
		else{
			$new_lines.=$line;
		}
	}
	if(!empty($del_file)){
		$fp = fopen($list_file,"w");
		flock($fp, LOCK_SH);
		fwrite($fp, $new_lines);
		flock($fp, LOCK_UN);
		fclose($fp);
		@unlink($song_folder.$del_file);
	}
}
header("Location: /");

?>
