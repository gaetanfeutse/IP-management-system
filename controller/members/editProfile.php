
<?php
	include("../dbConfig.php");

	$uid = $_SESSION['uid'];
    
    $query = mysql_query("SELECT firstName,lastName,position,mobile,email From members Where id = '$uid'");
    $result = mysql_fetch_assoc($query);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>IPAM</title>
		<link rel="stylesheet" type="text/css" href="../../css/title.css">
		<link rel="stylesheet" type="text/css" href="../../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../../css/form.css">
		<link rel="stylesheet" type="text/css" href="../../css/editProfile.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<body>

		<div class="title">Edite A Member</div>
	    <div class="updatearea">
			<form action="userPage.php" method="POST" enctype="multipart/form-data" class="updateForm">
		        <input type="text" name="umemberId" value=<?php echo $uid; ?> readonly><br>
		        <input type="text" name="firstName" required autofocus pattern="[A-Za-z]{3,}" value=<?php echo $result['firstName']; ?>><br>
		        <input type="text" name="lastName" required autofocus value=<?php echo $result['lastName']; ?>><br>

					<div class="updateFormList" required autofocus>
		            	<select name="position">
		                	<option value="">Select</option>
		                    <option value="employee" <?php if($result['position'] == "employee"){ ?> selected <?php } ?>>Employee</option>
		                    <option value="direction" <?php if($result['position'] == "direction"){ ?> selected <?php } ?> >Stranger</option>
		                </select>
		            </div> <br>

		        <input type="text" name="mobile" required autofocus pattern="[0-9]{9}" value=<?php echo $result['mobile']; ?>><br>
		        <input type="email" name="email" required autofocus value=<?php echo $result['email']; ?>><br>

		        <div class="inputs">
		        	<label>Télécharger une photo : </label><input type="file" name="imgEdit" value="Télécharger une photo">
		        </div><br>

		        <input type="submit" name="updateMemberBtn" value="Modifier"><br>
	        </form>
	    </div>

	</body>
</html>