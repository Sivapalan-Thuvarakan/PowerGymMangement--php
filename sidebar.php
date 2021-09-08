<div class="sidebar"><br>
<h3 class="text">Dashboard</h3>
<ul class="s">
<?php
	if(isset($_SESSION["AID"]))
	{
		echo'
			<li class="li"><a href="admin_home.php">Power GYM Information</a></li>
			<li class="li"><a href="generate_report.php">Generate Report</a></li>
		
			<li class="li"><a href="#">Trainer</a>
				<ul>
					<li class="li"><a href="add_trainer.php">Add Trainer</a></li>
					<li class="li"><a href="view_trainer.php">View Trainer</a></li>
				</ul>
			</li>
			<li class="li"><a href="view_trainees.php">Trainee</a></li>
			<li class="li"><a href="view_customer.php">Customer</a></li>
			<li class="li"><a href="#">Product</a>
				<ul>
					<li class="li"><a href="add_product.php">Add Product</a></li>
					<li class="li"><a href="view_product.php">View Product</a></li>
				</ul>
			</li>
			<li class="li"><a href="#">Package</a>
				<ul>
					<li class="li"><a href="add_package.php">Add Package</a></li>
					<li class="li"><a href="view_package.php">View Package</a></li>
				</ul>
			</li>
			<li class="li"><a href="Soldpackages.php">Sold Packages</a></li>
			<li class="li"><a href="add_advertisement.php">Advertisement</a></li>
			<li class="li"><a href="verifypackage.php> Verify package</a></li>
			<li class="li"><a href="delivery.php" > Delivery</a></li>
			<li class="li"><a href="" > Orders</a>
				<ul>
					<li class="li"><a href="order_status.php">Order Status</a></li>
					<li class="li"><a href="order.php">View Order</a></li>
				</ul>
			</li>
			<li class="li"><a href="logout.php">Logout</a></li>
		
		';
	}
	elseif(isset($_SESSION["UID"])){
		if($_SESSION["UROLE"]==="trainee"){
		echo'
			<li class="li"><a href="user_home.php">Profile</a></li>
			<li class="li"><a href="trainer_details.php">Trainer Details</a></li>
			<li class="li"><a href="orderdetails.php">order Details</a></li>
			<li class="li"><a href="chat.php"> Chat</a></li>
			<li class="li"><a href="logout.php">Logout</a></li>
		';
		}
		else{
		echo'
			<li class="li"><a href="user_home.php">Profile</a></li>
			<li class="li"><a href="orderdetails.php">order Details</a></li>
			<li class="li"><a href="">offers</a></li>
			<li class="li"><a href="">package register</a></li>
			<li class="li"><a href="logout.php">Logout</a></li>
		';
		}
	}
	else{
		echo'
			<li class="li"><a href="trainer_home.php">Profile</a></li>
			<li class="li"><a href="trainer_view_trainee.php">Trainee Details</a></li>
			<li class="li"><a href="assign_exercise_diet.php">Assign Exercise & Diet plan</a></li>
			<li class="li"><a href="chat.php">Chat</a></li>
			<li class="li"><a href="logout.php">Logout</a></li>
		';
	}


?>
</ul>

</div>
