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
				<h3 >Order Details</h3><br>
					
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
							<th>Deliver_ID</th>
                            <th>Order_ID</th>
							<th>Date</th>
							<th>Delivery_Com</th>
							<th>Remarks</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$s="SELECT * FROM `delivery`";
							$res=$db->query($s);
							if($res->num_rows>0 )
							{
								while($r=$res->fetch_assoc())
								{
									echo "
										<tr>                          
											<td>{$r["Delivery_Id"]}</td>
											<td>{$r["Order_ID"]}</td>
											<td>{$r["date"]}</td>
											<td>{$r["Delivery_Com"]}</td>
											<td>{$r["Remarks"]}</td>
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