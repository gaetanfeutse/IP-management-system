
<?php
	
	$uid = $_SESSION['uid'];

?>

<!DOCTYPE html>
<html>
	<head>
		<title>IPAM</title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../../css/form.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<body>
	<div class="title">Request Customer IP</div>
		<div class="requestContainer">
			<form class="requestForm">
				<div class="formInput">
					<input type="text" name="requestId" value=<?php echo $uid; ?> readonly>
				</div>
				<div class="formInput">
					<input type="text" name="rcustomerName" required autofocus placeholder="Customer Name" >
				</div>
				<div class="formInput">
					<input type="text" name="rcustomerName" required autofocus placeholder="IP">
				</div>
				<div class="formInput">
					<textarea cols="35" rows="3" name="rdescription" placeholder="Discription"></textarea>
				</div>
					<input type="submit" name="customerRequestBtn" value="Request" class="btnLogin">
					<br >
			</form>

			
	    </div>
	</body>
</html>