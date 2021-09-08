<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('admin_login.php?mes=Access Denied...','_self');</script>";
    
	}	
    $Traineename='';$update=false;$id=0;
    
?>

<!DOCTYPE html>
<html>
	<head>
		<title>PowerGym</title>
       <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
	   <link rel="stylesheet" type="text/css" href="css/style.css">
	   <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
	</head>
	<body>
		<?php include"navbar.php";?><br>
		<!--<img src="images/poster/add_product.jpg" style="margin-left:90px;" class="sha">-->
			<div id="section">
				<?php include"sidebar.php";?><br>
				<h3 class="text">Welcome <?php echo $_SESSION["ANAME"]; ?></h3><br><hr><br>
				<div class="content1">
					
						<h3 > Assign Trainers to Trainees</h3><br>
					<?php
                        if(isset($_GET["id"]))
						{
                             $update=true;
                             $id=$_GET['id'];
							 $sq="select * from user Where User_ID=$id";
                             $res=$db->query($sq);
							if($res->num_rows>0)
							{   
                                $re=$res->fetch_assoc();
                                $Traineename= $re["First_name"];
							}
						}
						if(isset($_POST["update"]))
						{
							
									$id=$_POST["id"];
									$sq="update trainee set Trainer_ID='{$_POST["Trainer"]}'
									where Trainee_ID=$id";
									$db->query($sq);
						}

					
					?>
				<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
				    <input type="hidden" name="id" value=<?php echo $id; ?>>
					<label>Trainee_Name</label><br>
					<input type="text" name="trainee_name" value="<?php echo $Traineename ?>" required class="input"><br><br>
                    <label>Select Trainer</label>&#160;&#160;
                    <select name="Trainer"  id="trainer">
                    <?php
                        $s="select * from trainer";//to get category from category table
                        $res=$db->query($s);
                        if($res->num_rows>0)
							{
								$i=0;
								while($r=$res->fetch_assoc())
								{
									$i++;
									echo "
                                        <option value='{$r["Trainer_ID"]}'>{$r["Trainer_name"]}</option>
										";
									
								}
								
							}
                    ?>
					</select><br><br>
					<?php if($update):?>
					<button type="submit" class="btn" name="update">Update</button>
					<?php endif;?>
					
				</form>
				</div>
				<div>
				
				<h3 >Trainee Details</h3><br>
					
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
							<th>Trainee_Name</th>
							<th>Trainer_Name</th>
							<th>DOB</th>
							<th>Gender</th>
							<th>Package</th>
							<th>Package Status</th>
							<th>Assign Trainer</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$s="select * from `trainee`";
							$res=$db->query($s);
							if($res->num_rows>0 )
							{
								while($r=$res->fetch_assoc())
								{
									$sql="select First_name from `user` where User_ID={$r["Trainee_ID"]}";								
									$res1=$db->query($sql);
									if($res1->num_rows>0)
									{
										while($row=$res1->fetch_assoc())
										{
											echo "<tr>
												<td>{$row["First_name"]}</td>";
											$sql1="select Trainer_name from `trainer` where Trainer_ID={$r["Trainer_ID"]}";
											$res2=$db->query($sql1);
											if($res2->num_rows>0)
											{
												while($row1=$res2->fetch_assoc())
												{
														echo "<td>{$row1["Trainer_name"]}</td>";
												}
											}
											
										}
									}
									echo "
											    
											<td>{$r["DOB"]}</td>
											<td>{$r["Gender"]}</td>
											<td>{$r["Package"]}</td>
											<td>{$r["Package_status"]}</td>
											<td><a href='view_trainees.php?id={$r["Trainee_ID"]}'  class='btnr'>Assign</a></td>
											                           
										</tr>
										";
									
								}
								
							}
						?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	
				<?php include"footer.php";?>
	</body>
</html>