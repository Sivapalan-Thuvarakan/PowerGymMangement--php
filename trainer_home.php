<?php
	include"database.php";
	session_start();
	
	if(!isset($_SESSION["TRID"]))
	{
		echo"<script>window.open('index.php?mes=Access Denied...','_self');</script>";
		
	}
	$update=false;
	$trainername='';$dob='';$gender='';$address='';$image='';$id='';	
	$sqluser="SELECT * FROM trainer WHERE 	Trainer_ID={$_SESSION["TRID"]}";
	$resuser=$db->query($sqluser);
	if($resuser->num_rows>0)
	{
			$rowtrainer=$resuser->fetch_assoc();
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
				<h3 class="text">Welcome <?php echo $_SESSION["TR_U_NAME"]; ?></h3><br><hr><br>
				<div class="content1">
					
					<h3 >Trainer</h3><br>
					<?php
						if(isset($_GET["id"]))
						{
                             $update=true;
							 $sq="select * from trainer Where Trainer_ID={$_SESSION["TRID"]}";
                             $res=$db->query($sq);
							if($res->num_rows>0)
							{   
                                $re=$res->fetch_assoc();
                                $trainername= $re["Trainer_name"];
                                $address= $re["Address"];
								$gender= $re["Gender"];
                                $dob= $re["DOB"];
                                $image= $re["Image"];
							}
						}
						if(isset($_POST["update"]))
						{
                            $target="images/trainer/";
							$target_file=$target.basename($_FILES["img"]["name"]);
							if(move_uploaded_file($_FILES['img']['tmp_name'],$target_file))
							{
								$id=$_POST["id"];
                                $sq="update trainer set Address='{$_POST["address"]}',Gender='{$_POST["gender"]}',DOB={$_POST["dob"]},Image='{$target_file}',Trainer_name='{$_POST["trainer_name"]}'
                                where Trainer_ID={$_SESSION["TRID"]}";
								
                                $db->query($sq);
								echo "<div class='success'>Update Success..</div>";
								
							}
						}

					
					?>
				<form method="post" enctype="multipart/form-data" name="addtrainer" style="margin-bottom: 70px;" action="<?php echo $_SERVER["PHP_SELF"];?>">
				    <input type="hidden" name="id" value=<?php echo $id; ?>>
					<label>Trainer Name</label><br>
					<input type="text" name="trainer_name" required class="input" value="<?php echo $trainername?>"><br><br>
                    <label>Date Of Birth</label>
					<input type="date" id="birthday" name="dob" value="<?php echo $dob?>" rquired><br><br>
                    <label>Gender</label>&#160;&#160;
                    <input type="radio" id="male" name="gender"  required  value="male">
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender"   required value="female">
                    <label for="female">Female</label>
                    <input type="radio" id="other" name="gender"  required value="other">
                    <label for="other">Other</label><br><br>
                    <label>Address</label><br>
					<textarea rows="5" name="address"  value="<?php echo $address?>"></textarea><br><br> 
                    <label>Image</label><br>
					<input type="file"  class="input3" required name="img" value="<?php echo $image?>"><br><br>
					<button type="submit" class="btn" name="update">Update</button>
				
				</form>
				</div>
					<h3 style="margin-top:30px;"> Trainer Details</h3><br>
					<?php
						if(isset($_GET["mes"]))
						{
							echo"<div class='error'>{$_GET["mes"]}</div>";	
						}
					
					?>
					 <div  style="margin-right: 20px;margin-bottom: 70px;height: 600px; overflow: hidden;">
                 	

						<table border="1px">
													<tr><td colspan="2"><img src="<?php echo $rowtrainer["Image"] ?>" height="100" width="100" alt="upload Pending"></td></tr>
													<tr><th>User Name </th> <td><?php echo $rowtrainer["user_name"] ?> </td></tr>
													<tr><th> Name </th> <td><?php echo $rowtrainer["Trainer_name"] ?>  </td></tr>
													<tr><th>Email </th> <td> <?php echo $rowtrainer["Trainer_name"] ?>  </td></tr>
													<tr><th>Phone No </th> <td> <?php $rowtrainer["Trainer_name"] ?> </td></tr>
													<tr><th>Gender</th> <td> <?php echo $rowtrainer["Gender"] ?> </td></tr>
													<tr><th>DOB</th> <td> <?php echo $rowtrainer["DOB"] ?>  </td></tr>
													<tr><th>Address</th> <td> <?php echo $rowtrainer["Address"] ?>  </td></tr>
						</table>
				</div>

			</div>
	
				<?php include"footer.php";?>
	</body>
</html>