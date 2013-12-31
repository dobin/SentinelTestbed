<?php
$myname = "sentinel-sql3.php";
$var_title = "SQL3";
$var_description = "Blind SQL attack";
$var_paramname = "vulnparam";
$var_paramtype = "get";
$var_paramcontent = "string which gets inserted into SQL statement. Wrong SQL statements wont change output";

$var_output = "";

function issueRequest() {
	global $myname;
	global $var_paramname;

	$var_value = "1";

	$destination = "http://localhost/sentinel/" . $myname . "?" . $var_paramname . "=" . urlencode($var_value);
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
	include 'base-content.php';

	$var_param = urldecode($_GET['vulnparam']);

	echo "No Output";

	try {
		$file_db = new PDO('sqlite:db/testdb.sqlite');
		$file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result = $file_db->query("SELECT name FROM users WHERE id='" . $var_param . "'"); 

		foreach($result as $row) {
			$bla = md5($row); // Do some light processing...
//			print "Username: <b>" . $row['name'] . "</b>";
		}

	} catch(PDOException $e) {
	}

	include 'base-footer.php';
}

?>
