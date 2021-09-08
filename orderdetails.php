<?php

	include"database.php";
	session_start();
	unset ($_SESSION["AID"]);
	unset ($_SESSION["TRID"]);
	if(!isset($_SESSION["UID"]))
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
				<h3 class="text">Welcome <?php echo $_SESSION["UNAME"]; ?></h3><br><hr><br>
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
                            <th>Order_Item_ID</th>
                            <th>Product Name</th>
                            <th>Value</th>
                            <th>Quantity</th>
                            <th>subtotal</th>
                            <th>Status</th>
                            <th>Date</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$s="SELECT o.Order_ID, o.Date, o.Status,u.User_name,i.Order_Item_Id,i.P_NAME,i.Price,i.Quantity,i.subtotal FROM `order` o INNER JOIN `user` u ON u.User_ID=o.Customer_ID INNER JOIN `order_item` i ON i.Order_Id =o.Order_ID where u.User_ID={$_SESSION["UID"]}";
							$res=$db->query($s);
							if($res->num_rows>0 )
							{
								while($r=$res->fetch_assoc())
								{
									echo "
										<tr>
											<td>{$r["Order_ID"]}</td>                            
											<td>{$r["Order_Item_Id"]}</td>
											<td>{$r["P_NAME"]}</td>
											<td>{$r["Price"]}</td>
											<td>{$r["Quantity"]}</td>
											<td>{$r["subtotal"]}</td>  
                                            <td>{$r["Status"]}</td>
											<td>{$r["Date"]}</td>
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