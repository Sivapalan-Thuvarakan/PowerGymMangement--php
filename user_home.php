<?php

	include"database.php";
	session_start();
	unset ($_SESSION["AID"]);
	unset ($_SESSION["TRID"]);
	if(!isset($_SESSION["UID"]))
	{
		echo"<script>window.open('user_login.php?mes=Access Denied...','_self');</script>";
		
	}
	$sqluser="SELECT * FROM user WHERE 	User_ID={$_SESSION["UID"]}";
	$resuser=$db->query($sqluser);
	if($resuser->num_rows>0)
	{
			$rowuser=$resuser->fetch_assoc();
	}
	if($_SESSION["UROLE"]=='trainee')
	{
		$sqltrainee="SELECT * FROM trainee WHERE Trainee_ID={$_SESSION["UID"]}";
		$sqlmedical="SELECT Medical_Report FROM medical_reports WHERE Trainee_ID={$_SESSION["UID"]}";
		$sqlexercise="SELECT Exercise_file  FROM exercise_and_diet_plan WHERE Trainee_ID={$_SESSION["UID"]}";	
		$restrainee=$db->query($sqltrainee);
		$resmedical=$db->query($sqlmedical);
		$resexercise=$db->query($sqlexercise);
		if($restrainee->num_rows>0)
		{
			$rowtrainee=$restrainee->fetch_assoc();
		}
		if($resmedical->num_rows>0)
		{
			$rowmedical=$resmedical->fetch_assoc();
		}
		if($resexercise->num_rows>0)
		{
			$rowexercise=$resexercise->fetch_assoc();
		}
    }
	else
	{
		$sqlcustomer="SELECT * FROM customer WHERE Customer_ID={$_SESSION["UID"]}";
		$rescustomer=$db->query($sqlcustomer);
		if($rescustomer->num_rows>0)
		{
			$rowcustomer=$rescustomer->fetch_assoc();
		}
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
				  <h3 class="text">Welcome <?php echo $_SESSION["UNAME"],'  ',$_SESSION["UROLE"] ; ?></h3><br><hr><br>
				<div class="content">
				
					<h3>Add Profile</h3><br>
					<div class="lbox1">
					<?php
						if(isset($_POST["submit"]))
						{
							if($_SESSION["UROLE"]=='trainee')
							{
								
							$target_medical="documents/medicalreports/";
							$target_file_medical=$target_medical.basename($_FILES["document"]["name"]);  
                            $target="images/trainee/";
							$target_file=$target.basename($_FILES["img"]["name"]);
							if(move_uploaded_file($_FILES['document']['tmp_name'],$target_file_medical) && move_uploaded_file($_FILES['img']['tmp_name'],$target_file))
							{
								
								$date=date("Y/m/d");
								$sql="update trainee set DOB='{$_POST["dob"]}',Gender='{$_POST["gender"]}',Image='{$target_file}'where Trainee_ID='{$_SESSION["UID"]}'";
                                $sq="INSERT INTO `medical_reports`(`Trainer_ID`, `Trainee_ID`, `Medical_Report`, `Date`) VALUES ({$rowtrainee["Trainer_ID"]},{$rowtrainee["Trainee_ID"]},'{$target_file_medical}',{$date}) ";
								$db->query($sq);
								$db->query($sql);
								echo "<div class='success'>Update Success..</div>";
								
							}		



							}
							else
							{
								$target="images/customer/";
								$target_file=$target.basename($_FILES["img"]["name"]);
								
								if(move_uploaded_file($_FILES['img']['tmp_name'],$target_file))
								{	
									$sql="update customer set DOB='{$_POST["dob"]}',Gender='{$_POST["gender"]}',Image='{$target_file}',Address='{$_POST["address"]}'where Customer_ID='{$_SESSION["UID"]}'";
									$db->query($sql);
									echo "<div class='success'>Insert Success</div>";
								}
							}
						 header("Refresh:0");
							
						}
					
					
					?>
					
					
					
					
						
					<form  enctype="multipart/form-data" role="form"  method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                         
                            <label>Date Of Birth</label>
							<input type="date" id="birthday" name="dob" rquired><br><br>
                            <label>Gender</label>&#160;&#160;
                            <input type="radio" id="male" name="gender" required  value="male">
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="gender" required value="female">
                            <label for="female">Female</label>
                            <input type="radio" id="other" name="gender" required value="other">
                            <label for="other">Other</label><br><br>
							<label>Address</label><br>
							<textarea rows="5" name="address"></textarea><br><br>
							<label>Image</label><br>
							<input type="file"  class="input3" required name="img"><br><br>
							<label >Medical Report:</label>
                    		<input type="file" class="input3" name="document"  value="<?php echo $medicalreport?>"><br>
							<button type="submit" class="btn" name="submit">Update Profile Details</button>
						</form>
					</div>
					
					
					
					
					<div class="rbox1">
					<h3> Profile</h3><br>
					<?php 
					if($_SESSION["UROLE"]=='trainee')
					{
						include "trainee_details_table.php";
					}
					else
					{
						include "customer_details_table.php";
					}
					?>
						
					</div>
				</div>
			</div>
			<!-- <img src="images/poster/bottom.jpg" width="800"height="280" style="margin:70px 500px;" > -->
			<?php include"footer.php";?>
	</body>
</html>