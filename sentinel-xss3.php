<?php
$myname = "sentinel-xss3.php";
$var_title = "XSS3";
$var_description = "XSS in HTML tag";
$var_paramname = "vulnparam";
$var_paramtype = "get";
$var_paramcontent = "unencoded (only GET url encoded)";

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
	if ( strpos($tmp, '<') !== false || strpos($tmp, '>') !== false) {
		$var_output = "Validation error";
	} else {
		$var_output = "<a href=\"" . $tmp . "\">Test Link</a>";
	}
 	include 'base-header.php';
	include 'base-content.php';
	include 'base-footer.php';
}

?>
