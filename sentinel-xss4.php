<?php
$myname = "sentinel-xss4.php";
$var_title = "XSS4";
$var_description = "Persistent XSS";
$var_paramname = "-";
$var_paramtype = "-";
$var_paramcontent = "No params, just static output";

$var_output = "";

function issueRequest() {
	global $myname;
	global $var_paramname;

	$var_value = "http://www.google.ch";
        $url = "http" . (!empty($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];

	$destination = $url . "?" . $var_paramname . "=" . urlencode($var_value);
        header( 'Location: ' . $destination );
	exit();
}


$isStart = $_GET['start'];
if ($isStart == "true") {
	issueRequest();
} else {
	$tmp = urldecode($_GET['vulnparam']);
	$var_output = "Username: Xssaa";

 	include 'base-header.php';
	include 'base-content.php';
	include 'base-footer.php';
}

?>
