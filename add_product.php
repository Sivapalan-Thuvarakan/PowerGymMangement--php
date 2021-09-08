<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('admin_login.php?mes=Access Denied...','_self');</script>";
    
	}	
    $productname='';$price='';$description='';$quantity='';$button='Addproduct';$update=false;$id=0;
    
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
						if(isset($_POST["addproduct"]))
						{ 
								$sq="insert into product (Brand_ID,Category_ID,Colour_ID,Size_ID,Product_Name,Price,Image,Product_Description,Quantity)
                                values({$_POST["product_brand"]},{$_POST["product_category"]},{$_POST["product_colour"]},{$_POST["product_size"]},'{$_POST["product_name"]}',{$_POST["product_price"]},'{$_POST["img"]}','{$_POST["product_description"]}','{$_POST["product_quantity"]}')";
                                if($db->query($sq))
                                {
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
							 $sq="select * from product Where Product_ID=$id";
                             $res=$db->query($sq);
							if($res->num_rows>0)
							{   
                                $re=$res->fetch_assoc();
                                $productname= $re["Product_Name"];
                                $price= $re["Price"];
                                $description= $re["Product_Description"];
                                $quantity= $re["Quantity"];
							}
						}
						if(isset($_POST["update"]))
						{
							
									$id=$_POST["id"];
									$sq="update product set Brand_ID={$_POST["product_brand"]},Category_ID={$_POST["product_category"]},Colour_ID={$_POST["product_colour"]},Size_ID={$_POST["product_size"]},Product_Name='{$_POST["product_name"]}',Price={$_POST["product_price"]},Image='{$_POST["img"]}',Product_Description='{$_POST["product_description"]}',Quantity='{$_POST["product_quantity"]}'
									where Product_ID=$id";
									$db->query($sq);
						}

					
					?>
				<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
				    <input type="hidden" name="id" value=<?php echo $id; ?>>
					<label>product Name</label><br>
					<input type="text" name="product_name" value="<?php echo $productname ?>" required class="input"><br><br>
                    <label>Category</label>&#160;&#160;
                    <select name="product_catgory"  id="category">
                    <?php
                        $s="select * from category";//to get category from category table
                        $res=$db->query($s);
                        if($res->num_rows>0)
							{
								$i=0;
								while($r=$res->fetch_assoc())
								{
									$i++;
									echo "
                                        <option value='{$r["Category_ID"]}'>{$r["Category"]}</option>
										";
									
								}
								
							}
                    ?>
                    </select>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                    <label>Brand</label>&#160;&#160;
                    <select name="product_brand" id="brand">
                    <?php
                        $s="select * from brand";//to get brand from brand table
                        $res=$db->query($s);
                        if($res->num_rows>0)
							{
								$i=0;
								while($r=$res->fetch_assoc())
								{
									$i++;
									echo "
                                        <option value='{$r["Brand_ID"]}'>{$r["Brand"]}</option>
										";
									
								}
								
							}
                    ?>
                    </select><br><br>
                    <label>Colour</label>&#160;&#160;&#160;&#160;&#160;&#160;
                    <select name="product_colour" id="colour">
                    <?php
                        $s="select * from colour";//to get colour from colour table
                        $res=$db->query($s);
                        if($res->num_rows>0)
							{
								$i=0;
								while($r=$res->fetch_assoc())
								{
									$i++;
									echo "
                                        <option value='{$r["Colour_ID"]}'>{$r["Colour"]}</option>
										";
									
								}
								
							}
                    ?>
                    </select>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                    <label>Size</label>&#160;&#160;&#160;&#160;&#160;&#160;
                    <select name="product_size" id="size">
                    <?php
                        $s="select * from size";//to get Size from Size table
                        $res=$db->query($s);
                        if($res->num_rows>0)
							{
								$i=0;
								while($r=$res->fetch_assoc())
								{
									$i++;
									echo "
                                        <option value='{$r["Size_ID"]}'>{$r["Size"]}</option>
										";
									
								}
								
							}
                    ?>
                    </select><br><br>
                  
					<label>Price</label><br>
					<input type="text" name="product_price" value="<?php echo $price ?>" required class="input"><br><br>
					<label>Description</label><br>
					<input type="text" name="product_description" value="<?php echo $description ?>" required class="input"><br><br>
                    <label>Quantity</label><br>
					<input type="text" name="product_quantity" value="<?php echo $quantity ?>" required class="input" style="width:20px"><br><br>
                    <label>Select image:</label>
                    <input type="file" id="img" name="img"  ><br>
					<?php if($update):?>
					<button type="submit" class="btn" name="update">Update</button>
					<?php else:?>
					<button type="submit" class="btn" name="addproduct">Add product</button>
					<?php endif;?>
					
				</form>
				</div>
				
				
					<h3 style="margin-top:30px;"> Product Details</h3><br>
					<?php
						if(isset($_GET["mes"]))
						{
							echo"<div class='error'>{$_GET["mes"]}</div>";	
						}
					
					?>
					<div  style="margin-right: 70px;margin-bottom: 70px;height: 600px; overflow: hidden;">
                  <table class="styled-table">
                    <thead >
                      <tr>
                                <th>S.No</th>
                                <th>product name</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Edit</th>
                                <th>Delete</th>
                      </tr>
                    </thead>
					
                    <tbody>
					<?php
							$s="select * from product";
							$res=$db->query($s);
							if($res->num_rows>0)
							{
								$i=0;
								while($r=$res->fetch_assoc())
								{
									$i++;
									echo "
										<tr>
											<td>{$i}</td>
											<td>{$r["Product_Name"]}</td>
											<td>{$r["Price"]}</td>
											<td>{$r["Image"]}</td>
											<td>{$r["Product_Description"]}</td>
                                            <td>{$r["Quantity"]}</td>
                                            <td><a href='add_product.php?id={$r["Product_ID"]}'  class='btnr'>Edit</a></td>
											<td><a href='product_delete.php?id={$r["Product_ID"]}' class='btnr'>Delete</a></td>
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