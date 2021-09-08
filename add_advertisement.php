<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('admin_login.php?mes=Access Denied...','_self');</script>";
    
	}	
    $description='';$button='';$update=false;$id=0;$image='';
    
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
					
						<h3>Add Advertisement</h3><br>
					<?php
						if(isset($_POST["Addadvertisement"]))
						{   
                                $sq="insert into advertisement (Advertisement_img,Description)
                                values('{$_POST["Advertisement_img"]}','{$_POST["Description"]}')";
                                
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
							 $sq="select * from advertisement Where Advertisement_ID=$id";
                             $res=$db->query($sq);
							if($res->num_rows>0)
							{   
                                $re=$res->fetch_assoc();
                                $description= $re["Description"];
                                $image= $re["Advertisement_img"];
							}
						}
						if(isset($_POST["update"]))
						{
								$id=$_POST["id"];
                                $sq="update advertisement set Advertisement_img='{$_POST["Advertisement_img"]}',Description='{$_POST["Description"]}'
                                where Advertisement_ID=$id";
								$db->query($sq);
                     
						}

					
					?>
				<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
				    <input type="hidden" name="id" value=<?php echo $id; ?>>
					<label>Description</label><br>
					<input type="text" name="Description" value="<?php echo $description ?>" required class="input"><br><br>
                    <label>Select image:</label>
                    <input type="file" id="img" name="Advertisement_img" value="<?php echo $image ?>" ><br>
					<?php if($update):?>
					<button type="submit" class="btn" name="update">Update</button>
					<?php else:?>
					<button type="submit" class="btn" name="Addadvertisement">Add advertisement</button>
					<?php endif;?>
					
				</form>
				</div>
				
					<h3 style="margin-top:30px;"> Product Details</h3><br>
					<?php
						if(isset($_GET["mes"]))
						{
							echo"<div class='error'>{$_GET["mes"]}</div>";	
						}
					
					?>
                     <div  style="margin-right: 20px;margin-bottom: 70px;height: 600px; overflow: hidden;">
                  	<table class="styled-table">
						<thead>
                            <tr>
                                <th>Advertisement ID</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
						</thead>
						<tbody>
				 	<?php
							$s="select * from advertisement";
							$res=$db->query($s);
							if($res->num_rows>0)
							{
								
								while($r=$res->fetch_assoc())
								{
									
									echo "
										<tr>
											<td>{$r["Advertisement_ID"]}</td>
											<td>{$r["Advertisement_img"]}</td>
											<td>{$r["Description"]}</td>
                                            <td><a href='add_advertisement.php?id={$r["Advertisement_ID"]}'  class='btnr'>Edit</a></td>
											<td><a href='advertisement_delete.php?id={$r["Advertisement_ID"]}' class='btnr'>Delete</a></td>
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