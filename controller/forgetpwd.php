

<?php
	
	$r = $_REQUEST['r'];

?>

<html>
	<head>
		<title>IPAM</title>
		<link rel="stylesheet" type="text/css" href="../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<link rel="stylesheet" type="text/css" href="../css/title.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<body>
		<div class="title">Password recovery</div>
		<div class="forgetContainer">
			<form class="forgetForm">
				<div class="formInput">
					<input type="hidden" name="request" value=<?php echo $r;?>>
				</div>
				<div class="formInput">
					<input type="email" name="regEmail" required autofocus placeholder="E-mail">
				</div>
				<div class="formInput">
					<input type="password" name="newP" required autofocus placeholder="Password">
				</div>
				<div class="formInput">
					<input type="password" name="confirmP" required autofocus placeholder="confirm password" >
				</div>
					<input type="submit" name="pwdSaveBtn" value="Enregistrer" class="btnLogin">
					<br >
					<a class="backToHome" href="home.php?activity=dashboard">Back To Home</a>
			</form>
	    </div>
	</body>
</html>