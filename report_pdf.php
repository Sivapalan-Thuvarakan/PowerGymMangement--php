<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('admin_login.php?mes=Access Denied...','_self');</script>";
    
	}	
    $sq="SELECT DATE(o.Date) as DATE, SUM(i.subtotal) totalSale
    FROM `order` o  INNER JOIN order_item i ON 
    o.Order_ID=i.Order_Id GROUP BY DATE(Date)";
    $res=$db->query($sq);
    $invoice=mysqli_fetch_array($res);


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130	,5,'Gemul Cars Co',0,0);
$pdf->Cell(59	,5,'INVOICE',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130	,5,'[Street Address]',0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(130	,5,'[City, Country, ZIP]',0,0);
$pdf->Cell(25	,5,'Date',0,0);
$pdf->Cell(34	,5,'[dd/mm/yyyy]',0,1);//end of line

$pdf->Cell(130	,5,'Phone [+12345678]',0,0);
$pdf->Cell(25	,5,'Invoice #',0,0);
$pdf->Cell(34	,5,$invoice['invoiceID'],0,1);//end of line

$pdf->Cell(130	,5,'Fax [+12345678]',0,0);
$pdf->Cell(25	,5,'Customer ID',0,0);
$pdf->Cell(34	,5,$invoice['clientID'],0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//billing address
$pdf->Cell(100	,5,'Bill to',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$invoice['DATE'],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$invoice['totalSale'],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$invoice['totalSales'],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$invoice['totalSale'],0,1);

// //make a dummy empty cell as a vertical spacer
// $pdf->Cell(189	,10,'',0,1);//end of line

// //invoice contents
// $pdf->SetFont('Arial','B',12);

// $pdf->Cell(130	,5,'Description',1,0);
// $pdf->Cell(25	,5,'Taxable',1,0);
// $pdf->Cell(34	,5,'Amount',1,1);//end of line

// $pdf->SetFont('Arial','',12);

// //Numbers are right-aligned so we give 'R' after new line parameter

// //items
// $query=mysqli_query($con,"select * from item where invoiceID = '".$invoice['invoiceID']."'");
// $tax=0;
// $amount=0;
// while($item=mysqli_fetch_array($query)){
// 	$pdf->Cell(130	,5,$item['itemName'],1,0);
// 	$pdf->Cell(25	,5,number_format($item['tax']),1,0);
// 	$pdf->Cell(34	,5,number_format($item['amount']),1,1,'R');//end of line
// 	$tax+=$item['tax'];
// 	$amount+=$item['amount'];
// }

// //summary
// $pdf->Cell(130	,5,'',0,0);
// $pdf->Cell(25	,5,'Subtotal',0,0);
// $pdf->Cell(4	,5,'$',1,0);
// $pdf->Cell(30	,5,number_format($amount),1,1,'R');//end of line

// $pdf->Cell(130	,5,'',0,0);
// $pdf->Cell(25	,5,'Taxable',0,0);
// $pdf->Cell(4	,5,'$',1,0);
// $pdf->Cell(30	,5,number_format($tax),1,1,'R');//end of line

// $pdf->Cell(130	,5,'',0,0);
// $pdf->Cell(25	,5,'Tax Rate',0,0);
// $pdf->Cell(4	,5,'$',1,0);
// $pdf->Cell(30	,5,'10%',1,1,'R');//end of line

// $pdf->Cell(130	,5,'',0,0);
// $pdf->Cell(25	,5,'Total Due',0,0);
// $pdf->Cell(4	,5,'$',1,0);
// $pdf->Cell(30	,5,number_format($amount + $tax),1,1,'R');//end of line





















$pdf->Output();
?>
