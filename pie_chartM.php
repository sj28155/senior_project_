<!DOCTYPE HTML>
<html>
<link rel="stylesheet" type="text/css" href="hw2.css">
<script type="text/javascript" src= "validation.js"></script>
   <meta charset="UTF-8">
<title>
 Piedmont Furnishings Customer </title>

<? session_start();?>
<h5><?print "Hello, " . $_SESSION["name"];?></h5>

<nav class='navClass'>
   <ul> 
      	<li><a href="manager.php">Home</a></li>
		<li>Orders
			<ul class= "sub-menu">
			<li><a href="newOrderM.php" >New Order form</a></li>
			<li><a href= "editOrderM.php" >Edit Order</a></li>
		</ul>
		<span class="arrow">&#9660;</span>
	</li>
		<li>Customers
			<ul class="sub-menu">
			<li><a href= "newcustM.php">New Customers form</a></li>
			<li><a href="editcustM.php">Edit Customers form</a></li>
		</ul>
		<span class="arrow">&#9660;</span>
		
	</li>
		<li>Reports
			<ul class="sub-menu">
			<li><a href="SalesReportM.php">Itemized Sales Report</a></li>
			<li><a href="finalreportM.php">Final Reports</a></li>

      
   </ul>
   <span class="arrow">&#9660;</span>
   </li>
	<li><a href="login.php">Logout</a></li>
   </br></br></br></br></br>
   
</nav>
<body>


<h1> Piedmont Furnishings<br>
Sales Agent Performance Report</h1>
<br>
<? 
$beg_date = "2013-07-08";  // we may want our data to be based on user inputs
$end_date = date("Y-m-d"); 
?>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="fusioncharts.js"></script>
<script type="text/javascript" src="fusioncharts-jquery-plugin.js"></script>
<script type="text/javascript">
$(document).ready(function(){

$("#chart-container").insertFusionCharts({
        type: "pie3d",
        width: "500",
        height: "300",
        dataFormat: "json",
        dataSource: {
	 "chart": {
                "caption": "Regional report - <?= $_SESSION["category"] ?> furniture",
                "subCaption": "<?= "Sales agent " . $_SESSION["emp_id"] . ": " . $beg_date . " to " . 						$end_date; ?>",
                "xAxisName": "Region",
                "yAxisName": "Sales",
                //Making the chart export enabled in various formats
                "exportEnabled" :"1",
                "numberPrefix": "$",
                "theme": "fint"
            },

            "data": [
			
<? 	$db = mysqli_connect('database.hosting.vt.edu', 'bit444408', 'qalshathseshzodg', 'bit444408') or die ("I cannot connect to the database because: ".mysqli_connect_error()); 

$sql = "SELECT region_name AS Region, SUM(item_quantity*item_unitprice) AS Sales FROM (region, customer, salesorder, orderitem, category, product, employee) WHERE(region.region_id = customer.region_id) AND customer.cust_id = salesorder.cust_id AND salesorder.order_id  = orderitem.order_id AND orderitem.product_id = product.product_id AND product.category_id = category.category_id AND employee.emp_id = salesorder.emp_id AND category.category_name= '" . $_SESSION["category"] . "' AND employee.emp_id=" . $_SESSION["emp_id"] . " AND order_date BETWEEN '" . $beg_date . "' AND '" . $end_date . "' GROUP BY region_name ORDER BY region_name";

$result = mysqli_query($db, $sql) or die("SQL error: " . mysqli_error());

$row = mysqli_fetch_array($result);
print "{\n\t\"label\": \"" . $row["Region"] . "\",\n\"value\": \"" . $row["Sales"] . "\"\n}";
while($row = mysqli_fetch_array($result)){  
 print ", {\n\t\"label\": \"" . $row["Region"] . "\",\n\"value\": \"" . $row["Sales"] . "\"\n}";
} 

mysqli_close($db); 
?>
		]
        }
    });

});
	
</script>
</head>
<body>

<div id="chart-container"><b>The chart will go here.</b></div>

</body>
</html>
