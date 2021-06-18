<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('admin_login.php?mes=Access Denied..','_self');</script>";
		
	}		
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Power Gym</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
	
		<?php include"navbar.php";?>
			<div id="section">
				<?php include"sidebar.php";?>
				<div class="content">
					<?php include"bootstrapcard.php";?>
					<h3 class="text">Welcome <?php echo $_SESSION["ANAME"]; ?></h3><br><hr><br>
						<h3 > Gym Information</h3><br>
					<img src="images/logo/mylogo.png" class="imgs">
					<p class="para">
						PowerGym Management System is a is a complete gym management software designed to automate a gym's various operations. 
					</p>
					
					<p class="para">
						This web based application has a powerful online community to bring Trainers,Trainees and Customes on a common interactive platform. It is a paperless office automation solution for today's modern schools. The School Management System provides the facility to carry out all day to day activities of the gym.
					</p>
				</div>
				
			</div>
	
		<?php include"footer.php";?>
	</body>
</html>