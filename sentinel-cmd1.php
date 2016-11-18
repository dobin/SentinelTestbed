<?php
$myname = "sentinel-cmd1.php";
$var_title = "CMD1";
$var_description = "Initial CMD test";
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

	if (strpos($var_output, ';sleep 10') !== false) {
		sleep(10);
	}

/*
	$a = urldecode($_GET['vulnparam']);
	$a = strip_tags($a);

$var_output = '<a id="ctl84_ContactsGridView_ctl11_lkbGVRow" href="javascript:__doPostBack(\'ctl84$ContactsGridView$ctl11$lkbGVRow\',\'\')">' . $a . '</a>';
*/
 	include 'base-header.php';
	include 'base-content.php';
	include 'base-footer.php';
}

?>
