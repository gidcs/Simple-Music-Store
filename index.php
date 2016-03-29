<?php
	require_once("config.inc.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
<?php foreach($css_list as $css){ ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $css; ?>">
<?php } ?>
<?php foreach($js_list as $js){ ?>
	<script type="text/javascript" src="<?php echo $js; ?>"></script>
<?php } ?>
</head>
<body>
<div class="container">
	<div class="page-header text-center">
		<h1><?php echo $title; ?></h1>
	</div>
</div>
<?php
if(isset($_GET["err"])){
	if($_GET["err"]==1){
?>
<div class="container">
	<div class="alert alert-danger" role="alert">
		We only accept files that have extension 
		<a href="#" class="alert-link"><?php echo implode("/",$allowed_ext); ?></a>
		to be uploaded.
	</div>
</div>
<?php
	}
}
?>
<div class="container">
	<table class="table table-bordered">
		<thead>
		<tr>
			<th class="text-center col-xs-1 col-md-2">Index</th>
			<th class="text-center col-xs-4 col-md-4">Name</th>
			<th class="text-center col-xs-4 col-md-4">Filename</th>
			<th class="text-center col-xs-3 col-md-2">Action</th>
		</tr>
		</thead>
		<tbody>	
<?php
if(file_exists($list_file)){
	$fp=fopen($list_file,"r");	
	$count=0;
	flock($fp, LOCK_SH);
	while(!feof($fp)){
		$line = fgetcsv($fp);
		if(empty($line[1])) break;
		$count++;
?>
		<tr>
			<td class="text-center col-xs-1 col-md-2 vert-align"><?php echo $count; ?></td>
			<td class="text-center col-xs-4 col-md-4 vert-align"><?php echo $line[0]; ?></td>
			<td class="text-center col-xs-4 col-md-4 vert-align"><?php echo $line[1]; ?></td>
			<td class="text-center col-xs-3 col-md-2 vert-align">
				<div class="btn-group">
					<button type="button" class="btn btn-primary" onclick="PlayMusic('<?php echo $dir_name.$line[1]; ?>')">
						<span class="glyphicon glyphicon-play" aria-hidden="true"></span>
					</button>
					<a class="btn btn-danger" href="del.php?no=<?php echo $count; ?>" role="button">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</a>
				</div>
			</td>
		</tr>
<?php
	}	
	flock($fp, LOCK_UN);
	fclose($fp);
}
?>
		<form action="upload.php" method="post" enctype="multipart/form-data">
		<tr>
		<td class="text-center col-xs-1 col-md-2 vert-align">&nbsp;</td>
		<td class="text-center col-xs-4 col-md-4 vert-align input-group input-group-sm">
			<div class="col-xs-12 col-md-12">
				<input type="text" class="form-control" placeholder="Song Name" name="newsong">
			</div>
		</td>
		<td class="text-center col-xs-4 col-md-4 vert-align" data-provides="fileinput">	
			<span class="btn btn-default btn-file">
				<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
				<input type="file" name="songfile" accept="<?php echo implode(",",$allowed_ext); ?>"/>
			</span>
			<span>&nbsp;</span>
			<span class="fileinput-filename"></span>
			<span class="fileinput-new">No file chosen</span>
		</td>
		<td class="text-center col-xs-3 col-md-2 vert-align"><div class="btn-group">
			<input class="btn btn-primary" type="submit" value="Upload">
		</div></td>
		</tr>
		</form>
		</tbody>
	</table>
	<div class="text-center">
		<audio id="mp3play" src="" controls="controls" autoplay="autoplay"></audio>
	</div>
</div>
<footer class="footer">
<div class="container text-center">
<p class="text-muted">Designed by <a href="http://www.guyusoftware.com" target="_blank">LKS</a> and <a href="http://www.gidcs.net" target="_blank">GIDCS.Net</a>.</p>
</div> 
</footer>
</body>
</html>
