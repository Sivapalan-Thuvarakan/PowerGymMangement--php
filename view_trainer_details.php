<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('admin_login.php?mes=Access Denied...','_self');</script>";
		
	}
	$sql="SELECT * FROM trainer WHERE Trainer_ID={$_GET["id"]}";
		$res=$db->query($sql);

		if($res->num_rows>0)
		{
			$row=$res->fetch_assoc();
		}	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Power Gym</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<?php include"navbar.php";?><br>
			<div id="section">
				<?php include"sidebar.php";?><br><br><br>
				<h3 class="text">Welcome <?php echo $_SESSION["ANAME"]; ?></h3><br><hr><br>
				<div class="content1">
					
						<h3 > View Trainer Details</h3><br>
						<div class="ibox">
							<img src="<?php echo $row["Image"]; ?>" height="230" width="230">
							
						</div>
						<div class="tsbox">
						<table border="1px">
                            <tr><th>Trainer_ID </th> <td> <?php echo $row["Trainer_ID"]; ?></td></tr>
							<tr><th>Trainer_name </th> <td> <?php echo $row["Trainer_name"]; ?></td></tr>
							<tr><th>user_name</th> <td> <?php echo $row["user_name"]; ?></td></tr>
                            <tr><th>password</th> <td> <?php echo $row["password"]; ?></td></tr>
							<tr><th>Gender</th> <td> <?php echo $row["Gender"]; ?></td></tr>
							<tr><th>Address </th> <td> <?php echo $row["Address"]; ?></td></tr>
                            <tr><th >CV</th><td><a href='{$r["CV"]}'>cv document</a></td></tr>
						</table>
						
						</div>
				</div>	
			</div>
			<?php include"footer.php";?>
			
	</body>
</html>