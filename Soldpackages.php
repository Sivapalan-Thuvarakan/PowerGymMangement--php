<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
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
				<h3 class="text">Welcome <?php echo $_SESSION["ANAME"]; ?></h3><br><hr><br>
				<h3>Registered Package Details</h3><br>
					
					<?php
						if(isset($_GET["mes"]))
						{
							echo"<div class='error'>{$_GET["mes"]}</div>";	
						}
					
					?>
					<div  style="margin-right: 20px;margin-bottom: 70px;height: 600px;overflow:auto;">
                  	<table class="styled-table">
						<thead>
						<tr>
							<th>Registration_ID</th>
                            <th>Trainee Name</th>
							<th>Package Name</th>
							<th>Fees</th>
                            <th>Purchase Date</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$s="select t.User_name,p.Package_name,r.Registration_ID,r.Fees,r.Consume_date
                            from `registration` r INNER JOIN `user` t on t.User_ID = r.Trainee_ID INNER JOIN
                            `package` p on r.Package_ID=P.Package_ID";
							$res=$db->query($s);
							if($res->num_rows>0 )
							{
								while($r=$res->fetch_assoc())
								{
									echo "
										<tr>
											<td>{$r["Registration_ID"]}</td>                            
											<td>{$r["User_name"]}</td>
											<td>{$r["Package_name"]}</td>
											<td>{$r["Fees"]}</td>
											<td>{$r["Consume_date"]}</td>
											</td>
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