<?php
	include("../dbConfig.php");

	$selectedcustomerId = $_REQUEST['selectedcustomerId'];

	$query = mysql_query("Select customerId,title,ip,location,status From customers Where customerId = '$selectedcustomerId'");
	$result = mysql_fetch_assoc($query);


	$issueId = $result1['issueId'];

	if($issueId){
		$query2 = mysql_query("Select firstName,lastName From members Where id = '$issueId'");
		$result2 = mysql_fetch_assoc($query2);
		//print_r($result2);
	}


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
			<?php
			if($issueId){
			?>
			<div class="issuingInfo">
				<?php
					
					if($result2['firstName'] && $result2['lastName']){
						?>
						error 
						<a href="adminPage.php?activity=viewUserProfile&selectedMemberId=<?php echo $issueId; ?>"><?php echo ucfirst($result2['firstName'])." ".ucfirst($result2['lastName']); ?>.
						</a>
						<?php
					}
				?>
			</div>
			<?php
			}
			?>
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