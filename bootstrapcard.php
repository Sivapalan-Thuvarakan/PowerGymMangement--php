<?php $s="SELECT COUNT(Customer_ID) as total FROM customer";
	  $res=$db->query($s); 

      $s1="SELECT SUM(Payment) as total FROM `order` WHERE Date";
	  $res1=$db->query($s1); 

      $s2="SELECT COUNT(Trainer_ID) as total FROM trainer";
	  $res2=$db->query($s2); 
 ?>
<div class="cardrow">
  <div class="cardcolumn">
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                <img class="cardimg" src="images/poster/customer.jpg" alt="Avatar" style="width:250px;height:200px;">
                </div>
                <div class="flip-card-back">
                <h1>Customer</h1> 
                <h1>Total</h1> 
                <p style="font-size:100px"><?php echo $res->fetch_object()->total; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="cardcolumn">
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                <img class="cardimg" src="images/poster/Inventory.jpg" alt="Avatar" style="width:250px;height:200px;">
                </div>
                <div class="flip-card-back">
                <h1>Sales</h1> 
                <p>Total</p> 
                <p style="font-size:50px">RS.<?php echo $res1->fetch_object()->total; ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="cardcolumn">
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                <img class="cardimg" src="images/poster/trainer.jpg" alt="Avatar" style="width:250px;height:200px;">
                </div>
                <div class="flip-card-back">
                <h1>Trainer</h1> 
                <p>Total</p> 
                <p style="font-size:100px"><?php echo $res2->fetch_object()->total; ?></p>
            </div>
        </div>
    </div>
     
    </div>
</div>

