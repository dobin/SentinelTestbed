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
	<td> <a href="sentinel-sql1.php?start=true">SQL1</a> </td>
	<td> Default SQL attack: Int, with SQL error message on invalid statement</td>
</tr>
<tr>
	<td> <a href="sentinel-sql2.php?start=true">SQL2</a> </td>
	<td> Blind SQL attack - explicit webapp msg on invalid param </td>
</tr>
<tr>
	<td> <a href="sentinel-sql3.php?start=true">SQL3</a> </td>
	<td> Blind SQL attack - no explicit webapp error msg on invalid param </td>
</tr>
<tr>
	<td> <a href="sentinel-sql4.php?start=true">SQL4</a> </td>
	<td> Really Blind SQL attack </td>
</tr>
<tr>
	<td> <a href="sentinel-sql5.php?start=true">SQL5</a> </td>
	<td> Blind SQL attack - no error msg on invalid param, AND statement </td>
</tr>
<tr>
	<td> <a href="sentinel-sql6.php?start=true">SQL6</a> </td>
	<td> Blind SQL attack - no error msg on invalid param, Random output </td>
</tr>
<tr>
	<td> <a href="sentinel-sql7.php?start=true">SQL7</a> </td>
	<td> Blind SQL attack - no error msg on invalid param, UPDATE </td>
</tr>
<tr>
	<td> <a href="sentinel-sql8.php?start=true">SQL8</a> </td>
	<td> Blind SQL attack - POST, needs invalid encoding </td>
</tr>
<tr>
	<td> <a href="sentinel-sql9.php?start=true">SQL9</a> </td>
	<td> Blind SQL attack - Empty reponse on invalid sql statement </td>
</tr>
</table>


<h2>CMD</h2>

<table class="table">
<tr>
	<td> <a href="sentinel-cmd1.php?start=true">SQL1</a> </td>
	<td> Fake command injection with sleep </td>
</tr>
</table>

<?php
	include 'base-footer.php'
?>
