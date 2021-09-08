<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('index.php?mes=Access Denied...','_self');</script>";
		
	}	

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Power Gym</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<?php include"navbar.php";?><br>
			<div id="section">
				<?php include"sidebar.php";?><br>
				<h3 class="text">Welcome <?php echo $_SESSION["ANAME"]; ?></h3><br><hr><br>
				<h3>Reports</h3><br>
					
					<?php
						if(isset($_GET["mes"]))
						{
							echo"<div class='error'>{$_GET["mes"]}</div>";	
						}
					
					?>
                    <div style="position:relative" >
                        <canvas id="mySales"style="position:absolute; top:400px; left:600px; z-index:1" >
                        </canvas>
                        <canvas id="myPackages" style="position:absolute; top:400px; left:1050px; z-index:1">
                        </canvas>
                       <canvas id="Packages" style="position:absolute; top:10px; left:800px; z-index:1">
                        </canvas>
                        <canvas id="Products" style="position:absolute; top:10px; left:350px; z-index:1">
                        </canvas>
                        <canvas id="Inventory" style="position:absolute; top:10px; left:1200px; z-index:1">
                        </canvas>
                    </div>
			</div>
            
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

            <!-- sales report -->
            <script>
                $(document).ready(function(){
		        	$.ajax({
                        url:"/powergymfinal/salesreport.php",
                        method:"GET",
                        success:function(data)
                        {
                            var date=[];
                            var sales=[];
                            var colors=[];
                            for(var i in data)
                            {
                                date.push(data[i].DATE);
                                sales.push(data[i].totalSale);
                                colors.push(color());
                            }
                            var chartdata={
                                labels:date,
                                datasets:[
                                  {  label:"Sales",
                                    backgroundColor:colors,
                                    data:sales}
                                ]
                            };

                            var ctx =$("#mySales");
                            var barchart= new Chart(ctx,
                            {
                                type: 'bar',
                            data:  chartdata,
                            options:{
                                responsive:false,
                                plugins: {
                                    legend: {display:false},
                                    title:{
                                        display:true,
                                        text:'Sales of Power Gym',
                                        color:"#fc5c65",
                                    }
                                }
                            }
                            });

                        },
                        error:function(data)
                        {
                            console.log(data);
                        }
                    });

                    function color()
                    {
                        var r= Math.floor(Math.random()*256);
                        var g= Math.floor(Math.random()*256);
                        var b= Math.floor(Math.random()*256);
                        var rgba='rgba('+r+','+g+','+b+',1.0)';
                        return rgba;
                    }

		        });
            </script>

                    <!-- Package Registration -->

                <script>
                                $(document).ready(function(){
                                    $.ajax({
                                        url:"/powergymfinal/packagereport.php",
                                        method:"GET",
                                        success:function(data)
                                        {
                                            var date=[];
                                            var value_of_Packages=[];
                                            var colors=[];
                                            for(var i in data)
                                            {
                                                date.push(data[i].DATE);
                                                value_of_Packages.push(data[i].totalPackageSale);
                                                colors.push(color());
                                            }
                                            var chartdata={
                                                labels:date,
                                                datasets:[
                                                {  label:"Packages",
                                                    backgroundColor:colors,
                                                    data:value_of_Packages}
                                                ]
                                            };

                                            var ctx1 =$("#myPackages");
                                            var barchart= new Chart(ctx1,
                                            {
                                                type: 'bar',
                                            data:  chartdata,
                                            options:{
                                                responsive:false,
                                                plugins: {
                                                    legend: {display:false},
                                                    title:{
                                                        display:true,
                                                        text:'Sales of Training Packages',
                                                        color:"#fc5c65",
                                                    }
                                                }
                                            }
                                            });

                                        },
                                        error:function(data)
                                        {
                                            console.log(data);
                                        }
                                    });

                                    function color()
                                    {
                                        var r= Math.floor(Math.random()*256);
                                        var g= Math.floor(Math.random()*256);
                                        var b= Math.floor(Math.random()*256);
                                        var rgba='rgba('+r+','+g+','+b+',1.0)';
                                        return rgba;
                                    }

                                });
            </script>

                                <!-- Individual Package Registration -->

                                <script>
                                $(document).ready(function(){
                                    $.ajax({
                                        url:"/powergymfinal/individual_package_report.php",
                                        method:"GET",
                                        success:function(data)
                                        {
                                            var package=[];
                                            var value_of_Packages=[];
                                            var colors=[];
                                            for(var i in data)
                                            {
                                                package.push(data[i].Package_Name);
                                                value_of_Packages.push(data[i].total);
                                                colors.push(color());
                                            }
                                            var chartdata={
                                                labels:package,
                                                datasets:[
                                                {  label:"value of Packages",
                                                    backgroundColor:colors,
                                                    data:value_of_Packages}
                                                ]
                                            };

                                            var ctx2 =$("#Packages");
                                            var barchart= new Chart(ctx2,
                                            {
                                                type: 'pie',
                                            data:  chartdata,
                                            options:{
                                                responsive:false,
                                                plugins: {
                                                    legend: {display:true},
                                                    title:{
                                                        display:true,
                                                        text:'Sales of Training Packages',
                                                        color:"#fc5c65",
                                                    }
                                                }
                                            }
                                            });

                                        },
                                        error:function(data)
                                        {
                                            console.log(data);
                                        }
                                    });

                                    function color()
                                    {
                                        var r= Math.floor(Math.random()*256);
                                        var g= Math.floor(Math.random()*256);
                                        var b= Math.floor(Math.random()*256);
                                        var rgba='rgba('+r+','+g+','+b+',1.0)';
                                        return rgba;
                                    }

                                });
            </script>


            <!-- Individual Product Details -->

            <script>
                                            $(document).ready(function(){
                                                $.ajax({
                                                    url:"/powergymfinal/individual_product_report.php",
                                                    method:"GET",
                                                    success:function(data)
                                                    {
                                                        var product=[];
                                                        var value_of_Product=[];
                                                        var colors=[];
                                                        for(var i in data)
                                                        {
                                                            product.push(data[i].Product_Name);
                                                            value_of_Product.push(data[i].total);
                                                            colors.push(color());
                                                        }
                                                        var chartdata={
                                                            labels:product,
                                                            datasets:[
                                                            {  label:"value of Product",
                                                                backgroundColor:colors,
                                                                data:value_of_Product}
                                                            ]
                                                        };

                                                        var ctx2 =$("#Products");
                                                        var barchart= new Chart(ctx2,
                                                        {
                                                            type: 'pie',
                                                        data:  chartdata,
                                                        options:{
                                                            responsive:false,
                                                            plugins: {
                                                                legend: {display:true},
                                                                title:{
                                                                    display:true,
                                                                    text:'Sales of products',
                                                                    color:"#fc5c65",
                                                                }
                                                            }
                                                        }
                                                        });

                                                    },
                                                    error:function(data)
                                                    {
                                                        console.log(data);
                                                    }
                                                });

                                                function color()
                                                {
                                                    var r= Math.floor(Math.random()*256);
                                                    var g= Math.floor(Math.random()*256);
                                                    var b= Math.floor(Math.random()*256);
                                                    var rgba='rgba('+r+','+g+','+b+',1.0)';
                                                    return rgba;
                                                }

                                            });
                        </script>

                           <!-- Inventory Details -->

            <script>
                                            $(document).ready(function(){
                                                $.ajax({
                                                    url:"/powergymfinal/inventory_report.php",
                                                    method:"GET",
                                                    success:function(data)
                                                    {
                                                        var product=[];
                                                        var value_of_Product=[];
                                                        var colors=[];
                                                        for(var i in data)
                                                        {
                                                            product.push(data[i].Product_Name);
                                                            value_of_Product.push(data[i].total);
                                                            colors.push(color());
                                                        }
                                                        var chartdata={
                                                            labels:product,
                                                            datasets:[
                                                            {  label:"value of Product",
                                                                backgroundColor:colors,
                                                                data:value_of_Product}
                                                            ]
                                                        };

                                                        var ctx2 =$("#Inventory");
                                                        var barchart= new Chart(ctx2,
                                                        {
                                                            type: 'pie',
                                                        data:  chartdata,
                                                        options:{
                                                            responsive:false,
                                                            plugins: {
                                                                legend: {display:true},
                                                                title:{
                                                                    display:true,
                                                                    text:'Inventory',
                                                                    color:"#fc5c65",
                                                                }
                                                            }
                                                        }
                                                        });

                                                    },
                                                    error:function(data)
                                                    {
                                                        console.log(data);
                                                    }
                                                });

                                                function color()
                                                {
                                                    var r= Math.floor(Math.random()*256);
                                                    var g= Math.floor(Math.random()*256);
                                                    var b= Math.floor(Math.random()*256);
                                                    var rgba='rgba('+r+','+g+','+b+',1.0)';
                                                    return rgba;
                                                }

                                            });
                        </script>
				<?php include"footer.php";?>
	</body>
</html>