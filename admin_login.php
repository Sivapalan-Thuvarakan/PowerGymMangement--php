<?php
	include "database.php";
	session_start();
	$_SESSION["start"]=true;
	unset ($_SESSION["TRID"]);
	unset ($_SESSION["UID"]);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Power Gym</title>
        <?php include "navbar.php"; ?>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body class="back">
		
		<img src="images/poster/admin.jpg" width="100%" height="300px">
		<?php $_SESSION['admin']= true ?>
		<div class="login">
			<h1 class="heading">Admin Login</h1>
			<div class="log">
			<?php
				if(isset($_POST["login"]))
				{
					$sql="select * from admin where Admin_user_name='{$_POST["aname"]}' and password='{$_POST["apass"]}'";
					$res=$db->query($sql);
					if($res->num_rows>0)
					{
						$ro=$res->fetch_assoc();
						$_SESSION["AID"]=$ro["Admin_ID"];
						$_SESSION["ANAME"]=$ro["Admin_user_name"];
						unset($_SESSION["start"]);
						echo "<script>window.open('admin_home.php','_self');</script>";
					}
					else
					{
						echo "<div class='error'>Invalid Username or Password</div>";
					}
					
				}
				if(isset($_GET["mes"]))
				{
					echo "<div class='error'>{$_GET["mes"]}</div>";
				}
				
			?>
		
				<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
					<label>User Name</label><br>
					<input type="text" name="aname" required class="input"><br><br>
					<label>Password </label><br>
					<input type="password" name="apass" required class="input"><br>
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