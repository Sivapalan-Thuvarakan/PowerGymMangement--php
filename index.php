<?php 
	include "database.php";
    session_start();
    unset ($_SESSION["AID"]);
    unset($_SESSION["start"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Power GYM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/dropdown.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php include"navbar.php";?>
<div class="container" style="margin-bottom: 60px;" >
  <div class="row">
			<h1>Shopping</h1><hr>
			<?php 
			$sql="select * from product";
			$res=$db->query($sql);
			if($res->num_rows>0)
			{
				while($row=$res->fetch_assoc())
				{
                    echo  '
                        <div class="col-sm-4 col-lg-3 col-md-3 text-center" style="margin: bottom 50px;">
                            
                            <img src="images/products/'.$row['Image'].'" alt=""  height="230" width="230">
                            <p><strong><a href="#">'. $row['Product_Name'] .'</a></strong></p>
                            <h4 class="text-danger"> Rs.'. $row['Price'] .'</h4>';
                            if(isset($_SESSION["UID"]))
                            {

                              //we are using get method to send product ID to view_addtocart_product
                              echo '<p><a href="view_addtocart_product.php?id='. $row['Product_ID'] .'" class="btn btn-success">View Details</a>
                              <a href="buynow_bootstrap_modal.php?id='. $row['Product_ID'] .'" class="btn btn-success">Buynow</a></p></div>';
                            }
                            else
                            {
                              
                              echo '<p><a href="#" data-toggle="modal" data-target="#showTerms" class="btn btn-success">View Details</a>
                              <a href="#" data-toggle="modal" data-target="#showTerms"   class="btn btn-success">Buynow</a></p>
                              </div>';
                            }
                     
				}
			}
			?>
  </div>
</div>
<div class="footer">
			  <footer><p>Copyright &copy; Thuvarakan </p></footer>
</div>


<!--Modal Box-->
<div class="modal fade" id="showTerms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel" style="color:red;">Warning!!!!</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Please Login your Account or Create your Account!!!
      </div>
      <div class="modal-footer">
      <p><a href="user_login.php" class="btn btn-success">Login</a>
        <a href="signup.php"  class="btn btn-success">Signup</a></p>
      </div>
    </div>
  </div>
</div>


</body>
</html>


<!--<p><a href="view_addtocart_product.php?id='. $row['Product_ID'] .'" class="btn btn-success">View Details</a>
<a href="buynow_bootstrap_modal.php?id='. $row['Product_ID'] .'" class="btn btn-success">Buynow</a></p>-->