<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('index.php?mes=Access Denied...','_self');</script>";
		
	}	
	$update=false;
	$trainername='';$dob='';$gender='';$address='';$cv='';$username='';$password='';$image='';$id='';
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
				<div class="content1">
					
					<h3 > Add Trainer</h3><br>
					<?php
						if(isset($_POST["submit"]))
						{
                            $target_cv="documents/cv/";
							$target_file_cv=$target_cv.basename($_FILES["document"]["name"]);  
                            $target="images/trainer/";
							$target_file=$target.basename($_FILES["img"]["name"]);
							 if(move_uploaded_file($_FILES['document']['tmp_name'],$target_file_cv) && move_uploaded_file($_FILES['img']['tmp_name'],$target_file))
							{
								$sq="insert into trainer (Trainer_name,user_name,password,CV,Image,Gender,DOB,Address) 
								values('{$_POST["trainer_name"]}','{$_POST["user_name"]}','{$_POST["password"]}','{$target_file_cv}','{$target_file}','{$_POST["gender"]}','{$_POST["dob"]}','{$_POST["address"]}')";
								$db->query($sq);
								
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
							 $sq="select * from trainer Where Trainer_ID=$id";
                             $res=$db->query($sq);
							if($res->num_rows>0)
							{   
                                $re=$res->fetch_assoc();
                                $trainername= $re["Trainer_name"];
                                $username= $re["user_name"];
                                $password= $re["password"];
                                $address= $re["Address"];
								$gender= $re["Gender"];
                                $dob= $re["DOB"];
                                $image= $re["Image"];
								$cv= $re["CV"];
							}
						}
						if(isset($_POST["update"]))
						{
							$target_cv="documents/cv/";
							$target_file_cv=$target_cv.basename($_FILES["document"]["name"]);  
                            $target="images/trainer/";
							$target_file=$target.basename($_FILES["img"]["name"]);
							if(move_uploaded_file($_FILES['document']['tmp_name'],$target_file_cv) && move_uploaded_file($_FILES['img']['tmp_name'],$target_file))
							{
								$id=$_POST["id"];
                                $sq="update trainer set Address='{$_POST["address"]}',Gender='{$_POST["gender"]}',DOB={$_POST["dob"]},Image='{$target_file}',CV='{$target_file_cv}',Trainer_name='{$_POST["trainer_name"]}',user_name='{$_POST["user_name"]}',password='{$_POST["password"]}'
                                where Trainer_ID=$id";
								
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
                    <label >Upload CV:</label>
                    <input type="file" class="input3" name="document"  value="<?php echo $cv?>"><br>
					<label>User Name</label><br>
					<input type="text" name="user_name" value="<?php echo $username?>" required class="input"><br><br>
					<label>Set Password </label><br>
					<input type="password" name="password" id="upass"  value="<?php echo $password?>"required class="input"><br>
					<span id="pass_strength"></span><br>
					<label>Confirm Password </label><br>
					<input type="password" name="cpass" id="cpass" required class="input"><br>
					<span id="pass_check"></span><br>
                    <label>Image</label><br>
					<input type="file"  class="input3" required name="img" value="<?php echo $image?>"><br><br>
					<?php if($update):?>
					<button type="submit" class="btn" name="update">Update</button>
					<?php else:?>
					<button type="submit" class="btn" name="submit">Add Trainer</button>
					<?php endif;?>
				</form>
				</div>
					<h3 style="margin-top:30px;"> Trainer Details</h3><br>
					<?php
						if(isset($_GET["mes"]))
						{
							echo"<div class='error'>{$_GET["mes"]}</div>";	
						}
					
					?>
					 <div  style="margin-right: 10px;margin-bottom: 70px;height: 600px; overflow: hidden;">
                 	 <table class="styled-table">
						<thead>
							<tr>
								<th>Trainer_ID</th>
								<th>Trainer Name</th>
								<th>Gender</th>
								<th>Address</th>
								<th>DOB</th>
								<th>CV</th>
								<th>User Name</th>
								<th>Password</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$s="select * from trainer";
							$res=$db->query($s);
							if($res->num_rows>0)
							{
								while($r=$res->fetch_assoc())
								{
									echo "
										<tr>
											<td>{$r["Trainer_ID"]}</td>                            
											<td>{$r["Trainer_name"]}</td>
											<td>{$r["Gender"]}</td>
											<td>{$r["Address"]}</td>
											<td>{$r["DOB"]}</td>
											<td ><a href='{$r["CV"]}'>cv document</a></td>
                                            <td>{$r["user_name"]}</td>
                                            <td>{$r["password"]}</td>
                                            <td><a href='add_trainer.php?id={$r["Trainer_ID"]}'  class='btnr'>Edit</a></td>
											<td><a href='delete_trainer.php?id={$r["Trainer_ID"]}' class='btnr'>Delete</a></td>
										</tr>
										";
									
								}
								
							}
						?>
					</tbody>
					</table>
				</div>


				<script src="js/jquery.js"></script>
				<!--check password strength-->
				<script>
							$(document).ready(function(){
								var upperCase = new RegExp('[A-Z]');
								var numbers = new RegExp('[0-9]');
								$("#upass").keyup(function(){
									var pass=$(this).val();
								
									if(pass.length<8)
									{
										$("#pass_strength").html('<p class="err">Weak Password,password must include 8 charcters, one uppercase and numeric value</p>');	
									}
									if (pass.length>=8)
									{
										if(pass.match(upperCase) && pass.match(numbers))
										{
											$("#pass_strength").html('<p class="crt">Strong Password</p>');
										}
										else
										{
											$("#pass_strength").html('<p class="err">Weak Password,password must include one uppercase and numeric value</p>');
										}
									}
									if (pass.length==0)
									{
										$("#pass_strength").html('<p class="err">Please Enter Password,password must include one uppercase and numeric value</p>');
									}
								});
							});

						
					</script>

					<!--check password and confirm password-->
					<script>
							$(document).ready(function(){
								$("#cpass").keyup(function(){
									$.post("check.php",{cpass:addtrainer.cpass.value,upass:addtrainer.upass.value},function(data)
									{
											$("#pass_check").html(data);
									});
								});
							});
					</script>
			</div>
	
				<?php include"footer.php";?>
	</body>
</html>