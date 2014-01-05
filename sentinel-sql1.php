<?php
$myname = "sentinel-sql1.php";
$var_title = "SQL1";
$var_description = "Default SQL attack";
$var_paramname = "vulnparam";
$var_paramtype = "get";
$var_paramcontent = "string which gets inserted into SQL statement. Wrong SQL statement generate error.";

$var_output = "";

function issueRequest() {
	global $myname;
	global $var_paramname;

	$var_value = "1";

	$url = "http" . (!empty($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];
	$destination = $url . "?" . $var_paramname . "=" . urlencode($var_value);

        header( 'Location: ' . $destination );
	exit();
}

//ini_seto('display_errors', 'On');
//error_reporting(E_ALL);

$isStart = $_GET['start'];
if ($isStart == "true") {
	issueRequest();
} else {
 	include 'base-header.php';

	$var_param = urldecode($_GET['vulnparam']);
 
	try {
		$file_db = new PDO('sqlite:db/testdb.sqlite');
		$file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result = $file_db->query("SELECT name FROM users WHERE id='" . $var_param . "'"); 

		foreach($result as $row) {
			$var_output = "Username: <b>" . $row['name'] . "</b>";
		}
	} catch(PDOException $e) {
		//echo "FAIL: ";
		//echo $e->getMessage();
		$var_output = $e->getMessage();
	}

	include 'base-content.php';
	include 'base-footer.php';
}

?>
