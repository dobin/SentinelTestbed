<?php
$myname = "sentinel-sql7.php";
$var_title = "SQL7";
$var_description = "Boolean SQL attack: Update";
$var_paramname = "vulnparam";
$var_paramtype = "get";
$var_paramcontent = "Update an entry";

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
		$result = $file_db->exec("UPDATE users SET pw='" . $var_param . "' WHERE id=666");
		$file_db = null; 
	} catch(PDOException $e) {
	}
	
	try {
		$file_db = new PDO('sqlite:db/testdb.sqlite');
		$file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result = $file_db->query("SELECT pw FROM users WHERE id=666"); 
		foreach($result as $row) {
			$var_output = "PW for ID 666: <b>" . $row['pw'] . "</b>";
		}
	} catch(PDOException $e) {
	}

	include 'base-content.php';
	include 'base-footer.php';
}

?>
