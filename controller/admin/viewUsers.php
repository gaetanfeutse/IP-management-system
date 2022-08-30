<?php

	include("../dbConfig.php");

	$query = "SELECT id,firstName,lastName,mobile FROM members";
	$returnD = mysql_query($query);
	$returnD1 = mysql_query($query);
	$result = mysql_fetch_assoc($returnD);
	
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>IPAM</title>
		<link rel="stylesheet" type="text/css" href="../../css/table.css">
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/viewProfile.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<body>
		<div class="title">List Of Members</div>
		<table>
			<tr>
				<th>Id</th>
				<th>Last Name</th>
				<th>First Name</th>
				<th>Phone Number</th>
				<th>Delete</th>
				
			</tr>

			<?php
				while($result1 = mysql_fetch_assoc($returnD1)){
				?>
				<tr>
					<td>
						<a href="adminPage.php?activity=viewUserProfile&selectedMemberId=<?php echo $result1['id']; ?>"> <?php echo $result1['id']; ?> </a>
					</td>
					<td><?php echo ucfirst($result1['firstName']); ?></td>
					<td><?php echo ucfirst($result1['lastName']); ?></td>
					<td><?php echo $result1['mobile']; ?></td>
					<td>
						<a href="adminPage.php?activity=deleteUser&memberid=<?php echo $result1['id']; ?>">Delete</a>
					</td>
				</tr>
				<?php
				}
			
			?>
		</table>
	</body>
</html>
