<?php
header("Expires: Mon, 26 Jul 2002 05:00:00 GMT"); 
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Filemanager v. 0.2</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="Filemanager v. 0.2" />
	<meta name="keywords" content="Filemanager v. 0.2" />
	<meta name="robots" content="index,follow" />
	<meta name="author" content="Alexander Wattenbach" />
	<link type="text/css" rel="stylesheet" href="css/main.css" />
	<link href="http://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.js"></script>
	<script>window.jQuery || document.write('<script src="jsbase/jquery.min.js"><\/script>')</script>
	<script type="text/javascript" src="jsbase/main.js"></script>
	<!--[if lt IE 9]>
	<script type="text/javascript" src="jsbase/ie.js"></script>
	<![endif]-->
</head>
<body>

<header>
	<h1>HTML 5 Filemanager v0.2</h1>
	A simple databased file management system <strong>now with drag &amp; drop</strong>
</header>
<?

include('globals.inc.php');
$i=1;
echo '<div id="folder_content">';
while ($folder_array= mysql_fetch_assoc($folder_query)) {
	$element_query= mysql_query('SELECT * FROM tb_element WHERE folder_id='.$folder_array[id].' ORDER BY sort');
	$element_count= mysql_num_rows($element_query);
	echo '
	<div class="folder_container">
		<div class="folder_insider">
			<section class="element_list" id="folder_'.$i.'">';
	$a=1;
	if ($element_count != '0') {
		while ($element_array= mysql_fetch_assoc($element_query)) {
			showElement($a,$folder_array[id],$element_array[id]);
			$a++;
		}
	}
	echo '
				<article class="element_container" id="element_container_dummy"';
	if ($element_count == '0') echo ' style="display: block;"';
	echo '>There is no content in <strong>'.$folder_array[name].'</strong> right now.</article>';
echo '
			</section>
			<div class="clearfix"></div>
			&nbsp;
		</div>
		<div class="folder_icon"><img src="images/layout/folder_icon.png" alt="" /></div>
		<div class="folder_desc" id="folder_'.$i.'_desc"><h2>'.$folder_array[name].'</h2><p>There are <strong class="element_count">'.$element_count.'</strong> elements in this folder.</p></div>
	</div>
';
$i++;
}
?>
</div>
<div class="clearfix"></div>
<footer>
	&copy; <a href="http://www.sehen-design.de/awport" target="_blank">Alexander Wattenbach</a> 2012
	<div id="debug"></div>
</footer>
</html>