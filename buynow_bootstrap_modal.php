<?php 
        include"database.php";
        session_start();
        $id= $_GET["id"];
        if(!isset($_SESSION["UID"]))
        {
            echo"<script>window.open('user_login.php?mes=Access Denied...','_self');</script>";
            
        }
?>

<?php
  if(isset($_POST["purchase"]))
  {
    $Customer_ID = $_SESSION['UID'];
    $Province = $_POST['province'];
    $District = $_POST['District'];
    $card = $_POST['cardtype'];
    $phone = $_POST['phone'];
    $Zip = $_POST['zip'];
    $Payment=$_POST['price'];
    $product=$_POST['product'];
    $address=$_POST['address'];
    $sq="INSERT INTO `order`(`Customer_ID`, `Province`, `District`, `Cardtype`, `Phone_no`, `Zip`, `Status`, `Date`, `Shipping_address`) 
    values({$Customer_ID},'{$Province}','{$District}','{$card}',
    {$phone},{$Zip},'order ready',NOW(),'{$address}')";
        if($db->query($sq))
        {
          echo '<script>alert("Payment Successfull")</script>';
        }
        else
        {
          echo '<script>alert("Payment UnSuccessfull")</script>';
        }
    $sq2='SELECT LAST_INSERT_ID()';
    $db->query($sq2);
    $res2=$db->query($sq2);   
    if($res2->num_rows>0)
    {
      $r2=$res2->fetch_assoc();
    }   
    $last_order_id=$r2['LAST_INSERT_ID()'];
    $sqlrun=false;
    $sq3="INSERT INTO `order_item`(`Order_Id`, `Product_Id`,`P_NAME`,`Price`,`Quantity`, `subtotal`) VALUES ({$last_order_id},{$id},
    '{$product}',{$Payment},1,{$Payment})";
    // echo $sq3;
    $db->query($sq3);


  }
 
?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once __DIR__ . '/vendor/autoload.php';
require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';

//$mail = new PHPMailer(true);

$alert = '';

