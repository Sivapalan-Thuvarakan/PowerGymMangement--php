<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('admin_login.php?mes=Access Denied...','_self');</script>";
    
	}	
    $packagename='';$price='';$description='';$duration='';$button='Addproduct';$update=false;$id=0;$image='';
    
?>

<!DOCTYPE html>
<html>
	<head>
		<title>PowerGym</title>
       <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">-->
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<?php include"navbar.php";?><br>
		<!--<img src="images/poster/add_product.jpg" style="margin-left:90px;" class="sha">-->
			<div id="section">
				<?php include"sidebar.php";?><br>
				<h3 class="text">Welcome <?php echo $_SESSION["ANAME"]; ?></h3><br><hr><br>
				<div class="content1">
					
						<h3 > Add Package</h3><br>
					<?php
						if(isset($_POST["addpackage"]))
						{   
                                $sq="insert into package (Package_name,Package_Description,Duration,Price,Image)
                                values('{$_POST["package_name"]}','{$_POST["package_description"]}',{$_POST["package_duration"]},{$_POST["package_price"]},'{$_POST["package_image"]}')";
                                
                                if($db->query($sq))
                                {
                                    echo "<div class='success'>Insert Success..</div>";
                                }
                                else
                                {
                                    echo "<div class='error'>Insert failed..</div>";
                                }
                            
						}
                        if(isset($_GET["id"]))
						{
                             $update=true;
                             $id=$_GET['id'];
							 $sq="select * from package Where Package_ID=$id";
                             $res=$db->query($sq);
							if($res->num_rows>0)
							{   
                                $re=$res->fetch_assoc();
                                $packagename= $re["Package_name"];
                                $price= $re["Price"];
                                $description= $re["Package_Description"];
                                $duration=$re["Duration"];
                                $image= $re["Image"];
							}
						}
						if(isset($_POST["update"]))
						{
								$id=$_POST["id"];
                                $sq="update package set Package_name='{$_POST["package_name"]}',Price={$_POST["package_price"]},Image='{$_POST["package_image"]}',Package_Description='{$_POST["package_description"]}',Duration='{$_POST["package_duration"]}'
                                where Package_ID=$id";
                              
                                $db->query($sq);
                     
						}

					
					?>
				<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
				    <input type="hidden" name="id" value=<?php echo $id; ?>>
					<label>Package Name</label><br>
					<input type="text" name="package_name" value="<?php echo $packagename ?>" required class="input"><br><br>
					<label>Description</label><br>
					<input type="text" name="package_description" value="<?php echo $description ?>" required class="input"><br><br>
					<label>Duration(Months)</label><br>
					<input type="text" name="package_duration" value="<?php echo $duration ?>" required class="input"><br><br>
                    <label>Price</label><br>
					<input type="text" name="package_price" value="<?php echo $price ?>" required class="input" ><br><br>
                    <label>Select image:</label>
                    <input type="file" id="img" name="package_image" value="<?php echo $re["Image"] ?>" ><br>
					<?php if($update):?>
					<button type="submit" class="btn" name="update">Update</button>
					<?php else:?>
					<button type="submit" class="btn" name="addpackage">Add package</button>
					<?php endif;?>
					
				</form>
				</div>
				<div class="tbox" style="margin-bottom: 70px;">
					<h3 style="margin-top:30px;"> Product Details</h3><br>
					<?php
						if(isset($_GET["mes"]))
						{
							echo"<div class='error'>{$_GET["mes"]}</div>";	
						}
					
					?>
                    <div id="table">
					<table border="1px" >
						
                            <tr>
                                <th>Package ID</th>
                                <th>package name</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Durations</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        
				 	<?php
							$s="select * from package";
							$res=$db->query($s);
							if($res->num_rows>0)
							{
								
								while($r=$res->fetch_assoc())
								{
									
									echo "
										<tr>
											<td>{$r["Package_ID"]}</td>
											<td>{$r["Package_name"]}</td>
											<td>{$r["Price"]}</td>
											<td>{$r["Image"]}</td>
											<td>{$r["Package_Description"]}</td>
                                            <td>{$r["Duration"]}</td>
                                            <td><a href='add_package.php?id={$r["Package_ID"]}'  class='btnr'>Edit</a></td>
											<td><a href='package_delete.php?id={$r["Package_ID"]}' class='btnr'>Delete</a></td>
										</tr>
										";
									
								}
								
							}
						?>
					
					</table>
                        </div>
				</div>
			</div>
	
				<?php include"footer.php";?>
	</body>
</html>