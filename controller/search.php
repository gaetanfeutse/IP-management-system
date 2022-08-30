<!DOCTYPE html>
<html>
	<head>
		<title>IPAM</title>
		<link rel="stylesheet" type="text/css" href="../css/title.css">
		<link rel="stylesheet" type="text/css" href="../css/inputs.css">
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<link rel="stylesheet" type="text/css" href="../css/table.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
	<body>
		<div class="title">search</div>
		<form action="home.php" class="searchForm">
			<div class="searchFormList"></div>

			<div>
				<span class="searchFormList">
				<select name="searchList" required autofocus>
                  <option value="">Select An Option:</option>
                  <option value="title">customer Name</option>
                  <option value="ip">IP Address</option>
                </select>
				</span>
				<input type="text" name="searchField" class="searchFormField" required autofocus placeholder="searche" value=<?php echo $_REQUEST['searchField']; ?>>
		  </div>
		</form>
		
			<div class="title">List Of Customer IP</div>
			<table>
				<tr>
					<th>Customer ID</th>
					<th>Name</th>
					<th>IP</th>
					<th>Location</th>
					<th>Status</th>
				</tr>
			<?php
			while($result1 = mysql_fetch_assoc($returnD1)){
				//print_r($result1B);
				?>
				<tr>
				<?php
					foreach ($result1 as $k => $v) {	
						?>
							<td>
								<?php 
									if($k == 'title'){
										echo $v;
									}
									elseif($k == 'available'){
										if($result1['available'] == 1){
											$v = 'active';
										}
										elseif($result1['available'] == 0){
											$v = 'passive';
										}
										echo $v;
									}
									else{
										echo ucfirst($v);
									}
								?>
							</td>
						<?php
						}
				?>
				</tr>
				<?php
				}
			?>
		</table>
	</body>
</html>