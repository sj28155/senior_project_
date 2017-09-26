<!DOCTYPE html>
<html>
<head>
<meta name="generator" content="HTML Tidy for Linux (vers 25 March 2009), see www.w3.org">
<link rel="stylesheet" type="text/css" href="hw2.css">
<title>Order Report</title>

</head>
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



$date=$_POST["odate"];
$cust=$_POST["customer"];
$agent=$_POST["agentName"];
$status=$_POST["orderStatus"];
?>
<h1>Piedmont Furnishings Customer<br>
Order Report</h1>
<br>
<br>
<br>
<? if (Isset($_POST["submit2"])){?>
Order Date: <? print $date; ?><br>
Customer: <? print $cust; ?><br>
Sales Agent ID: <? print $agent; ?><br>
Order Status ID: <? print $status; ?><br><br><br>
<? } ?>




<table border='1'>
	<tr>
	<th>Order ID</th>
	<th>Product ID</th>
	<th>Quantity</th>
	<th>Unit Price</th>
	<th>Item Line Number</th>
	</tr>
	<?
	if(isset($_POST["submit2"])){
		
 
   $strSQL5 = "SELECT count(*) FROM orderitem WHERE order_id=" . $_SESSION["orderID"];
   $rs5 = mysqli_query($db, $strSQL5); 

   ?>   
		
   <? while($row = mysqli_fetch_array($rs5)){ ?>
   <? $num = $row[0]; ?>
   <? for($i=1;$i<= $num;$i++){ ?>
   <tr>
   <td>
   <? print $_SESSION["orderID"]; ?>
   </td>
   <td>
   <? print $_POST["productID" . $i]; ?>
   </td>
   
   <td>
   <? print $_POST["quantity".$i]; ?>
   </td>
   <td>
   <? print $_POST["unitprice". $i]; ?>
   </td>
   <td>
   <? print $_POST["itemlinenum". $i]; ?>
   </td>

   </tr>
   <?
	$sql = "UPDATE orderitem SET product_id='" . $_POST["productID".$i] . "', item_quantity='" . $_POST["quantity".$i] . "', item_unitprice='" . $_POST["unitprice".$i] . "', item_linenum='" . $_POST["itemlinenum". $i] . "' WHERE order_id='" . $_SESSION["orderID"] . "'";
		if (mysqli_query($db, $sql)) 
			{
				echo "Orderitem Update Success!<br> ";
			}	 
				else 	
			{
				echo "Error: " . $sql . "<br>" . mysqli_error($db);
			}
	$sql2 = "UPDATE salesorder SET cust_id='" . $cust . "', order_date='" . $date . "', emp_id='". $agent . "', status_id='" . $status . "' WHERE order_id='" . $_SESSION["orderID"] . "'";
		
		if (mysqli_query($db, $sql2)) 
				{
					echo "Salesorder Update Success!<br><br> ";
				}	 
					else 	
				{
					echo "Error: " . $sql2 . "<br>" . mysqli_error($db);
				}		
	?> 
	
		<? } ?>
	<? } ?> 
<? }?>
<!--table-->

		
	</table>
		
	


<br>
<br>
<? 
	mysqli_close($db);   
	
?>




</body>
</html>