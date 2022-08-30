<?php
	
	include("../dbConfig.php");

	$query = "Select Max(customerId) From customers";
	$returnD = mysql_query($query);
	$result = mysql_fetch_assoc($returnD);
	$maxRows = $result['Max(customerId)'];
	if(empty($maxRows)){
        $lastRow = $maxRows = 1001;      
    }else{
		$lastRow = $maxRows + 1 ;
    }

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
		<div class="title">Add Customer IP</div>
		<div class="addcustomerForm">
			<form  action="adminPage.php">
				<input type="text" name="customerId" required autofocus placeholder="Customer ID" value=<?php echo $lastRow; ?> readonly><br>
				<input type="text" name="customerName" required autofocus placeholder="Customer Name" pattern="[A-Z a-z]{3,}" title="The Name Most Contain At least 3 Character."><br>
				<input type="text" name="customerip" required autofocus placeholder="IP Address"  title="Enter valide IP Address." minlength="7" maxlength="15" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$"><br>
				<input type="text" name="customerlocation" required autofocus placeholder="Location"><br>
				<input type="text" name="customerstatus" required autofocus placeholder="Status" pattern="[A-Z a-z]{6,}" title="The name most contain at least."><br>
				<input type="submit" name="addcustomerBtn" value="Add"><br>
			</form>
		</div>
	</body>
</html>