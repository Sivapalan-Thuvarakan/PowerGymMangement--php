<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('admin_login.php?mes=Access Denied...','_self');</script>";
		
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
			
			<!--<img src="img/1.jpg" style="margin-left:90px;" class="sha">-->
			
				<div id="section">
				
					<?php include"sidebar.php";?><br><br><br>
					
					<h3 class="text">Welcome <?php echo $_SESSION["ANAME"]; ?></h3><br><hr><br>
					
				<div class="content1">
					
						<h3 > Change Password</h3><br>
						<?php
							if(isset($_POST["submit"]))
							{
								$sql="select * from admin where password='{$_POST["opass"]}' and Admin_ID='{$_SESSION["AID"]}'";
								$result=$db->query($sql);
								if($result->num_rows>0)
								{
									if($_POST["upass"]==$_POST["cpass"])
									{
										$s="update admin SET password='{$_POST["upass"]}' where Admin_ID='{$_SESSION["AID"]}'";
										$db->query($s);
										echo "<div class='success'>Password Changed</div>";
									}
									else
									{
										echo "<div class='error'>Password Mismatch</div>";
									}
								}
								else
								{
									echo "<div class='error'>Invalid Password</div>";
								}
							}
						
						
						?>
						
							
					
					<form method="post"  name="setting" action="<?php echo $_SERVER["PHP_SELF"];?>">
						<label>Old Password</label><br>
						<input type="password" class="input3" name="opass"><br><br>
						<label>New Password</label><br>
						<input type="password" class="input3" name="upass" id="upass"><br><br>
						<span id="pass_strength"></span><br>
						<label>Confirm Password</label><br>
						<input type="password" class="input3" name="cpass" id="cpass"><br><br>
						<span id="pass_check"></span><br>
						<button type="submit" class="btn" style="float:left" name="submit"> Change Password</button>
				
					</form>
			
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
									$.post("check.php",{cpass:setting.cpass.value,upass:setting.upass.value},function(data)
									{
											$("#pass_check").html(data);
									});
								});
							});
					</script>

			</div>
	
			</div>
			<?php include"footer.php";?>
		
	</body>
</html>