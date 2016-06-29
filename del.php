<?php
	
require_once("config.inc.php");

if(isset($_GET["no"])){
	$wanted = $_GET["no"] - 1;
	$lines = file($list_file);
	$new_lines = '';
	foreach($lines as $key=>$line){
		if($key==$wanted){
			$field = explode(",", $line);
			if(count($field)==2){
				$del_file = str_replace("\n","",$field[1]);
			}
		}
		else{
			$new_lines.=$line;
		}
	}

	if(!empty($del_file)){
		//check if exists entry with same file
		$lines = file($list_file);
		$filecount = 0;
		foreach($lines as $line){
			$field = explode(",", $line);
			if(count($field)==2){
				$filename = str_replace("\n","",$field[1]);
				if($filename==$del_file) $filecount++;
			}
		}	
		//check if only one
		if($filecount==1){
			$del_file = $song_folder.$del_file;
			if(unlink($del_file)){
				$fp = fopen($list_file,"w");
				flock($fp, LOCK_SH);
				fwrite($fp, $new_lines);
				flock($fp, LOCK_UN);
				fclose($fp);
				header("Location: index.php");
			}
			else{
				die("File is used! Please retry.");
			}
		}
	}
	else
		header("Location: index.php");
}

?>
