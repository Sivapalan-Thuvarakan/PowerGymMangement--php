<?php
	include"database.php";
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>power Gym</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/dropdown.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body class="back">
	
		<?php include"navbar.php";?>
		
		<!--<img src="gym_image/gym_img2.jpg" width="800">-->
		
		<div class="login">
			<h1 class="heading">Sign_up</h1>
			<div class="log">
				<?php
					if(isset($_POST["signup"]))
					{
						$sql="insert into user(User_name,First_name,Last_name,role,Tel_no,password,Email) values('{$_POST["uname"]}','{$_POST["fname"]}','{$_POST["lname"]}',
						'{$_POST["urole"]}','{$_POST["utel"]}','{$_POST["upass"]}','{$_POST["uemail"]}')";
						if($db->query($sql))
						{	
							$s = $db->insert_id;
							echo "<div class='success'>Account Created successfully.....</div>";
							if($_POST["urole"]=='trainee')
							{
							
								$sql="INSERT INTO trainee (Trainee_ID,Trainer_ID,Gender,Package_status,Package) VALUES($s,2,'not selected','none','no package')";
								
								$db->query($sql);
							}
							if($_POST["urole"]=='customer')
							{
								
								$sql="INSERT INTO `customer`(`Customer_ID`) 
								VALUES($s)";
								$db->query($sql);
							}
						}
						else
						{
							echo "<div class='error'>Signup failed..</div>";
						}
						
					}
				?>
			
				<form autocomplete="off" method="post" name="signup" id="signup" action="<?php echo $_SERVER["PHP_SELF"];?>">
					<label>User Name</label><br>
					<input type="text" name="uname" id="uname" required class="input"><br>
					<span id="useravailablity"></span><br>
					<label>First Name</label><br>
					<input type="text" name="fname" required class="input"><br>
					<label>Last Name</label><br>
					<input type="text" name="lname" required class="input"><br>
					<label>Email</label><br>
					<input type="email" name="uemail" id="uemail" required class="input"><br>
					<span id="emailavailablity"></span><br>
                    <label>Telno</label><br>
					<input type="tel" name="utel" id="utel" class="input" maxlength="10"  required ><br>
					<span id="tel_check"></span><br>
					<label>Role</label>
						<select style="margin:10px 0 0 80px" name="urole" id="role">
							<option value="trainee">Trainee</option>
							<option value="customer">Customer</option>
						</select><br>
					<label>Password </label><br>
					<input type="password" name="upass" id="upass" required class="input"><br>
					<span id="pass_strength"></span><br>
					<label>Confirm Password </label><br>
					<input type="password" name="cpass" id="cpass" required class="input"><br>
					<span id="pass_check"></span><br>
					<button type="submit" class="btn" name="signup"  >Sign up</button>
				</form>
			</div>
		</div>
		

		
		<div class="footer">
			<footer><p>Copyright &copy; Thuvarakan </p></footer>
		</div>
		
			<script src="js/jquery.js"></script>
		         <script>
		        $(document).ready(function(){
		        	$(".error").fadeTo(1000, 100).slideUp(1000, function(){
		        			$(".error").slideUp(1000);
		        	});
		        	
		        	$(".success").fadeTo(1000, 100).slideUp(1000, function(){
		        			$(".success").slideUp(1000);
		        	});
		        });
			</script>
				<!--check availablity of username using jquery-->
			<script>
					$(document).ready(function(){
						$("#uname").keyup(function(){
							$.post("check.php",{name:signup.uname.value},function(data)
							{
									$("#useravailablity").html(data);
							});
						});
					});
			</script>
			
			<!--check availablity of email using jquery-->
			<script>
					$(document).ready(function(){
						$("#uemail").keyup(function(){
							$.post("check.php",{email:signup.uemail.value},function(data)
							{
									$("#emailavailablity").html(data);
							});
						});
					});
			</script>

			<!--check valid Telphone number-->
			<script>
			

			 $(document).ready(function(){
					var nondigit = new RegExp('[^0-9]');
					$("#utel").keyup(function(){
					var tel=$(this).val();				
						if(tel.match(nondigit))
						{
							$("#tel_check").html('<p class="err">Plese enter valid Telephone number</p>');
						}
						else
						{
							$("#tel_check").html('<p></p>');
						}
									
						});
					});			
			</script>

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
							$.post("check.php",{cpass:signup.cpass.value,upass:signup.upass.value},function(data)
							{
									$("#pass_check").html(data);
							});
						});
					});
			</script>
		
	</body>
</html>