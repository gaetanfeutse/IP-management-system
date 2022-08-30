<?php
	session_start();
	include("../dbConfig.php");
	error_reporting(0);
	$username = $_SESSION['username'];

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
        header("location: ../home.php?activity=adminLogin");
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>IPAM</title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/userPage.css">
		<link rel="stylesheet" type="text/css" href="../../css/home.css">
		<link rel="stylesheet" type="text/css" href="../../css/header.css">
		<link rel="stylesheet" type="text/css" href="../../css/navigation.css">
		<link rel="stylesheet" type="text/css" href="../../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../../css/form.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<body>
		<div class="container">
			<div class="header">
				<?php include("../header.php"); ?>
			</div>
			<div class="userContainer">
				<div class="title">Administrator Space</div>

				<div class="userWelcome">Welcome : <?php echo $_SESSION['username']; ?></div>

				<div class="logout"><a href="adminPage.php?activity=logout">Log Out</a></div>

				<div class="userAction">
					<ul>
						<li><a href="adminPage.php?activity=adminDashboard">Dashboard</a></li>
						<li><a href="adminPage.php?activity=viewProfile">View profile</a></li>
						<li><a href="adminPage.php?activity=editProfile">Edite profile</a></li>
						<li><a href="adminPage.php?activity=viewUsers">View User</a></li>
						<li><a href="adminPage.php?activity=addcustomer">Add Customer IP</a></li>
						<li><a href="adminPage.php?activity=viewcustomer">View Customer IP</a></li>
						<li><a href="adminPage.php?activity=viewcustomerRequest">View request</a></li>
						<li><a href="#">Print</a></li>
					</ul>
				</div>

				<div class="userContent">
					<?php
					//ACTIVITY PERFORM...

						$activity = $_REQUEST['activity'];

						switch ($activity) {
							case 'adminDashboard':
								include("adminDashboard.php");
								break;
							
							case 'viewProfile':
								include("viewProfile.php");
								break;

							case 'editProfile':
								include("editProfile.php");
								break;

							case 'viewUsers':
								include("viewUsers.php");	
								break;	

							case 'addcustomer':
								include("addcustomer.php");
								break;	

							case 'viewcustomer':
								include("viewcustomer.php");
								break;

							case 'customerDetails':
								include("customerDetails.php");
								break;

							case 'viewUserProfile':
								include("viewUserProfile.php");
								break;

							case 'viewcustomerRequest':
								include("viewcustomerRequest.php");
								break;

							case 'deletecustomer':
									
                                	$deletecustomerId = $_REQUEST['deletecustomerId'];

                                	$result = mysql_num_rows(mysql_query("SELECT customerId FROM borrow Where customerId = '$deletecustomerId'"));
                                	$availabilitycustomer = mysql_num_rows(mysql_query("SELECT customerId FROM customers WHERE available = '1' && customerId = '$deletecustomerId'"));
                               
                                	if(empty($result) && !empty($availabilitycustomer)){
                                		$deleteResult = mysql_query("Delete From customers Where customerId = '$deletecustomerId'");

                                		header("location: adminPage.php?activity=viewcustomer");
                                	}
                                	else{
                                		include("viewcustomer.php");
                                		$errorMsg = "IP send already.";
                                	}

                            	break;

                            case 'updatecustomer':
                            		
                            		$ucustomerId = $_REQUEST['ucustomerId'];

                            		if(!empty($ucustomerId)){

                            			$result = mysql_fetch_assoc(mysql_query("SELECT available FROM customers WHERE customerId = '$ucustomerId'"));

                            			if($result['available'] == 1){

	                            			$result = mysql_fetch_assoc(mysql_query("SELECT title,ip,location,status FROM customers WHERE customerId = '$ucustomerId'"));
	                            			?>
	                            			<div class="title">Edit Customer Info</div>
	                            			<div class="CustomerUpdateForm">
	                            				<form action="adminPage.php">
	                            					<input type="text" name="ucustomerId" value=<?php echo $ucustomerId; ?> readonly><br>
	                            					<input type="text" name="title" required autofocus placeholder="Customer Name" value=<?php echo $result['title']; ?>><br>
	                            				<input type="text" name="ip" required autofocus placeholder="IP Address"  title="Enter valide IP Address." minlength="7" maxlength="15" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$" value=<?php echo $result['ip'];; ?>><br>
	                
	                            					<input type="text" name="location" required autofocus placeholder="Location" value=<?php echo $result['location'];; ?>><br>
	                            					<input type="text" name="status" required autofocus placeholder="Status" value=<?php echo $result['status'];; ?>><br>

	                            					<input type="submit" name="updatecustomerBtn" value="Update">
	                            				</form>
	                            			</div>
	                            			<?php
                            			}
                            			else{
                            				include("viewcustomer.php");
                            				$errorMsg = "Customer IP has been requested by another user so it can not be Edite";
                            			}
                            		}

                            	break;

                            case 'dcustomerRequest':
                            			
                            		$rd = $_REQUEST['rd'];

                                	if(!empty($rd)){
                                		$deleteResult = mysql_query("Delete From requestforcustomers Where requestDate = '$rd'");

                                	}
                                	header("location: adminPage.php?activity=viewcustomerRequest");

                            	break;
									
							default:
								include("adminDashboard.php");
								break;
						}
					?>

					<?php
					//UPDATE CUSTOMER...

						if(isset($_REQUEST['updatecustomerBtn'])){

							$ucustomerId = $_REQUEST['ucustomerId'];
							$title = $_REQUEST['title'];
							$ip = $_REQUEST['ip'];
							$location = $_REQUEST['location'];
							$status = $_REQUEST['status'];

							if(!empty($title) && !empty($ip) && !empty($location) && !empty($status)){

								$result = mysql_query("UPDATE customers SET title = '$title', ip = '$ip', location = '$location', status = '$status' WHERE customerId = '$ucustomerId'");

								if(!empty($result)){
									header("location: adminPage.php?activity=viewcustomer");
								}
							}
							else{
								$errorMsg = "Plaese enter a value.";
							}
						}

					?>

					<?php
	                //Edit Admin...

	                    if(isset($_REQUEST['adminUpdateBtn'])){

	                        $uadminId = $_REQUEST['uadminId'];
	                        $firstName = $_REQUEST['firstName'];
	                        $lastName = $_REQUEST['lastName'];
	                        $username = $_REQUEST['username'];
	                        $pwd = $_REQUEST['pwd'];
	                        $email = $_REQUEST['email'];

	                        $imgEdit = $_FILES['imgEdit'];

							$actualFileName = $imgEdit['name'];
							$tmpName = $imgEdit['tmp_name'];
							//$type = $imgEdit['type'];
							//$size = $imgEdit['size'];
							//$error = $imgEdit['error'];
							$targetLocation = "pic/$actualFileName";

							move_uploaded_file($tmpName, $targetLocation);

	                        $query1 = mysql_query("UPDATE admin Set firstName ='$firstName', lastName ='$lastName', username ='$username', pwd ='$pwd', email ='$email', pic ='$actualFileName' Where id = '$uadminId'");

	                        if($query1){
	                            //$errorMsg = "Updation is successfully done.";
	                            header("location: adminPage.php?activity=viewProfile");
	                        }
	                        //include("editProfile.php");
	                    }    
	                ?>

                    <?php 
                    //ADD CUSTOMERIP...

                        $query = "Select Max(customerId) From customers";
                        $returnD = mysql_query($query);
                        $result = mysql_fetch_assoc($returnD);
                        $maxRows = $result['Max(customerId)'];
                        if(empty($maxRows)){
                            $lastRow = $maxRows = 1001;      
                        }else{
                            $lastRow = $maxRows + 1 ;
                        }

                        if(isset($_REQUEST['addcustomerBtn'])){

                            $customerId = $_REQUEST['customerId'];
                            $customerName = $_REQUEST['customerName'];
                            $customerName = $_REQUEST['customerName'];
                            $customerlocation = $_REQUEST['customerlocation'];
                            $customerstatus = $_REQUEST['customerstatus'];

                            if(!empty($customerId) && !empty($customerName) && !empty($customerName)){

                                if($maxRows){

                                    $query = "Insert Into customers(customerId,title,ip,location,status,available) Values('$customerId','$customerName','$customerName','$customerlocation','$customerstatus','1')";
                                    mysql_query($query);
                                    $errorMsg = "Customer IP added successfully..";

                                    $query = "Select Max(customerId) From customers";
                                    $returnD = mysql_query($query);
                                    $result = mysql_fetch_assoc($returnD);
                                    $maxRows = $result['Max(customerId)'];
                                    if(empty($maxRows)){
                                        $lastRow = $maxRows = 1001;      
                                    }else{
                                        $lastRow = $maxRows + 1 ;
                                    }
                                }
                                else{
                                    $errorMsg = "The table is empty.";
                                }

                            }
                            else{
                                $errorMsg = "Please enter a value .";
                            }

                            include("addcustomer.php");
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
			</div>
		</div>
	</body>
</html>