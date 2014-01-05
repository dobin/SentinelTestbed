<?php
        include 'base-header.php';

        $var_description = "Initial XSS test";
        $var_paramname = "vulnparam";
        $var_paramtype = "get";
        $var_paramcontent = "unencoded (only GET url encoded)";
?>

<h2>XSS</h2>

<table class="table">
<tr>
	<th> Name </th>
	<th> Description </th>
</tr>
<tr>
	<td> <a href="sentinel-xss1.php?start=true">XSS1</a> </td>
	<td> XSS with default PHP urldecode of $GET_[] </td>
</tr>
<tr>
	<td> <a href="sentinel-xss2.php?start=true">XSS2</a> </td>
	<td> XSS in BASE64 encoded param </td>
</tr>
<tr>
	<td> <a href="sentinel-xss3.php?start=true">XSS3</a> </td>
	<td> XSS in HTML tag, default urldecode </td>
</tr>
</table>


<h2>SQL</h2>

<table class="table">
<tr>
	<th> Name </th>
	<th> Description </th>
</tr>
<tr>
	<td> <a href="sentinel-sql1.php?start=true">SQL1</a> </td>
	<td> Default SQL attack with error message </td>
</tr>
<tr>
	<td> <a href="sentinel-sql2.php?start=true">SQL2</a> </td>
	<td> Boolean SQL attack </td>
</tr>
<tr>
	<td> <a href="sentinel-sql3.php?start=true">SQL3</a> </td>
	<td> Blind SQL attack </td>
</tr>


</table>


<?php
	include 'base-footer.php'
?>
