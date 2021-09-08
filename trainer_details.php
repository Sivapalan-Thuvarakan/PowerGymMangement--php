<?php
	include"database.php";
	session_start();
    unset ($_SESSION["AID"]);
	unset ($_SESSION["TRID"]);
	if(!isset($_SESSION["UID"]))
	{
		echo"<script>window.open('index.php?mes=Access Denied...','_self');</script>";
		
	}
    $sql="SELECT Trainer_ID FROM trainee WHERE 	Trainee_ID={$_SESSION["UID"]}";
	$resuser=$db->query($sql);
	if($resuser->num_rows>0)
	{
			$rowuser=$resuser->fetch_assoc();
	}
    $sqluser="SELECT * FROM trainer WHERE `Trainer_ID`={$rowuser['Trainer_ID']}";
	$restrainer=$db->query($sqluser);
	if($restrainer->num_rows>0)
	{
			$rowtrainer=$restrainer->fetch_assoc();
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
				<?php include"sidebar.php";?><br>
				<h3 class="text">Welcome <?php echo $_SESSION["UNAME"]; ?></h3><br><hr><br>
				<div class="content1">
				</div>
					<h3 style="margin-top:30px;"> Trainer Details</h3><br>
					<?php
						if(isset($_GET["mes"]))
						{
							echo"<div class='error'>{$_GET["mes"]}</div>";	
						}
					
					?>
					 <div  style="margin-right: 20px;margin-bottom: 70px;height: 600px; overflow: hidden;">
                 	

						<table border="1px">
													<tr><td colspan="2"><img src="<?php echo $rowtrainer["Image"] ?>" height="100" width="100" alt="upload Pending"></td></tr>
													<tr><th>User Name </th> <td><?php echo $rowtrainer["user_name"] ?> </td></tr>
													<tr><th> Name </th> <td><?php echo $rowtrainer["Trainer_name"] ?>  </td></tr>
													<tr><th>Email </th> <td> <?php echo $rowtrainer["Trainer_name"] ?>  </td></tr>
													<tr><th>Phone No </th> <td> <?php $rowtrainer["Trainer_name"] ?> </td></tr>
													<tr><th>Gender</th> <td> <?php echo $rowtrainer["Gender"] ?> </td></tr>
													<tr><th>DOB</th> <td> <?php echo $rowtrainer["DOB"] ?>  </td></tr>
													<tr><th>Address</th> <td> <?php echo $rowtrainer["Address"] ?>  </td></tr>
						</table>
				</div>

			</div>
	
				<?php include"footer.php";?>
	</body>
</html>