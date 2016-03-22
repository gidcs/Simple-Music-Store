<?php
require_once("config.inc.php");
if(isset($_FILES)){
	$src = $_FILES["songfile"]["tmp_name"];	
	$song_filename = $_FILES["songfile"]["name"];
	$ext = ".".pathinfo($song_filename, PATHINFO_EXTENSION);
	if(!in_array($ext,$allowed_ext)){
		header("Location: index.php?err=1");		
		return;
	}
	$song_filename = str_replace(",","_",$song_filename);
	$dest = $song_folder.$song_filename;
	$song_name = str_replace($ext,"",$song_filename);
	if(isset($_POST["newsong"])){
		if(!empty($_POST["newsong"])){
			$song_name = $_POST["newsong"];
		}
	}
	if (!file_exists($song_folder)){
		mkdir($song_folder);
		chmod($song_folder, $dir_mode);
	}
	if (move_uploaded_file($src, $dest)) { 
		chmod($dest, $file_mode);
		$fp = fopen($list_file,"a");
		flock($fp, LOCK_SH);
		fwrite($fp, $song_name.",".$song_filename."\n");
		flock($fp, LOCK_UN);
		fclose($fp);
		@unlink($_FILES["songfile"]["tmp_name"]); 
	} 
}
header("Location: /");
?> 
