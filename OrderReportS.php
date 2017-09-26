<!DOCTYPE html>
<html>

<meta name="generator" content="HTML Tidy for Linux (vers 25 March 2009), see www.w3.org">
<title>Order Report</title>
<link rel="stylesheet" type="text/css" href="hw2.css">

<? session_start();?>
<h5><?print "Hello, " . $_SESSION["name"];?></h5>
<nav class='navClass'>
	<ul> 
		<li><a href="sales.php">Home</a></li>
		<li>Orders
			<ul class= "sub-menu">
			<li><a href="newOrderS.php" >New Order form</a></li>
			<li><a href= "editOrderS.php" >Edit Order</a></li>
		</ul>
		<span class="arrow">&#9660;</span>
	</li>
		<li>Customers
			<ul class="sub-menu">
			<li><a href= "newcustS.php">New Customers form</a></li>
			<li><a href="editcustS.php">Edit Customers form</a></li>
		</ul>
		<span class="arrow">&#9660;</span>
		
	</li>
		<li>Reports
			<ul class="sub-menu">
			<li><a href="SalesReportS.php">Itemized Sales Report</a></li>

		
	</ul>
	<span class="arrow">&#9660;</span>
	</li>
	<li><a href="login.php">Logout</a></li>
	</br></br></br></br></br>
	
</nav>
<body>

<? 
$db = mysqli_connect('database.hosting.vt.edu', 'bit444408', 'qalshathseshzodg', 'bit444408') or die ("I cannot connect to the database because: ".mysqli_connect_error()); 
?>
<h1>Piedmont Furnishings Customer<br>
Order Report</h1>
<br>
<br>
<br>
<? if (Isset($_POST["submit2"])){?>

<? $orderid = $_POST["orderid"]; 
	$date = $_POST["odate"]; 
	$customer = $_POST["customer"];
	$agentName = $_SESSION["name"]
?>

Order ID: <? print $orderid; ?><br>
Order Date: <? print $date; ?><br>
Customer ID: <? print $customer; ?><br>
Sales Agent: <? print $agentName;?><br>
<br><br><br>
<? } ?>




<!--table-->

<?
	$rows = $_POST["itemnum"];
	$cols = 6;

	echo "<table border='1'>";
	echo "<tr>
	<th>Product ID</th>
	<th>Quantity</th>
	<th>Unit Price</th>
	<th>Total Price</th>
	</tr>";
		
	
	for($tr=1;$tr<=$rows;$tr++){

		echo "<tr>";?>
		
<?   
	 $productID=$_POST["productID" . $tr];
	 $quantity = $_POST["quantity" . $tr]; 
	 $UnitPrice = $_POST["UnitPrice" . $tr];
?>

	<td>
	<? print $productID ?>
	</td>
	<td>
	<? print $quantity ?>
	</td>
	<td>
	<? print $UnitPrice ?>
	</td>
	<td>
	
	<? $totalprice=number_format(${"totalprice" . $tr}=$quantity*$UnitPrice, 2);
	print $totalprice;
	?>
	</td>
	<?		
	$sql = "INSERT INTO orderitem (item_linenum, order_id, product_id, item_quantity, item_unitprice) VALUES ('".$tr."', '".$orderid."','".$productID."', '".$quantity."', '".$UnitPrice."')";
		if ($result= mysqli_query($db, $sql)) 
			{
				echo " ";
			}	 
				else 
			{
				echo "Error: " . $sql . "<br>" . mysqli_error($db);
			}
	
?>
	<?	echo "</tr>";
	}
	$sql2 = "INSERT INTO salesorder (order_id, cust_id, order_date, emp_id, status_id) VALUES ('".$orderid."', '".$customer."','".$date."', '".$_SESSION["empid"]."', '1')";
		if ($result2= mysqli_query($db, $sql2)) 
			{
				echo "Record Added successfully\n";
			}	 
				else 
			{
				echo "Error: " . $sql2 . "<br>" . mysqli_error($db);
			}
		
	echo "</table>";
	?>

<!--table end-->




<?	

mysqli_close($db);
	
	?>




</body>
</html>