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
    $Trainee_ID = $_SESSION['UID'];
    $Package_status = "Active";
    $Package= $_POST['package'];
  
    $sq="UPDATE  `trainee` set Package_status='{$Package_status}',Package='{$Package}' where Trainee_ID={$_SESSION['UID']} ";
    $sq2="INSERT INTO `registration`( `Trainee_ID`, `Package_ID`, `Fees`, `Consume_date`) VALUES ({$_SESSION['UID']},{$id},
    {$_POST['price']},NOW())";
    $db->query($sq2);
    if($db->query($sq))
    {
      echo '<script>alert("Payment Successfull")</script>';
    }
    else
    {
      echo '<script>alert("Payment UnSuccessfull")</script>';
    }

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
  $message="hi";
  $price=$_POST['price'];
  $package=$_POST['package'];
  $Duration=$_POST["Duration"];
  $image=$_POST["Image"];
  $Description=$_POST["Package_Description"];

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
              <td>Registered Package</td>
            </tr>
            <tr class="item">
              <td>Package Name :'.$package.'</td>
            </tr>
            <tr class="item">
              <td>Duration :'.$Duration.'</td>
            </tr>
            <tr class="item">
              <td>Description :'.$Description.'</td>
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
          $mail->Username = ''; // Gmail address which you want to use as SMTP server
          $mail->Password = ''; // Gmail address Password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = '587';

          $mail->setFrom(''); // Gmail address which you used as SMTP server
          $mail->addAddress(''); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)

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
          $sql="select * from package where Package_ID='{$id}'";
          $res=$db->query($sql);
          if($res->num_rows>0)
          {
            while($row=$res->fetch_assoc())
            {
                $price=$row["Price"];
                $package=$row["Package_name"];
                $Duration=$row["Duration"];
                $image=$row["Image"];
                $Description=$row["Package_Description"];
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
            <input type="hidden"   name="package" value='<?php echo $package ?>' required>
            <input type="hidden"   name="Duration" value='<?php echo $Duration?>' required>
            <input type="hidden"   name="Image" value='<?php echo $image ?>' required>
            <input type="hidden"   name="Package_Description" value='<?php echo $Description?>' required>
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
          <input type="text" class="form-control" id="address" name="address"  value='<?php echo $_SESSION["Address"] ?>' required>
          <div class="invalid-feedback">
            Please enter your shipping address.
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