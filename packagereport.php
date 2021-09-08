<?php

    header('Content-Type:application/json');
	include"database.php";


     //Package sales
     $sq="SELECT DATE(Consume_date) as DATE, SUM(Fees) totalPackageSale
     FROM `registration`  GROUP BY DATE(Consume_date)";
     $res=$db->query($sq);
     $data=array();
     foreach($res as $row)
     {
         $data[]=$row;
     }
     $res->close();
      print json_encode($data);


?>