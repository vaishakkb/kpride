<html>
<head>
<title>Venue Details</title>
</head>
<body>
<h2 align="center" style="color:green;">Venue Details</h2>
<div>


<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="styletd">

<?php
include 'connection.php';
if(isset($_GET['jai'])){
	$id = $_GET['jai'];

	$sqlVe = mysql_query("SELECT * FROM schedule Where id='$id'") or die (mysql_error());
	$rows = mysql_fetch_array($sqlVe);
	echo $rows['Venue'];	
	?>
	</td><td>
	<?php
	echo $rows['map'];
}
?></td>
</tr>
</table>
</div>
</body>
</html>