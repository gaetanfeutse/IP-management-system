<?php
	include("../dbConfig.php");

	$selectedcustomerId = $_REQUEST['selectedCustomerId'];

	$query = mysql_query("Select customerId,title,ip,location,status From customers Where customerId = '$selectedCustomerId'");
	$result = mysql_fetch_assoc($query);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>IPAM</title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/customerDetails.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<body>
		<div class="title">Customer Information</div>
		<div class="infoContainer">
			<div class="customerName">
				<?php echo ucfirst($result['title']); ?>[<?php echo $selectedcustomerId; ?>]
			</div>
			
			<div class="customerInfo">
				<hr>
				<div class="label">IP Address</div>
				<div class="details"><?php echo ucfirst($result['ip']); ?></div>
				<hr>
				<div class="label">Location</div>
				<div class="details"><?php echo $result['location']; ?></div>
				<hr>
				<div class="label">Status</div>
				<div class="details"><?php echo ucfirst($result['status']); ?></div>
				<hr>
			</div>

		
		</div>
	</body>
</html>  