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
	//get song name from filename
	$song_filename = str_replace(",","_",$song_filename);
	$song_name = str_replace($ext,"",$song_filename);
	//get md5
	$md5_src = md5_file($src);
	$song_filename = $md5_src.$ext;
	$dest = $song_folder.$song_filename;
	if(isset($_POST["newsong"])){
		if(!empty($_POST["newsong"])){
			$song_name = $_POST["newsong"];
		}
	}
	if (!file_exists($song_folder)){
		mkdir($song_folder);
		chmod($song_folder, $dir_mode);
	}
	$file_exists=0;
	if(!file_exists($dest)){
		if (move_uploaded_file($src, $dest)) { 
			chmod($dest, $file_mode);
			@unlink($_FILES["songfile"]["tmp_name"]); 
		}
	}
	$fp = fopen($list_file,"a");
	flock($fp, LOCK_SH);
	fwrite($fp, $song_name.",".$song_filename."\n");
	flock($fp, LOCK_UN);
	fclose($fp);
}
header("Location: index.php");
?> 
