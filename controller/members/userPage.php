<?php
	session_start();

	include("../dbConfig.php");
	error_reporting(0);

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
		<link rel="icon" href="../../pic/favicon.png">
		<title>IPAM</title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/userPage.css">
		<link rel="stylesheet" type="text/css" href="../../css/home.css">
		<link rel="stylesheet" type="text/css" href="../../css/header.css">
		<link rel="stylesheet" type="text/css" href="../../css/navigation.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<body>
		<div class="container">
			<div class="header">
				<?php include("../header.php"); ?>
			</div>
			<div class="userContainer">
				<div class="title">
					<?php 
						
						if($result['position'] == 'employee'){
							echo "employee Section";
						}
						else if($result['position'] == 'direction'){
							echo "direction space";
						}
					?>
				</div>

				<div class="userWelcome">Welcome : <?php echo $_SESSION['username']; ?></div>

				<div class="logout"><a href="userPage.php?activity=logout">Log Out</a></div>

				<div class="userAction">
					<ul>
						<li><a href="userPage.php?activity=viewProfile">View Profile</a></li>
						<li><a href="userPage.php?activity=editProfile">Edite Profile</a></li>
						<li><a href="userPage.php?activity=addcustomer">ADD Customer IP</a></li>
						<li><a href="userPage.php?activity=requestForcustomerIP">Request Customer IP</a></li>
						<li><a href="#">Print</a></li>
					</ul>
				</div>

				<div class="userContent">
					<?php
					//ACTIVITY PERFORM...

						$activity = $_REQUEST['activity'];

						switch ($activity) {
							
							

								case 'addcustomer':
								include("addcustomer.php");
								break;	
	

							case 'requestForcustomerIP':
								include("requestForcustomerIP.php");
								break;	

							case 'customerDetails':
								include("customerDetails.php");
								break;

							case 'editProfile':
								include("editProfile.php");
								break;

							case 'viewProfile':
								include("viewProfile.php");
								break;


							default:
								//include("viewProfile.php");
								break;
						}
					?>

					<?php
	                //UPDATE MEMBER...

	                    if(isset($_REQUEST['updateMemberBtn'])){

	                        $umemberId = $_REQUEST['umemberId'];
	                        $firstName = $_REQUEST['firstName'];
	                        $lastName = $_REQUEST['lastName'];
	                        $position = $_REQUEST['position'];
	                        $mobile = $_REQUEST['mobile'];
	                        $email = $_REQUEST['email'];

	                        $imgEdit = $_FILES['imgEdit'];

							$actualFileName = $imgEdit['name'];
							$tmpName = $imgEdit['tmp_name'];
							//$type = $imgEdit['type'];
							//$size = $imgEdit['size'];
							//$error = $imgEdit['error'];
							$targetLocation = "pic/$actualFileName";

							move_uploaded_file($tmpName, $targetLocation);

	                        $query1 = mysql_query("UPDATE members Set firstName ='$firstName', lastName ='$lastName', position ='$position', mobile ='$mobile', email ='$email', pic = '$actualFileName' Where id = '$umemberId'");

	                        if($query1){
	                            //$errorMsg = "Updation is successfully done.";
	                            header("location: userPage.php?activity=viewProfile");
	                        }
	                        //include("editProfile.php");
	                    }    
	                ?>

					
					

					<?php 
                    //ADD CUSTOMER...

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
                            $customerip = $_REQUEST['customerip'];
                            $customerlocation = $_REQUEST['customerlocation'];
                            $customerstatus = $_REQUEST['customerstatus'];

                            if(!empty($customerId) && !empty($customerName) && !empty($customerip)){

                                if($maxRows){

                                    $query = "Insert Into customers(customerId,title,ip,location,status,available) Values('$customerId','$customerName','$customerip','$customerlocation','$customerstatus','1')";
                                    mysql_query($query);
                                    $errorMsg = "Customer  IP added successfully.";

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
                                $errorMsg = "please enter a value.";
                            }

                            include("addcustomer.php");
                        }
                    ?>

					<?php
					//REQUEST FOR CUSTOMERIP...

						if (isset($_REQUEST['customerRequestBtn'])) {
							
							$requestId = $_REQUEST['requestId'];
							$rcustomerName = $_REQUEST['rcustomerName'];
							$rcustomerip = $_REQUEST['rcustomerip'];
							$rdescription = $_REQUEST['rdescription'];

							if(!empty($requestId) && !empty($rcustomerName) && !empty($rcustomerip)){

								date_default_timezone_set('Asia/Kolkata');
	                            $dt = date("y/m/d h:i:s");

								$query = mysql_query("INSERT INTO requestforcustomers(requestId,customerName,customerip,description,requestDate) VALUES('$requestId','$rcustomerName','$rcustomerip','$rdescription','$dt')");

								if ($query) {
									$errorMsg = "Request Send Successfully.";
								}
							}
							else{
								$errorMsg = "Enter A value.";
							}

							include("requestForcustomerIP.php");
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