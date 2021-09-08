<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('admin_login.php?mes=Access Denied...','_self');</script>";
		
	}
	$sql="SELECT * FROM package WHERE Package_ID={$_GET["id"]}";
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
					
						<h3 > View Package Details</h3><br>
						<div class="ibox">
							<img src="images/packages/<?php echo $row["Image"]; ?>" height="230" width="230">
							
						</div>
						<div class="tsbox">
						<table  class="styled-table">
						<tbody>
							<tr><th>Package Name </th> <td> <?php echo $row["Package_name"]; ?></td></tr>
							<tr><th>Description</th> <td> <?php echo $row["Package_Description"]; ?></td></tr>
							<tr><th>Duration</th> <td> <?php echo $row["Duration"]; ?></td></tr>
							<tr><th>price </th> <td> <?php echo $row["Price"]; ?></td></tr>
						</tbody>
						</table>
						
						</div>
				</div>	
			</div>
			<?php include"footer.php";?>
			
	</body>
</html>