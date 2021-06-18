<?php 
	include "database.php";
    session_start();
    unset ($_SESSION["AID"]);
    unset($_SESSION["start"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Power Gym</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  
<div style="height: 1000px;" class="container">
  <div class="row">
			<h1>Add To Cart In PHP</h1><hr>
			<a href='viewCart.php'>View Cart</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href='index.php'>Back</a>
			<?php 
			if(isset($_POST["addCart"])){
				if(isset($_SESSION["cart"]))
				{
					$pid_array=array_column($_SESSION["cart"],"pid");
					if(!in_array($_GET["id"],$pid_array))
					{
						$index=count($_SESSION["cart"]);
						$item=array(
							'pid' => $_GET["id"],
							'pname' => $_POST["pname"],
							'price' => $_POST["price"],
							'qty' => $_POST["qty"]
						);
						$_SESSION["cart"][$index]=$item;
							echo "<script>alert('Product Added..');</script>";
						header("location:viewCart.php");
					}
					else
					{
						echo "<script>alert('Already Added..');</script>";
					}
				}
				else
				{
						$item=array(
							'pid' => $_GET["id"],
							'pname' => $_POST["pname"],
							'price' => $_POST["price"],
							'qty' => $_POST["qty"]
						);
						$_SESSION["cart"][0]=$item;
						echo "<script>alert('Product Added..');</script>";
						header("location:viewCart.php");
				}
			}
			
			$sql="select * from product where Product_ID='{$_GET["id"]}'";
			$res=$db->query($sql);
			if($res->num_rows>0)
			{
				echo '<form action="'.$_SERVER["REQUEST_URI"].'" method="post">';
				if($row=$res->fetch_assoc())
				{
			echo  '
                    <div class="col-sm-4 col-lg-3 col-md-3 text-center">    
                        <img src="images/products/'. $row['Image'] .'" alt="" class="img-responsive" >
                        <p><strong><a href="#">'. $row['Product_Name'] .'</a></strong></p>
                        <h4 class="text-danger"> Rs.'. $row['Price'] .'</h4>
                        <p>Description : '. $row['Product_Description'].' </p>
                        <p><input type="text"  placeholder="Enter Qty" name="qty"  class="form-control"></p>
                        <p><input type="hidden"  name="pname" value="'. $row['Product_Name'] .'" class="form-control"></p>
                        <p><input type="hidden"  name="price" value="'. $row['Price'] .'" class="form-control"></p>
                        <p><input type="submit" name="addCart" class="btn btn-success"  value="Add to Cart">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </p>
                    </div>
                    ';
				}
				echo '</form>';
			}
			?>
  </div>
</div>
<div class="footer">
			  <footer><p>Copyright &copy; Thuvarakan </p></footer>
</div>
</body>
</html>
