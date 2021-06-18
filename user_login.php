<?php
	include"database.php";
	session_start();
	unset($_SESSION["start"]);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>powerGym</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/dropdown.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	</head>
	<body class="back">
	
		<?php include"navbar.php";?>
		
		<img src="images/poster/userlogin.jpg" width="800"height="300">
		
		<div class="login">
			<h1 class="heading">User's Login</h1>
			<div class="log">
				<?php
					if(isset($_POST["login"]))
					{
						$sql="select * from user where User_name='{$_POST["uname"]}'AND role='{$_POST["urole"]}' and password='{$_POST["upass"]}'";	
						$res=$db->query($sql);
						if($res->num_rows>0)
						{
							$ro=$res->fetch_assoc();
							$_SESSION["UID"]=$ro["User_ID"];
							$_SESSION["UNAME"]=$ro["User_name"];
							$_SESSION["FirstNAME"]=$ro["First_name"];
							$_SESSION["LastNAME"]=$ro["Last_name"];
							$_SESSION["Email"]=$ro["Email"];
							$_SESSION["UROLE"]=$ro["role"];
							$sql1="select Address from customer  where Customer_ID='{$_SESSION["UID"]}'";
							$res1=$db->query($sql1);//get address from customer table
							$ro1=$res1->fetch_assoc();
							$_SESSION["Address"]=$ro1["Address"];
							echo "<script>window.open('user_home.php','_self');</script>";

						}
						else
						{
							echo "<div class='error'>Invalid Username Or Password</div>";
						}
					}
				
				
				
				?>
			
				<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
					<label>User Name</label><br>
					<input type="text" name="uname" required class="input"><br><br>
					<label>Role</label>
						<select name="urole" id="role">
							<option value="trainee">Trainee</option>
							<option value="customer">Customer</option>
						</select><br><br>
					<label>Password </label><br>
					<input type="password" name="upass" required class="input"><br>
					<button type="submit" class="btn" name="login">Login Here</button>
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
		
	</body>
</html>