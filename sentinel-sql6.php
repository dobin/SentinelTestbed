<?php
$myname = "sentinel-sql6.php";
$var_title = "SQL6";
$var_description = "Boolean SQL attack";
$var_paramname = "vulnparam";
$var_paramtype = "get";
$var_paramcontent = "string which gets inserted into SQL statement. Wrong users will not produce error. No SQL errors. Advanced statement. Random output";

$var_output = "";

function issueRequest() {
	global $myname;
	global $var_paramname;

	$var_value = "root";
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
		$result = $file_db->query("SELECT id FROM users WHERE name='" . $var_param . "'"); 

		foreach($result as $row) {
			$var_output = "Username ID: <b>" . $row['id'] . "</b>";
		}

	} catch(PDOException $e) {
	}

	$rrr = "";
	$r = rand(1, 101);
	for($rr=0; $rr<$r; $rr++) {
		$rrr .= " a";
	}
	$var_output .= "<br>Random: " . $rrr; 

	include 'base-content.php';
	include 'base-footer.php';
}

?>
