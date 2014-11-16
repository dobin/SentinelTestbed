<?php
$myname = "sentinel-sql8.php";
$var_title = "SQL8";
$var_description = "Boolean SQL attack";
$var_paramname = "vulnparam";
$var_paramtype = "post";
$var_paramcontent = "string which gets inserted into SQL statement. Wrong users will not produce error. No SQL errors. POST param. Needs NOT encoded SQL injection string, despite url-encoding";

$var_output = "";

function issueRequest() {
	global $myname;
	global $var_paramname;

	$var_value = "root";
        $url = "http" . (!empty($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];

	include 'base-header.php';

	echo '<form method="post" id="myform" name="myform" action="' . $_SERVER['SCRIPT_NAME'] . '">';
	echo '<input type="hidden" name="vulnparam" value="root"></input>';
	echo '</form>';
	echo '<script type="text/JavaScript" language="JavaScript"> document.myform.submit(); </script>'; 


	//$destination = $url . "?" . $var_paramname . "=" . urlencode($var_value);
        //header( 'Location: ' . $destination );

	include 'base-footer.php';
	exit();
}

//ini_seto('display_errors', 'On');
//error_reporting(E_ALL);

$isStart = $_GET['start'];
if ($isStart == "true") {
	issueRequest();
} else {
 	include 'base-header.php';

	$var_param = $_POST['vulnparam'];
	//$var_param = urldecode($_GET['vulnparam']);

	error_log($var_param);
 
	try {
		$file_db = new PDO('sqlite:db/testdb.sqlite');
		$file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result = $file_db->query("SELECT id FROM users WHERE name='" . $var_param . "'"); 

		foreach($result as $row) {
			$var_output = "Username ID: <b>" . $row['id'] . "</b>";
		}

	} catch(PDOException $e) {
	}

	include 'base-content.php';
	include 'base-footer.php';
}

?>
