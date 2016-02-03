<!DOCTYPE HTML>
<html>
<head>
<title>Загрузка и обработка изображения</title>
<?php
require_once("functions.php");
$menu = new menu();
if(!empty($_FILES)){
	$uploader = new uploader();
	$uploader->checkAndMove();
}
if(!empty($_SESSION['filename'])){
	$image = new image();
	$image->getDimensions();
	if(!empty($_POST['imageCrop'])){
		$image->cropImage();
	}
}
?>
</head>
<body>
<center>
<h1>Загрузка и обработка изображения</h1>
<?php
$menu -> showUploadMenu();
if(!empty($_SESSION['filename'])){
	$menu->showCropMenu();
	$image->checkCrop($menu);
	$menu->showSepia();
	if(!empty($_GET['sepia']) and $_GET['sepia'] == 'yes'){
		$image->applySepia();
	}
	$image->showImage();
	$image->saveImage();
}
?>
</center>
</body>
</html>