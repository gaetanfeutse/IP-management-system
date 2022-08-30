<?php
	session_start();
	include("dbConfig.php");

	$username = $_SESSION['username'];

	$result = mysql_fetch_assoc(mysql_query("SELECT position FROM members WHERE username = '$username'"));

	if($_REQUEST['activity'] == 'logout'){
        $username = null;
        $username ="";
        unset($username);
        
        $_SESSION['username'] = null;
        $_SESSION['username'] ="";
        unset($_SESSION['username']);
        
        session_destroy();
    }

    if(empty($username)){
        header("location: ../home.php?activity=dashboard");
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>IPAM</title>
		<link rel="stylesheet" type="text/css" href="../css/title.css">
		<link rel="stylesheet" type="text/css" href="../css/userPage.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<body>
		<div class="userContainer">
			<div class="title">
				<?php 
					
					if($result['position'] == 'strangers'){
						echo "strangers space ";
					}
					else if($result['position'] == 'Employee'){
						echo "Employee space";
					}
				?>
			</div>

			<div class="userWelcome">Welcome : <?php echo $_SESSION['username']; ?></div>

			<div class="logout"><a href="members/userPage.php?activity=logout">Log Out</a></div>

			<div class="userAction">
				<ul>
					<li><a href="home.php?activity=userDashboard">Dashboard</a></li>
				
				</ul>
			</div>

			<div class="userContent">
				<?php
				//ACTIVITY PERFORM...

					$activity = $_REQUEST['activity'];

					switch ($activity) {
						case 'userDashboard':
							include("userDashboard.php");
							break;
	
						default:
							# code...
							break;
					}
				?>
			</div>
		</div>
	</body>
</html>