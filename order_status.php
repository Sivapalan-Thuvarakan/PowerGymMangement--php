<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('admin_login.php?mes=Access Denied...','_self');</script>";
    
	}	
    $username='';$update=false;$id='';$order_id='';
    
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
					
						<h3 > Add Product</h3><br>
					<?php
                        if(isset($_GET["id"]))
						{
                             $update=true;
                             $id=$_GET['id'];
							 $sq="SELECT o.Order_ID, o.Date,o.Phone_no, o.District,u.User_name FROM `order` o INNER JOIN `user` u ON u.User_ID=o.Customer_ID WHERE
                             o.Order_ID=$id";
                             $res=$db->query($sq);
							if($res->num_rows>0)
							{   
                                $re=$res->fetch_assoc();
                                $order_id=$re["Order_ID"];
                                $username= $re["User_name"];
							}
						}
						if(isset($_POST["update"]))
						{
							
									$id=$_POST["id"];
									$sq="update `order` set Status='Delivered'
									where Order_ID=$id";
                                    $db->query($sq);
                                    $sq2="INSERT INTO `delivery`(`Order_Id`, `date`, `Delivery_Com`, `Remarks`) VALUES($id,'{$_POST['deliver_date']}',
                                    '{$_POST['Delivery_com']}','{$_POST['Remark']}')";
                                    $db->query($sq2);

						}

					
					?>
				<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                    <label>Order_ID</label><br><br>
				    <input type="text" name="id" value='<?php echo $order_id; ?>'/><br><br>
					<label>Customer Name</label><br><br>
					<input type="text" name="customer_name" value="<?php echo $username ?>" required class="input"><br><br>
                    <label>Select Delivery Company</label>&#160;&#160;
                    <select name="Delivery_com"  id="Delivery_com">
                                        <option value='Delivary Mali'>Delivery Mali</option>
                                        <option value='Certis Lanka'>Certis Lanka</option>
					</select><br><br>
                    <label>Date Of Delivery</label>
					<input type="date" id="deliver_date" name="deliver_date" rquired><br><br>
                    <label>Remarks</label><br>
					<input type="text" name="Remark"  required class="input"><br><br>
					<?php if($update):?>
					<button type="submit" class="btn" name="update">Deliver</button>
					<?php endif;?>
					
				</form>
				</div>
				<div>
				
				<h3 >Order Details To be Delivered</h3><br>
					
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
                            <th>Order_ID</th>
                            <th>Customer_Name</th>
							<th>District</th>
							<th>Tel_no</th>
                            <th>Date</th>
                            <th>Status Update</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$s="SELECT o.Order_ID, o.Date,o.Phone_no, o.District,u.User_name FROM `order` o INNER JOIN `user` u ON u.User_ID=o.Customer_ID WHERE
                        o.Status='order ready'";
                        $res=$db->query($s);
                        if($res->num_rows>0 )
                        {
                            while($r=$res->fetch_assoc())
                            {
                                echo "
                                    <tr>
                                        <td>{$r["Order_ID"]}</td>                            
                                        <td>{$r["User_name"]}</td>
                                        <td>{$r["District"]}</td>
                                        <td>{$r["Phone_no"]}</td>
                                        <td>{$r["Date"]}</td>
                                        <td><a href='order_status.php?id={$r["Order_ID"]}'  class='btnr'>Deliver</a></td>
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