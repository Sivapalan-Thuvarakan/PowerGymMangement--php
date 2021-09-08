<?php
	include"database.php";
	session_start();
	unset ($_SESSION["AID"]);
	if(!isset($_SESSION["TRID"]))
	{
		echo"<script>window.open('index.php?mes=Access Denied...','_self');</script>";
		
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
				<h3 class="text">Welcome <?php echo $_SESSION["TR_U_NAME"]; ?></h3><br><hr><br>
				<div class="content1">
					
					<h3 >Add Exercise Plan</h3><br>
				<?php
					$id="";
					$Traineename="";
					$update=false;
					if(isset($_GET["id"]))
					{
						 $update=true;
						 $id=$_GET['id'];
						 $sq="select * from user Where User_ID=$id";
						 $res=$db->query($sq);
						if($res->num_rows>0)
						{   
							$re=$res->fetch_assoc();
							$Traineename= $re["First_name"];
						}
					}
					if(isset($_POST["update"]))
					{
						$target_exercise="documents/exercise_diet/";
						$target_file_exercise=$target_exercise.basename($_FILES["document"]["name"]);  
							if(move_uploaded_file($_FILES['document']['tmp_name'],$target_file_exercise))
							{
								$id=$_POST["id"];
								$date=date('Y/m/d');
								$sq="INSERT INTO `exercise_and_diet_plan`( `Trainee_ID`, `Trainer_ID`, `Exercise_file`, `Date`) VALUES({$id},{$_SESSION["TRID"]},'{$target_file_exercise}',{$date})";
								$db->query($sq);
							}
					}

				
				?>
			<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data">
				<input type="hidden" name="id" value=<?php echo $id; ?>>
				<label>Trainee_Name</label><br>
				<input type="text" name="trainee_name" value="<?php echo $Traineename ?>" required class="input"><br><br>
				<label >Upload Exercise & Diet plan:</label>
				<input type="file"  class="input3" required name="document" ><br><br>
				<?php if($update):?>
				<button type="submit" class="btn" name="update">Update</button>
				<?php endif;?>
				
			</form>
			</div>
				<h3 >Your Trainee Details</h3><br>
					
					<?php
						if(isset($_GET["mes"]))
						{
							echo"<div class='error'>{$_GET["mes"]}</div>";	
						}
					
					?>
					<div  style="margin-right: 20px;margin-bottom: 70px;height: 600px;">
                  	<table class="styled-table">
						<thead>
						<tr>
							<th>Trainee_Name</th>
							<th>Package</th>
							<th>Pckage_status</th>
							<th>Medical Report</th>
                            <th>Assign Exercise & Diet plan</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$s="SELECT trainee.Trainee_ID,trainee.Trainer_ID,trainee.DOB,trainee.Gender,trainee.Package,trainee.Package_status,user.First_name,medical_reports.Medical_Report from trainee INNER JOIN user ON user.User_ID = trainee.Trainee_ID INNER JOIN medical_reports on medical_reports.Trainee_ID=trainee.Trainee_ID WHERE trainee.Trainer_ID={$_SESSION["TRID"]}";
							$res=$db->query($s);
							if($res->num_rows>0 )
							{
								while($r=$res->fetch_assoc())
								{
                                   
									echo "
										    <td>{$r["First_name"]}</td>
											<td>{$r["Package"]}</td>
											<td>{$r["Package_status"]}</td>										
											<td><a href='{$r["Medical_Report"]}'  >Medical Report</a></td> 
                                            <td><a href='assign_exercise_diet.php?id={$r["Trainee_ID"]}'  class='btnr'>Assign</a></td>
										</tr>
										";	
								}
                            }
						?>
					</tbody>
					</table>
				</div>
			</div>
		
				<?php include"footer.php";?>
	</body>
</html>