
<?php
	include("../dbConfig.php");

	$uid = $_SESSION['uid'];

	$query = mysql_query("Select * From admin Where id = '$uid'");
	$result = mysql_fetch_assoc($query);


?>

<!DOCTYPE html>
<html>
	<head>
		<title>IPAM</title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/viewProfile.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<body>
		<div class="title">View Profile</div>
		<div class="infoContainer">
			<div class="userPic">
				<img src="pic/<?php print $result['pic']; ?>" alt="<?php echo ucfirst($result['firstName'])." ".ucfirst($result['lastName'])." Image"; ?>">
			</div>
			<div class="userName">
				<font color="#FF0000"><?php echo ucfirst($result['firstName'])." ".ucfirst($result['lastName']); ?></font>
			</div>
			<div class="info">
				<hr>
				<div class="label">Id</div>
				<div class="details"><font color="#00FF00"><?php echo $result['id']; ?></font></div>
				<hr>
				<div class="label">User Name</div>
				<div class="details"><font color="#00FF00"><?php echo ucfirst($result['username']); ?></font></div>
				<hr>
				<div class="label">Phone Number</div>
				<div class="details"><font color="#00FF00"><?php echo $result['mobile']; ?></font></div>
				<hr>
				<div class="label">Email</div>
				<div class="details"><font color="#00FF00"><?php echo ucfirst($result['email']); ?></font></div>
				<hr>
			</div>
		</div>
	</body>
</html>