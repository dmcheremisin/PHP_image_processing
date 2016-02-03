<?php
session_start();
spl_autoload_register(
	function($name){
	   require_once("classes/".strtolower($name).'.php');
	}
);
function clear($value){
	$value = trim(htmlentities(strip_tags($value)));
}

function getScript($image){
	echo '<link rel="stylesheet" type="text/css" href="css/imgareaselect-default.css" />'."\n";
	echo '<script type="text/javascript" src="scripts/jquery.min.js"></script>'."\n";
	echo '<script type="text/javascript" src="scripts/jquery.imgareaselect.pack.js"></script>'."\n";
	echo '<script type="text/javascript">';
	echo '$(document).ready(function () {';
	echo "$('#image').imgAreaSelect({ aspectRatio: '".($image->getWidthHeight())."', handles: true,";
	echo "onSelectEnd: function (img, selection) {";
    echo "$('input[name=\"x1\"]').val(selection.x1);";
    echo "$('input[name=\"y1\"]').val(selection.y1);";
    echo "$('input[name=\"x2\"]').val(selection.x2);";
    echo "$('input[name=\"y2\"]').val(selection.y2);";
	echo "}});";
	echo "});</script>"."\n";
}
/*
echo "<pre>";
print_r($_FILES);
print_r($_SESSION);
echo "</pre>";
*/
?>