if(isset($_POST["name"])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $price=$_POST['price'];
  $product=$_POST['product'];
  $message = "hi";

    //a new instance of library
    $mpdf = new \Mpdf\Mpdf();
    
    $data ='<!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8" />
        <title>Invoice</title>
    
        <style>
          .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            color: #555;
          }
    
          .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
          }
    
          .invoice-box table td {
            padding: 5px;
            vertical-align: top;
          }
    
          .invoice-box table tr td:nth-child(2) {
            text-align: right;
          }
    
          .invoice-box table tr.top table td {
            padding-bottom: 20px;
          }
    
          .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
          }
    
          .invoice-box table tr.information table td {
            padding-bottom: 40px;
          }
    
          .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
          }
    
          .invoice-box table tr.details td {
            padding-bottom: 20px;
          }
    
          .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
          }
    
          .invoice-box table tr.item.last td {
            border-bottom: none;
          }
    
          .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
          }
    
          @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
              width: 100%;
              display: block;
              text-align: center;
            }
    
            .invoice-box table tr.information table td {
              width: 100%;
              display: block;
              text-align: center;
            }
          }
    
          /** RTL **/
          .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
          }
    
          .invoice-box.rtl table {
            text-align: right;
          }
    
          .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
          }
        </style>
      </head>
    
      <body>
        <div class="invoice-box">
          <table cellpadding="0" cellspacing="0">
            <tr class="top">
              <td colspan="2">
                <table>
                  <tr>
                    <td class="title">
                      <img src="images/logo/mylogo.png" style="width: 100%; max-width: 300px" />
                    </td>
                    <td>
                      Invoice #: 123<br />
                      Created:'.date("Y/m/d").'<br />
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
    
            <tr class="information">
              <td colspan="2">
                <table>
                  <tr>
                    <td>
                      KKS Road,<br />
                      Manokara Junction<br />
                      Jaffna
                    </td>
    
                    <td>
                      Power Gym.<br />
                      Thuvarakan<br />
                      PowerGym@gmail.com
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
    
            
    
            <tr class="heading">
              <td>Item</td>
    
              <td>Price</td>
            </tr>
    
            <tr class="item">
              <td>'.$product.'</td>
    
              <td>'.$price.'</td>
            </tr>
    

    
            <tr class="total">
              <td></td>
    
              <td>Total: '.$price.'</td>
            </tr>
          </table>
        </div>
      </body>
    </html>';
    
    $mpdf -> WriteHtml($data);
   // $mpdf ->output("myfile.pdf","D");
   $enquirydata=[
       'name'=>$name,
       'email'=>$email,
       'message'=>$message
   ];
   $pdf= $mpdf->output("","S");
   sendEmail($pdf, $enquirydata);
  }


  function sendEmail($pdf, $enquirydata)
  {

        $emailbody='';
        $emailbody .='<h1>Email from'.$enquirydata['name'].'</h1>';
        foreach($enquirydata as $title => $data)
        {
            $emailbody .= "<strong>" .$title."</strong> :" .$data. "<br/>";
        }
   
       //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try{
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'thuvamit2017@gmail.com'; // Gmail address which you want to use as SMTP server
          $mail->Password = 'thuva1999'; // Gmail address Password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = '587';

          $mail->setFrom('awesomesolutions7@gmail.com'); // Gmail address which you used as SMTP server
          $mail->addAddress('awesomesolutions7@gmail.com'); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)

          $mail->addStringAttachment($pdf,"invoice.pdf");

          $mail->isHTML(true);                                  //Set email format to HTML
          $mail->Subject = 'Email from'.$enquirydata["name"];
          $mail->Body    = $emailbody;
          $mail->AltBody = strip_tags($emailbody);

          $mail->send();
          $alert = '<div class="alert-success">
                      <span>Message Sent! Thank you for contacting us.</span>
                      </div>';
        } catch (Exception $e){
          $alert = '<div class="alert-error">
                      <span>'.$e->getMessage().'</span>
                    </div>';
        }
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
     
     <?php 
          $sql="select * from product where Product_ID ='{$id}'";
          $res=$db->query($sql);
          if($res->num_rows>0)
          {
            while($row=$res->fetch_assoc())
            {
                $price=$row["Price"];
                $product=$row["Product_Name"];
            }
          }
      ?>


  <div class="row">
    <div class=" col-md-8" style="margin-left:auto;margin-right:auto;" >
      <h4 class="mb-3">Billing address</h4>
     <?php echo $_SESSION['Address']?>
      <form class="needs-validation" action="" method="post">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" id="firstName"  name="name" value='<?php echo $_SESSION["FirstNAME"]?>' required>
            <input type="hidden"   name="price" value='<?php echo $price?>' required>
            <input type="hidden"   name="product" value='<?php echo $product ?>' required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" id="lastName" lastName="lastName" value='<?php echo $_SESSION["LastNAME"] ?>' required>
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
          <input type="email" class="form-control" id="email" name="email"placeholder="you@example.com" value='<?php echo $_SESSION["Email"] ?>'> 
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>

        <div class="col-md-3 mb-3">
            <label for="zip">Phone No</label>
            <input type="text" class="form-control" id="zip" placeholder="Enter your Phone Number" name="phone" required>
            <div class="invalid-feedback">
              Contact  No required.
            </div>
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value='<?php echo $_SESSION["Address"] ?>' required>
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Province</label>
            <select class="custom-select d-block w-100" id="province" name="province" required>
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
            <select class="custom-select d-block w-100" id="District" name="District" required>
              <option value="">Choose...</option>
            </select>
            <div class="invalid-feedback">
              Please provide a valid state.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input type="text" class="form-control" id="zip" name="zip" placeholder="" required>
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


        <!--validation part-->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="cc-name">Name on card</label>
            <input type="text" class="form-control" id="cc-name" name="cardtype" placeholder="" required>
            <small class="text-muted">Full name as displayed on card</small>
            <div class="invalid-feedback">
              Name on card is required
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="cc-number">Credit card number</label>
            <input type="text" class="form-control" id="cc-number" placeholder=""  required>
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
        <button class="btn btn-primary btn-lg" type="submit" name="purchase"style="margin-bottom:20px;">Purchase</button>
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