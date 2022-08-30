
<?php
	include("../dbConfig.php");

	$uid = $_SESSION['uid'];

	$query = mysql_query("Select firstName,lastName,username,mobile,email,pic From members Where id = '$uid'");
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
				<?php echo ucfirst($result['firstName'])." ".ucfirst($result['lastName']); ?>
			</div>
			<div class="info">
				<hr>
				<div class="label">Id</div>
				<div class="details"><?php echo $uid; ?></div>
				<hr>
				<div class="label">User Name</div>
				<div class="details"><?php echo ucfirst($result['username']); ?></div>
				<hr>
				<div class="label">Phone Number</div>
				<div class="details"><?php echo $result['mobile']; ?></div>
				<hr>
				<div class="label">E-mail</div>
				<div class="details"><font color="#00FF00"><?php echo ucfirst($result['email']); ?></div>
				<hr>
			</div>
		</div>
	</body>
</html>