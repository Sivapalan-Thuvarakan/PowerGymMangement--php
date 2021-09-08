<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('admin_login.php?mes=Access Denied...','_self');</script>";
		
	}
	$sql="select customer.Customer_ID,user.User_name,user.First_name,user.Last_name,user.Tel_no,user.Email,
    customer.Address,customer.Image,customer.DOB,customer.Gender from user,customer where user.User_ID={$_GET["id"]}";
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
					
						<h3 > View Customer Details</h3><br>
						<div class="ibox">
							<img src="images/customers/<?php echo $row["Image"]; ?>" height="230" width="230">
							
						</div>
		
                  		<table class="styled-table">
						<tbody>
							<tr><th>User Name </th> <td> <?php echo $row["User_name"]; ?></td></tr>
							<tr><th>First name</th> <td> <?php echo $row["First_name"]; ?></td></tr>
							<tr><th>Last name</th> <td> <?php echo $row["Last_name"]; ?></td></tr>
							<tr><th>Email </th> <td> <?php echo $row["Email"]; ?></td></tr>
                            <tr><th>Tel no </th> <td> <?php echo $row["Tel_no"]; ?></td></tr>
                            <tr><th>Address</th> <td> <?php echo $row["Address"]; ?></td></tr>
							<tr><th>DOB </th> <td> <?php echo $row["DOB"]; ?></td></tr>
                            <tr><th>Gender </th> <td> <?php echo $row["Gender"]; ?></td></tr>
						</tbody>
						</table>
				</div>	
			</div>
			<?php include"footer.php";?>
			
	</body>
</html>