
<?php
	
	include("../dbConfig.php");

	//$returnD = mysql_query("SELECT * FROM requestForcustomers");
	$returnD1 = mysql_query("SELECT requestId,customerName,customerip,description,requestDate FROM requestforcustomers");
	//$result = mysql_fetch_assoc($returnD);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>IPAM</title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/table.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<body>
		<div class="title">Request For A Customer IP</div>
		<div class="requestTable">
			<table>
				<tr>
					<th>Request ID</th>
					<th>Customer Name</th>
					<th>IP</th>
					<th>Description</th>
					<th>Date</th>
					<th>Delete</th>
				</tr>

				<?php
					while ($result = mysql_fetch_assoc($returnD1)) {
						?>
						<tr>
							<td>
								<a href="adminPage.php?activity=viewUserProfile&selectedMemberId=<?php echo $result['requestId']; ?>"><?php echo $result['requestId']; ?></a>
							</td>
							<td><?php echo $result['customerName']; ?></td>
							<td><?php echo $result['customerip']; ?></td>
							<td><?php echo $result['description']; ?></td>
							<td><?php echo $result['requestDate']; ?></td>
							<td>
								<a href="adminPage.php?activity=dcustomerRequest&rd=<?php echo $result['requestDate']; ?>">delete</a>
							</td>
							
						</tr>
						<?php
					}
				?>

			</table>
		</div>
	</body>
</html>