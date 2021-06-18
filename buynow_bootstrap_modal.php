<?php 
        include"database.php";
        session_start();
        if(!isset($_SESSION["UID"]))
        {
            echo"<script>window.open('user_login.php?mes=Access Denied...','_self');</script>";
            
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Power Gym</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>
<body>

<div class="container" style="margin-bottom:60px;">
  <div class="py-5 text-center">
    <h2>Checkout form</h2>
  </div>

  <div class="row">
    <div class=" col-md-8" style="margin-left:auto;margin-right:auto;" >
      <h4 class="mb-3">Billing address</h4>
     <?php echo $_SESSION['Address']?>
      <form class="needs-validation">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" id="firstName" placeholder="" value='<?php echo $_SESSION["FirstNAME"] ?>' required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" id="lastName" placeholder="" value='<?php echo $_SESSION["LastNAME"] ?>' required>
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="username">Username</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">@</span>
            </div>
            <input type="text" class="form-control" id="username" placeholder="Username"  value='<?php echo $_SESSION["UNAME"] ?>' required>
            <div class="invalid-feedback" style="width: 100%;">
              Your username is required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control" id="email" placeholder="you@example.com" value='<?php echo $_SESSION["Email"] ?>'> 
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>

        <div class="col-md-3 mb-3">
            <label for="zip">Phone No</label>
            <input type="text" class="form-control" id="zip" placeholder="Enter your Phone Number" required>
            <div class="invalid-feedback">
              Contact  No required.
            </div>
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" placeholder="1234 Main St" value='<?php echo $_SESSION["Address"] ?>' required>
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>

        <div class="mb-3">
          <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
          <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Province</label>
            <select class="custom-select d-block w-100" id="province" required>
              <option value="">Choose...</option>
              <option value='Central'>Central</option>
              <option value='Eastern'>Eastern</option>
              <option value='Northern'>Northern</option>
              <option value='NorthCentral'>North Central</option>
              <option value='North Western'>North Western</option>
              <option value='Sabaragamuwa'>Sabaragamuwa</option>
              <option value='Southern'>Southern</option>
              <option value='Uva'>Uva</option>
              <option value='Western'>Western</option>
            </select>
            <div class="invalid-feedback">
              Please select a valid country.
            </div>
          </div>
       
       <!--CONTROL DISTRICT SELECT'S OPTION INPUT BASED ON VALUE OF PROVINCE SELECT-->
       
       <script> 
        $(document).ready(function () {
                $("#province").change(function () {
                    var val = $(this).val();
                    if (val == "Central") {
                        $("#District").html(
                            "<option value='Kandy'>Kandy</option><option value='Matale'>Matale</option><option value='NuwaraEliya'>NuwaraEliya</option>");
                    } 
                    else if (val == "Eastern") {
                        $("#District").html("<option value='Ampara'>Ampara</option><option value='Batticaloa'>Batticaloa</option><option value='Trincomalee'>Trincomalee</option>");
                    } 
                    else if (val == "Northern") {
                        $("#District").html("<option value='Jaffna'>Jaffna</option><option value='Kilinochchi'>Kilinochchi</option><option value='Mannar'>Mannar</option><option value='Mullaitivu'>Mullaitivu</option><option value='Vavuniya'>Vavuniya</option>");
                    } 
                    else if (val == "NorthCentral") {
                        $("#District").html("<option value='Anuradhapura'>Anuradhapura</option><option value='Polonnaruwa'>Polonnaruwa</option>");
                    }
                    else if (val == "NorthWestern") {
                        $("#District").html("<option value='Puttalam'>Puttalam</option><option value='Kurunegala'>Kurunegala</option>");
                    } 
                    else if (val == "Sabaragamuwa") {
                        $("#District").html("<option value='Kegalle'>Kegalle</option><option value='Ratnapura'>Ratnapura</option>");
                    } 
                    else if (val == "Southern") {
                        $("#District").html("<option value='Galle'>Galle</option><option value='Hambantota'>Hambantota</option><option value='Matara'>Matara</option>");
                    }
                    else if (val == "Uva") {
                        $("#District").html("<option value='Badulla'>Badulla</option><option value='Moneragala'>Moneragala</option>");
                    } 
                    else if (val == "Western") {
                        $("#District").html("<option value='Colombo'>Colombo</option><option value='Gampaha'>Gampaha</option><option value='Kalutara'>Kalutara</option>");
                    }
                });
            });
        </script>

          <div class="col-md-4 mb-3">
            <label for="state">District</label>
            <select class="custom-select d-block w-100" id="District" required>
              <option value="">Choose...</option>
            </select>
            <div class="invalid-feedback">
              Please provide a valid state.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input type="text" class="form-control" id="zip" placeholder="" required>
            <div class="invalid-feedback">
              Zip code required.
            </div>
          </div>
        </div>
      

        <h4 class="mb-3">Payment</h4>

        <div class="d-block my-3">
          <div class="custom-control custom-radio">
            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
            <label class="custom-control-label" for="credit">Credit card</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
            <label class="custom-control-label" for="debit">Debit card</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
            <label class="custom-control-label" for="paypal">PayPal</label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="cc-name">Name on card</label>
            <input type="text" class="form-control" id="cc-name" placeholder="" required>
            <small class="text-muted">Full name as displayed on card</small>
            <div class="invalid-feedback">
              Name on card is required
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="cc-number">Credit card number</label>
            <input type="text" class="form-control" id="cc-number" placeholder="" required>
            <div class="invalid-feedback">
              Credit card number is required
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 mb-3">
            <label for="cc-expiration">Expiration</label>
            <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
            <div class="invalid-feedback">
              Expiration date required
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="cc-cvv">CVV</label>
            <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
            <div class="invalid-feedback">
              Security code required
            </div>
          </div>
        </div>
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg" type="submit" style="margin-bottom:20px;">Purchase</button>
        <a href="index.php" class="btn btn-success" style="float:right;">Back</a>
      </form>
    </div>
  </div>
</div>
<div class="footer">
			  <footer><p>Copyright &copy; Thuvarakan </p></footer>
</div>
</body>
</html>