<?php

	include("../dbConfig.php");

	$query = mysql_query("Select count(id) From members Where position = 'employee'");
	$result = mysql_fetch_assoc($query);

	$query2 = mysql_query("Select count(customerId) From customers");
	$result2 = mysql_fetch_assoc($query2);

	$query3 = mysql_query("Select count(id) From members Where position = 'direction'");
	$result3 = mysql_fetch_assoc($query3);

	$query4 = mysql_query("Select count(status) From customers Group By status");
	$result4 = mysql_num_rows($query4);
	
	$query5 = mysql_query("Select sum(location) From customers");
	$result5 = mysql_fetch_assoc($query5);

	$query6 = mysql_query("Select count(customerId) From customers Where available = 1");
	$result6 = mysql_fetch_assoc($query6);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>IPAM</title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/userDashboard.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<body>
		<div class="title">Dashboard</div>
		<div class="containerDashboard">

			<div class="tile">Total employee : <?php echo $result['count(id)'];?></div>

			<div class="tile">Number Of Customer IP : <?php echo $result2['count(customerId)']; ?></div>
			<div class="tile">Total Number Of Active IP : <?php echo $result6['count(customerId)']; ?></div>

		</div>
	</body>
</html>