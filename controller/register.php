<?php

include("dbConfig.php");

	$query = "Select Max(id) From members";
	$returnD = mysql_query($query);
	$result = mysql_fetch_assoc($returnD);
	$maxRows = $result['Max(id)'];
	if(empty($maxRows)){
        $lastRow = $maxRows = 1;      
    }else{
		$lastRow = $maxRows + 1 ;
    }

?>


<!DOCTYPE html>
	<html  lang="eng">
	<head>
		<title>IPAM</title>
		<link rel="stylesheet" type="text/css" href="../css/title.css">
		<link rel="stylesheet" type="text/css" href="../css/register.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<body>
		<div class="title">Registration</div>
		<div class="addMemberForm">
			<form action="home.php" method="POST" enctype="multipart/form-data" class="addform">

				<div class="inputs">
					<input type="text" name="memberId" required autofocus placeholder="ID" value=<?php if(!empty($lastRow)){ echo $lastRow; }?> readonly>
				</div>

				<div class="inputs">
					<input type="text" name="firstName" required autofocus placeholder="FirstName" pattern="[A-Za-z]{3,}" title="most contain at least 3 letters.">
				</div>

				<div class="inputs">
					<input type="text" name="lastName" required autofocus placeholder="lastName" pattern="[A-Za-z]{3,}" title="most contain at least 3 letters.">
				</div>

				<div class="inputs">
					<input type="text" name="username" required autofocus placeholder="UserName" pattern="[A-Za-z0-9]{6,}" title="most contain at least 3 letters.">
				</div>

				<div class="inputs">
					<input type="password" name="pwd" required autofocus placeholder="Password">
				</div>

				<div class="inputs">
					<div class="addMemberFormList">
						<select name="position" required autofocus>
							<option value="">Select</option>
							<option value="employee">Employee</option>
						</select>
					</div>
				</div>

				<div class="inputs">
					<input type="text" name="mobile" required autofocus placeholder="Phone Number" pattern="[0-9]{9}">
				</div>

				<div class="inputs">
					<input type="email" name="email" required autofocus placeholder="E-mail" title="exemple.exemple1@gmail.com">
				</div>

				<div class="inputs">
					<label><font color="blue">Upload image: </font></label><input type="file" name="image" value="Upload image">
				</div>

				<input type="submit" name="addMemberBtn" value="Sign Up">
			</form>
		</div>
	</body>
</html>