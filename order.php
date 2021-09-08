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
							<th>Order_ID</th>
                            <th>Customer_Name</th>
							<th>Province</th>
							<th>District</th>
							<th>Card Type</th>
							<th>Tel_no</th>
							<th>Zip</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Address</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$s="SELECT o.Order_ID, o.Province, o.District, o.Date, o.Cardtype,o.Phone_no,o.Zip,o.Status,o.Shipping_address,u.User_name FROM `order` o INNER JOIN `user` u ON u.User_ID=o.Customer_ID";
							$res=$db->query($s);
							if($res->num_rows>0 )
							{
								while($r=$res->fetch_assoc())
								{
									echo "
										<tr>
											<td>{$r["Order_ID"]}</td>                            
											<td>{$r["User_name"]}</td>
											<td>{$r["Province"]}</td>
											<td>{$r["District"]}</td>
											<td>{$r["Cardtype"]}</td>
											<td>{$r["Phone_no"]}</td>                            
											<td>{$r["Zip"]}</td>
                                            <td>{$r["Status"]}</td>
											<td>{$r["Date"]}</td>
                                            <td>{$r["Shipping_address"]}</td>
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