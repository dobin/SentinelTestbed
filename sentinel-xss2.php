<?php
$myname = "sentinel-xss2.php";
$var_title = "XSS2";
$var_description = "XSS in BASE64 param";
$var_paramname = "vulnparam";
$var_paramtype = "get";
$var_paramcontent = "BASE64 encoded string";


function issueRequest() {
	global $myname;
	global $var_paramname;

	$var_value = base64_encode("<h1>Default Value</h1>");

	$destination = "http://localhost/sentinel/" . $myname . "?" . $var_paramname . "=" . urlencode($var_value);
        header( 'Location: ' . $destination );
	exit();
}


$isStart = $_GET['start'];
if ($isStart == "true") {
	issueRequest();
} else {
	$var_output = urldecode(base64_decode($_GET[$var_paramname]));
 	include 'base-header.php';
	include 'base-content.php';
	include 'base-footer.php';
}

?>
