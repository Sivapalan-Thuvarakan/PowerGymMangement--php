<?php
	include"database.php";
	session_start();
	unset ($_SESSION["AID"]);
	unset ($_SESSION["UID"]);
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
		
					
			
					<div  style="margin-right: 20px;margin-bottom: 70px;height: 600px;">
                  	<table class="styled-table">
						<thead>
						<tr>
							<th>Trainee_Name</th>
                            <th>DOB</th>
							<th>Gender</th>
							<th>Package</th>
							<th>Pckage_status</th>
							<th>Medical Report</th>
							<th>Exercise & Diet plan</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$s="SELECT trainee.Trainee_ID,trainee.Trainer_ID,trainee.DOB,trainee.Gender,trainee.Package,trainee.Package_status,user.First_name,medical_reports.Medical_Report,exercise_and_diet_plan.Exercise_file 
							from trainee INNER JOIN user ON user.User_ID = trainee.Trainee_ID INNER JOIN medical_reports on medical_reports.Trainee_ID=trainee.Trainee_ID INNER JOIN exercise_and_diet_plan ON exercise_and_diet_plan.Trainee_ID=medical_reports.Trainee_ID WHERE trainee.Trainer_ID={$_SESSION["TRID"]}";
							$res=$db->query($s);
							if($res->num_rows>0 )
							{
								while($r=$res->fetch_assoc())
								{
                                   
									echo "
										    <td>{$r["First_name"]}</td>                       
											<td>{$r["DOB"]}</td>
											<td>{$r["Gender"]}</td>
											<td>{$r["Package"]}</td>
											<td>{$r["Package_status"]}</td>										
											<td><a href='{$r["Medical_Report"]}'  >Medical Report</a></td>                           
											<td><a href='{$r["Exercise_file"]}'  >Exercise & Diet plan</a></td>
                                            
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