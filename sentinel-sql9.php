<?php
$myname = "sentinel-sql9.php";
$var_title = "SQL9";
$var_description = "Boolean SQL attack empty page";
$var_paramname = "vulnparam";
$var_paramtype = "get";
$var_paramcontent = "string which gets inserted into SQL statement. Not existing users return empty site.";

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

	$var_param = urldecode($_GET['vulnparam']);
 
	try {
		$file_db = new PDO('sqlite:db/testdb.sqlite');
//		$file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result = $file_db->query("SELECT id FROM users WHERE name='" . $var_param . "'") or die(); 

		$var_output = "";
		foreach($result as $row) {
			$var_output = "Username ID: <b>" . $row['id'] . "</b>";
		}
		if ($var_output == "") {
			$var_output = "User not found";
		}


	} catch(PDOException $e) {
	}

 	include 'base-header.php';
	include 'base-content.php';
	include 'base-footer.php';
}

?>
