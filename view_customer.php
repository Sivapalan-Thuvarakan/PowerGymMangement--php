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
				<h3 >Customer Details</h3><br>
					
					<?php
						if(isset($_GET["mes"]))
						{
							echo"<div class='error'>{$_GET["mes"]}</div>";	
						}
					
					?>
					<div  style="margin-right: 20px;margin-bottom: 70px;height: 600px; overflow-y: scroll; overflow-x: hidden;">
                  	<table class="styled-table">
						<thead>
						<tr>
							<th>Customer_ID</th>
                            <th>First_name</th>
							<th>Last_name</th>
							<th>user name</th>
							<th>Address</th>
							<th>Tel_no</th>
							<th>Email</th>
							<th>DOB</th>
                            <th>Gender</th>
                            <th>View</th>
							<th>Remove</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$s="select customer.Customer_ID,user.User_name,user.First_name,user.Last_name,user.Tel_no,user.Email,
							customer.Address,customer.Image,customer.DOB,customer.Gender from user,customer where user.User_ID=customer.Customer_ID
							order by customer.customer_ID";
							$res=$db->query($s);
							if($res->num_rows>0 )
							{
								while($r=$res->fetch_assoc())
								{
									echo "
										<tr>
											<td>{$r["Customer_ID"]}</td>                            
											<td>{$r["First_name"]}</td>
											<td>{$r["Last_name"]}</td>
											<td>{$r["User_name"]}</td>
											<td>{$r["Address"]}</td>
											<td>{$r["Tel_no"]}</td>                            
											<td>{$r["Email"]}</td>
											<td>{$r["DOB"]}</td>
											<td>{$r["Gender"]}</td>
                                            <td><a href='view_customer_details.php?id={$r["Customer_ID"]}'  class='btnr'>view</a></td>
											<td><a href='remove_customer.php?id={$r["Customer_ID"]}' class='btnr'>Remove</a></td>
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