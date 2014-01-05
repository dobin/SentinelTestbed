<?php
$myname = "sentinel-xss1.php";
$var_title = "XSS1";
$var_description = "Initial XSS test";
$var_paramname = "vulnparam";
$var_paramtype = "get";
$var_paramcontent = "unencoded (only GET url encoded)";

$var_output = "";

function issueRequest() {
	global $myname;
	global $var_paramname;

	$var_value = "Default Value";

        $url = "http" . (!empty($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];
	$destination = $url . "?" . $var_paramname . "=" . urlencode($var_value);
        header( 'Location: ' . $destination );
	exit();
}


$isStart = $_GET['start'];
if ($isStart == "true") {
	issueRequest();
} else {
	$var_output = urldecode($_GET['vulnparam']);
 	include 'base-header.php';
	include 'base-content.php';
	include 'base-footer.php';
}

?>
