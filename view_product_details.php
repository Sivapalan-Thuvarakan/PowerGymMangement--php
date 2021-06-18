<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('admin_login.php?mes=Access Denied...','_self');</script>";
		
	}
	$sql="SELECT * FROM product WHERE Product_ID={$_GET["id"]}";
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
					
						<h3 > View Product Details</h3><br>
						<div class="ibox">
						<img src="images/products/<?php echo $row["Image"]; ?>" height="230" width="230">
							
						</div>
						<div class="tsbox">
						<table border="1px">
						
							<tr><th>Product Name </th> <td> <?php echo $row["Product_Name"]; ?></td></tr>
							<tr><th>Description</th> <td> <?php echo $row["Product_Description"]; ?></td></tr>
							<tr><th>Quantity</th> <td> <?php echo $row["Quantity"]; ?></td></tr>
							<tr><th>price </th> <td> <?php echo $row["Price"]; ?></td></tr>
                            <tr><th>image </th> <td> <?php echo $row["Image"]; ?></td></tr>
                            <tr><th>Brand</th> <td> <?php echo $row["Brand_ID"]; ?></td></tr>
							<tr><th>Category </th> <td> <?php echo $row["Category_ID"]; ?></td></tr>
                            <tr><th>Size </th> <td> <?php echo $row["Size_ID"]; ?></td></tr>
                            <tr><th>Colour </th> <td> <?php echo $row["Colour_ID"]; ?></td></tr>
						</table>
						
						</div>
				</div>	
			</div>
			<?php include"footer.php";?>
			
	</body>
</html>