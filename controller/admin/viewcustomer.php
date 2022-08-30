<?php
	
	include("../dbConfig.php");

	$query = "SELECT customerId,title,ip,available FROM customers";
	$returnD = mysql_query($query);
	$returnD1 = mysql_query($query);
	$result = mysql_fetch_assoc($returnD);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>IPAM</title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/table.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<body>
		
		<div class="title">List Of Csutomer IP</div>
		<table>
			<tr>
				<th>Customer ID</th>
				<th>Customer Name</th>
				<th>IP Address</th>
				<th>Status</th>
				<th>Edite</th>
				<th>Delete</th>
			</tr>
			<?php
				while($result1 = mysql_fetch_assoc($returnD1)){
				?>
				<tr>
					<td>
						<a href="adminPage.php?activity=customerDetails&selectedcustomerId=<?php echo $result1['customerId']; ?>"> <?php echo $result1['customerId']; ?> </a>
					</td>
					<td><?php echo ucfirst($result1['title']); ?></td>
					<td><?php echo ucfirst($result1['ip']); ?></td>
					<td>
						<?php 
							
							if($result1['available'] == 1){
								echo 'active';
							}
							elseif($result1['available'] == 0){
								echo 'passive';
							}
						?>
					</td>
					<td>
						<a href="adminPage.php?activity=updatecustomer&ucustomerId=<?php echo $result1['customerId'];?>">Edite</a>
					</td>
					<td>
						<a href="adminPage.php?activity=deletecustomer&deletecustomerId=<?php echo $result1['customerId']; ?>">Delete</a>
					</td>
				</tr>
				<?php
				}
			?>
			
		</table>
	</body>
</html>