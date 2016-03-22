<?php
	$title="Simple Music Store";
	$css_list=array(
		"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css",
		"https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.css",
		"css/main.css",
	);
	$js_list=array(
		"https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js",
		"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js",
		"https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.js",
		"js/main.js",
	);
	$allowed_ext=array(
		".mp3", 
		".mp4", ".m4a", ".aac",
		".oga",".ogg",
		".wav",
		".webm",
	);
	$list_file = "song.txt";
	$path = dirname(__FILE__)."/";
	$dir_mode = 0755;
	$file_mode = 0644;
	$dir_name = "music"."/";
	$song_folder = $path.$dir_name;
?>
