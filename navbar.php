<div class="navbarown">
			<ul class="list">
				<img style="width:60px;float:left;" src="images/logo/mylogo.png">
				<b style="color:white;float:left;line-height:50px;margin-left:5px;font-family:Cooper Black;">
				PowerGym</b>
			<?php
				if(isset($_SESSION["AID"]))
				{
					echo'
				
						<li><a href="admin_home.php">Admin Home</a></li>
						<li><a href="admin_change_pass.php">Settings</a></li>
						<li><a href="logout.php">Logout</a></li>
					';
				}
				elseif(isset($_SESSION["UID"]))
				{
					if($_SESSION["UROLE"]==="trainee"){
					echo'
				
						<li><a href="user_home.php">Trainee Home</a></li>
						<li><a href="Registerpackage.php">Register Package</a></li>
						<li><a href="index.php">Shoping</a></li>
						<li><a href="user_change_pass.php">Settings</a></li>
						<li><a href="logout.php">Logout</a></li>
					';
					}
					else{
						echo'
				
						<li><a href="user_home.php">customer Home</a></li>
						<li><a href="index.php">Shoping</a></li>
						<li><a href="user_change_pass.php">Settings</a></li>
						<li><a href="logout.php">Logout</a></li>
					';
					}

				}
				elseif(isset($_SESSION["TRID"]))
				{
					echo'
				
						<li><a href="trainer_home.php">Trainer Home</a></li>
						<li><a href="trainer_change_pass.php">Settings</a></li>
						<li><a href="logout.php">Logout</a></li>
					';
				}
			else{
						if(isset($_SESSION["start"]))
						{
							echo'
								';
						}
						else
						{
							echo'
							<li><a href="index.php">Shoping</a></li>
							<li><a href="Registerpackage.php">Register Package</a></li>
							<div class="dropdown">
								<button class="dropbtn">Login
								<i class="fa fa-caret-down"></i></button>
								<div class="dropdown-content">
									<a href="user_login.php">User</a>
									<a href="trainer_login.php">Trainer</a>
								</div>
							</div>
							<li><a href="contactus.php">Contact Us</a></li>
							<li><a href="signup.php">Signup</a></li>';
						}
			

				}?>

			</ul>
		</div>
		