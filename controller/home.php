
<?php
	session_start();
	include("dbConfig.php");
	error_reporting(0);

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="icon" href="../pic/favicon.png">
		<title>IPAM</title>
		<link rel="stylesheet" type="text/css" href="../css/home.css">
		<link rel="stylesheet" type="text/css" href="../css/title.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<body>
	<div class="container">
			<div class="header">
				<?php include("header.php"); ?>
			</div>

			<div class="navigation">
				<?php include("navigation.php"); ?>
			</div>

			<div class="content">
				<?php
				//ACTIVITY PERFORM...

					$activity = $_REQUEST['activity'];

					switch ($activity) {
						case 'dashboard':
							include("dashboard.php");
							break;

						case 'search':
							include("search.php");
							break;

						case 'adminLogin':
							include("adminLogin.php ");
							break;
						
						case 'employeeLogin':
							include("employeeLogin.php");
							break;


						case 'register':
							include("register.php");
							break;

						case 'userDashboard':
							include("userDashboard.php");
							break;

						case 'forgetpwd':
							include("forgetpwd.php");
							break;

						default:
							# code...
							break;
					}

				?>

				<?php
				//ADMIN LOGIN...

					if(isset($_REQUEST['adminLoginBtn'])){
		
						$username= $_REQUEST['username'];
						$pwd= $_REQUEST['pwd'];

						if(!empty($username) && !empty($pwd)){

							$query = mysql_query("SELECT id,username,pwd FROM admin WHERE username = '$username'");
							$result = mysql_fetch_assoc($query);

								if($username == $result['username'] && $pwd == $result['pwd']){
				
									$_SESSION['username'] = $result['username'];
									$_SESSION['uid'] = $result['id'];

									header("location: admin/adminPage.php?activity=adminDashboard");
								}
								else{
									include("adminLogin.php");
									$errorMsg = "Incorrect User....";
								}
						}
						else{
							include("adminLogin.php");
							$errorMsg = "Empty Domaine...";
						}
						
					}

				?>

				<?php
				//Employee LOGIN...

					if(isset($_REQUEST['employeeLoginBtn'])){
		
						$username= $_REQUEST['username'];
						$pwd= $_REQUEST['pwd'];

						if(!empty($username) && !empty($pwd)){

							$query = mysql_query("SELECT id,username,pwd FROM members WHERE position = 'employee' && username = '$username' && pwd = '$pwd'");
							$result = mysql_fetch_assoc($query);

								if($username == $result['username'] && $pwd == $result['pwd']){
				
									$_SESSION['username'] = $username;
									$_SESSION['uid'] = $result['id'];

									header("location: members/userPage.php?activity=viewProfile");
								}
								else{
									include("employeeLogin.php");
									$errorMsg = "Incorrect User....";
								}
						}
						else{
							include("employeeLogin.php");
							$errorMsg = "Empty Domaine...";
						}
						
					}

				?>

				
				<?php
				//ADD MEMBER...
					             
                    $query = "Select Max(id) From members";
                    $returnD = mysql_query($query);
                    $result = mysql_fetch_assoc($returnD);
                    $maxRows = $result['Max(id)'];
                    if(empty($maxRows)){
                        $lastRow = $maxRows = 1;      
                    }else{
                        $lastRow = $maxRows + 1 ;
                    }

                    if(isset($_REQUEST['addMemberBtn'])){

                        $memberId = $_REQUEST['memberId'];
                        $firstName = $_REQUEST['firstName'];
                        $lastName = $_REQUEST['lastName'];
                        $username = $_REQUEST['username'];
                        $pwd = $_REQUEST['pwd'];
                        $position = $_REQUEST['position'];
                        $mobile = $_REQUEST['mobile'];
						$email = $_REQUEST['email'];

						$fnm = $_FILES['fnm'];

						$actualFileName = $fnm['name'];
						$tmpName = $fnm['tmp_name'];
						//$type = $fnm['type'];
						//$size = $fnm['size'];
						//$error = $fnm['error'];
						$targetLocation = "members/pic/$actualFileName";

                        if(!empty($memberId) && !empty($firstName) && !empty($lastName) && !empty($username) && !empty($pwd) && !empty($mobile)){

                        	$usernameExists = mysql_fetch_assoc(mysql_query("SELECT username FROM members WHERE username = '$username'"));

                            if($usernameExists['username'] != $username){

                            	$mobileExists = mysql_fetch_assoc(mysql_query("SELECT mobile FROM members WHERE mobile = '$mobile'"));

                            	if($mobileExists['mobile'] != $mobile){

                            		$emailExists = mysql_fetch_assoc(mysql_query("SELECT email FROM members WHERE email = '$email'"));

                            		if($emailExists['email'] != $email){

		                            	move_uploaded_file($tmpName, $targetLocation);

		                                $query = "Insert Into members(id,firstName,lastName,username,pwd,position,mobile,email,pic) Values('$memberId','$firstName','$lastName','$username','$pwd','$position','$mobile','$email','$actualFileName')";
		                                $res = mysql_query($query);

		                                if(!empty($res)){
			                                $errorMsg = "Add sucessfully.";
			                            }
			                                $query = "Select Max(id) From members";
			                                $returnD = mysql_query($query);
			                                $result = mysql_fetch_assoc($returnD);
			                                $maxRows = $result['Max(id)'];

			                                if(empty($maxRows)){
			                                    $lastRow = $maxRows = 1;      
			                                }else{
			                                    $lastRow = $maxRows + 1 ;
			                                }
		                            }
		                            else{
		                            	$errorMsg = "Existing E-mail. ";	
		                            }

		                        }
		                        else{
		                        	$errorMsg = "Existing Phone Number. ";
		                        }
                            }
                            else{
                                $errorMsg = "Existing User Name.";
                            }

                        }
                        else{
                            $errorMsg = "Sorry! Empty Domaine.";
                        }

                        include("register.php");
                    }

				?>

				<?php
                    //SEARCH Customer OR IP Address..

                        $searchList = $_REQUEST['searchList'];//SESSION['searchListValue'];
                        //echo $searchList;
                        if(isset($searchList)){

                            if($searchList == 'title'){

                                $searchField = $_REQUEST['searchField'];

                                if($searchField){

                                    $query = "SELECT customerId,title,ip,location,available FROM customers Where title LIKE '%$searchField%'";
                                    $returnD = mysql_query($query);
                                    $returnD1 = mysql_query($query);
                                    $result = mysql_fetch_assoc($returnD);

                                    if(empty($result)){
                                        $errorMsg = "Invalide Customer Name...";
                                    }

                                }
                                else{
                                    $errorMsg = "Field Can't be Empty...";
                                }

                            }
                            elseif($searchList == 'ip'){

                                $searchField = $_REQUEST['searchField'];

                                if(!empty($searchField)){

                                     $query = "SELECT customerId,title,ip,location,available FROM customers Where ip LIKE '%$searchField%'";
                                    $returnD = mysql_query($query);
                                    $returnD1 = mysql_query($query);
                                    $result = mysql_fetch_assoc($returnD);

                                    if(empty($result)){
                                        $errorMsg = "Incorrect IP Address...";
                                    }

                                }
                                else{
                                    $errorMsg = "Field Can't be Empty...";
                                }
                            }
                            elseif($searchList == 'customerId'){
                            	$searchField = $_REQUEST['searchField'];

                                if(!empty($searchField)){

                                     $query = "SELECT customerId,title,ip,location,available FROM customers Where customerId = '$searchField'";
                                    $returnD = mysql_query($query);
                                    $returnD1 = mysql_query($query);
                                    $result = mysql_fetch_assoc($returnD);

                                    if(empty($result)){
                                        $errorMsg = "Invalide ID...";
                                    }

                                }
                                else{
                                    $errorMsg = "Field Can't be Empty...";
                                }
                            }

                            include("search.php");
                        }
                ?>

                <?php
                //FORGET PASSWORD...

                	if(isset($_REQUEST['pwdSaveBtn'])){

                		$request = $_REQUEST['request'];

                		if($request == "admin"){
                			$regEmail = $_REQUEST['regEmail'];

							$query = mysql_query("SELECT email FROM admin WHERE email = '$regEmail'");
							$result = mysql_fetch_assoc($query);

							if($regEmail == $result['email']){

								$newP = $_REQUEST['newP'];
								$confirmP = $_REQUEST['confirmP'];

								if($newP == $confirmP){
									$query = mysql_query("UPDATE admin SET pwd = '$newP' WHERE email = '$regEmail'");

									if(!empty($query)){
										header("location: home.php?activity=adminLogin");
										//$errorMsg = "Password successfully changed.";
									}
								}
								else{
									//header("location: index.php?activity=forgetpwd");
									$errorMsg = "Password most be identical.";
								}
							}
							else{
								//header("location: index.php?activity=forgetpwd");
								$errorMsg = "Enter E-mail Address.";
							}
                		}
                		else if($request == "employee"){

							$regEmail = $_REQUEST['regEmail'];

							$query = mysql_query("SELECT email,position FROM members WHERE email = '$regEmail'");
							$result = mysql_fetch_assoc($query);

							if($regEmail == $result['email']){

								$newP = $_REQUEST['newP'];
								$confirmP = $_REQUEST['confirmP'];

								if($newP == $confirmP){

									$query = mysql_query("UPDATE members SET pwd = '$newP' WHERE email = '$regEmail'");

									if(!empty($query)){

										if($result['position'] == 'employee')
											header("location: home.php?activity=employeeLogin");
										else if($result['position'] == 'direction')
											header("location: home.php?activity=directionLogin");
										//$errorMsg = "Password successfully changed.";
									}
								}
								else{
									//header("location: index.php?activity=forgetpwd");
									$errorMsg = "Password Most Be Identical.";
								}
							}
							else{
								//header("location: index.php?activity=forgetpwd");
								$errorMsg = "Enter A valid E-mail Address.";
							}
						}
						include("forgetpwd.php");
					}

                ?>

				<?php
		        if(isset($errorMsg)){
		            ?>
		            <div class="errorMsg"><?php echo $errorMsg; ?></div>
	                <?php	
	        	}
		  		?>

			</div>

			</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
			<div class="footer">
				<?php include("footer.php"); ?>
	  </div>
		</div>
	</body>
</html>



