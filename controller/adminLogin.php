<?php 

?>

<html>
	<head>
		<title>IPAM</title>
		<link rel="stylesheet" type="text/css" href="../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<link rel="stylesheet" type="text/css" href="../css/title.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<body>
		<div class="title">Administrator Login</div>
		<div class="loginContainer">
			<form class="loginForm">
				<div class="formInput">
					<input type="text" name="username" required autofocus placeholder="User Name" >
				</div>
				<div class="formInput">
					<input type="password" name="pwd" required autofocus placeholder="password" >
				</div>
					<input type="submit" name="adminLoginBtn" value="Log In" class="btnLogin">
					<br >
					<a class="forgetPwd" href="home.php?activity=forgetpwd&r=admin">Forgot Password ?</a>
			</form>

			
	    </div>
	</body>
</html>
