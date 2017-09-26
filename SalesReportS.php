<!DOCTYPE HTML>
<html>
<link rel="stylesheet" type="text/css" href="hw2.css">
	<meta charset="UTF-8">
<head>
<title>Piedmont Furnishings Customer</title>
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
			<li><a href="finalreportS.php">Final Reports</a></li>
		
	</ul>
	<span class="arrow">&#9660;</span>
	</li>
	<li><a href="login.php">Logout</a></li>
	</br></br></br></br></br>
	
</nav>
<body>
<h1>Piedmont Furnishings
</br>
Itemized Sales Report</h1>
</br>
<?
// This example is adapted from:  http://www.tonymarston.net/php-mysql/dom.html
include "connect_to_DB.php";
connectDB();
$strSQL = "SELECT salesorder.order_id, salesorder.cust_id, salesorder.emp_id, salesorder.order_date, salesorder.status_id, orderitem.product_id, orderitem.item_quantity, orderitem.item_unitprice FROM salesorder LEFT JOIN orderitem
	ON salesorder.order_id = orderitem.order_id";
	$rs = mysqli_query($db, $strSQL)  or die("Error in SQL statement: " . mysqli_error());  
	$numrows = mysqli_num_rows($rs);
	$row = mysqli_fetch_array($rs);
	
	$dateSQL = "SELECT DISTINCT order_date FROM salesorder ORDER BY order_date ASC";
	$rd = mysqli_query($db, $strSQL)  or die("Error in SQL statement: " . mysqli_error());  
	$numrows = mysqli_num_rows($rd);

	$newID = 101;
	$rndSQL = "Select order_id FROM salesorder WHERE order_id = ".$newID;
	while(mysqli_num_rows(mysqli_query($db, $rndSQL)) > 0){
		echo "<script>console.log($newID)</script>";
		$newID++;
		$rndSQL = "Select order_id FROM salesorder WHERE order_id =". $newID;
	}
	?>
	<head>
		<title>Sales Report</title>
	</head>
	<contained><form action="#" method="post"></br>
	Start Date:
		<select name="DateRange">
			<?while($daterow = mysqli_fetch_array($rd)){
				echo "<option value=$daterow[3]>$daterow[3]</option>";
			}?>
		</select>
		<?mysqli_data_seek($rd,0);?>
		</br>
	End Date:
	&nbsp;
		<select name="DateRangeEnd">
			<?while($daterow = mysqli_fetch_array($rd)){
				echo "<option value=$daterow[3]>$daterow[3]</option>";
			}?>
		</select>
		</br>
		</contained>
		</br>
		<input type="submit" name="submit" value="Report">
	</form>
	</br>
	<form method="post" action="OrderReportM.php">
	<table border = "1">
		<tr>
			<th>Order#</th>
			<th>Customer ID</th>
			<th>Agent ID</th>
			<th>Date</th>
			<th>Status</th>
			<th>Item #</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Total</th>
		</tr>
		<?$totalPrice = 0;
		$rs = mysqli_query($db, $strSQL)  or die("Error in SQL statement: " . mysqli_error());
		$doc = new DomDocument();
		$root = $doc->createElement('salesreport');
		$root = $doc->appendChild($root);
		$occ = $doc->createElement('report');
		$occ = $root->appendChild($occ);
		
		for($x=0; $x <= $numrows; $x++)
			
			{
				$row = mysqli_fetch_array($rs);
				$occ = $doc->createElement('report');
				$occ = $root->appendChild($occ);
				if(isset($_POST['submit']))
				{
					$start_date = $_POST['DateRange'];
					$end_date = $_POST['DateRangeEnd'];
				}
				else
				{
					$start_date = '2013-07-10';
					$end_date = '2013-07-10';
				}
				$date_from_user = $row[3];
				if($end_date > $date_from_user && $date_from_user > $start_date){?>
					<tr>
					<td><label ><?=$row[0]?></label>
				<input type="hidden"name="Order<?=$x?>" value="<?=$row[0]?>"></input>
				<input type="hidden"name="CustID<?=$x?>" value="<?=$row[1]?>"></input>
				<input type="hidden"name="AgentID<?=$x?>" value="<?=$row[2]?>"></input>
				<input type="hidden"name="Date<?=$x?>" value="<?=$row[3]?>"></input>
				<input type="hidden"name="Status<?=$x?>" value="<?=$row[4]?>"></input>
				<input type="hidden"name="Item<?=$x?>" value="<?=$row[5]?>"></input>
				<input type="hidden"name="Quantity<?=$x?>" value="<?=$row[6]?>"></input>
				<input type="hidden"name="Price<?=$x?>" value="<?=$row[7]?>"></input></td>
				
				<?
				$child = $doc->createElement('Order');
				$child = $occ->appendChild($child);
			
				$value = $doc->createTextNode($row[0]);
				$value = $child->appendChild($value);
				
				//-----------------------------------
				
				$child = $doc->createElement('CustID');
				$child = $occ->appendChild($child);
			
				$value = $doc->createTextNode($row[1]);
				$value = $child->appendChild($value);
				
				//-----------------------------------
				
				$child = $doc->createElement('AgentID');
				$child = $occ->appendChild($child);
			
				$value = $doc->createTextNode($row[2]);
				$value = $child->appendChild($value);
				
				//-----------------------------------
				
				$child = $doc->createElement('Date');
				$child = $occ->appendChild($child);
			
				$value = $doc->createTextNode($row[3]);
				$value = $child->appendChild($value);
				
				//-----------------------------------
				
				$child = $doc->createElement('Status');
				$child = $occ->appendChild($child);
			
				$value = $doc->createTextNode($row[4]);
				$value = $child->appendChild($value);
				
				//-----------------------------------
				
				$child = $doc->createElement('Item');
				$child = $occ->appendChild($child);
			
				$value = $doc->createTextNode($row[5]);
				$value = $child->appendChild($value);
				
				//-----------------------------------
				
				$child = $doc->createElement('Quantity');
				$child = $occ->appendChild($child);
			
				$value = $doc->createTextNode($row[6]);
				$value = $child->appendChild($value);
				
				//-----------------------------------
				$child = $doc->createElement('Price');
				$child = $occ->appendChild($child);
			
				$value = $doc->createTextNode($row[7]);
				$value = $child->appendChild($value);
				
				//-----------------------------------
				
				$child = $doc->createElement('Total');
				$child = $occ->appendChild($child);
			
				$value = $doc->createTextNode((int)$row[7]*(int)$row[6]);
				$value = $child->appendChild($value);
				
				//-----------------------------------
				
				
				?>
		
				<?$total = (int)$row[7]*(int)$row[6]?>
				<?$totalPrice += $total?>
				<td><label value="$row[1]">
						<?print "<option value=$row[1] name=CustID$x >$row[1]</option>\n";?></td>
				<td><label value="$row[2]">
						<?print "<option value=$row[2] name=AgentID$x >$row[2]</option>\n";?></td>
				<td><label value="$row[3]">
						<?print "<option value=$row[3] name=Date$x >$row[3]</option>\n";?></td>
				<td><label value="$row[4]">
						<?print "<option value=$row[4] name=Status$x >$row[4]</option>\n";?></td>
				<td><label value="$row[5]">
						<?print "<option value=$row[5]name=Item$x >$row[5]</option>\n";?></td>
				<td><label value="$row[6]">
						<?print "<option value=$row[6]name=Quantity$x >$row[6]</option>\n";?></td>
				<td><label value="$row[7]">
						<?echo money_format('$%i', $row[7]);?></td>
				<td><label value="$total">
						<?echo money_format('$%i', $total);?></td>
				</tr>
				<?}?>
		<?}?>
<?			$xml_string = $doc->saveXML();
		$strDoctype = "<!DOCTYPE salesreport SYSTEM \"salesreport.dtd\">";
		$xml_string1 = substr($xml_string, 0, 21);
		$xml_string2 = substr($xml_string, 22, strlen($xml_string));
		$fh = fopen("testXML.xml", 'w') or die("can't open file");  
		fwrite($fh, $xml_string1 . "\n" . $strDoctype . "\n" . $xml_string2);
		fclose($fh);
	
		$dir = dirname($_SERVER['PHP_SELF']);
		if($dir=="\\"){$dir="";}; // addresses file path issue if file is in root directory
		$address = "http://" . $_SERVER["HTTP_HOST"] . $dir . "/testXML.xml";
		print "Success! Your file is available at: <a href=\"" . $address . "\">" . $address . "</a>";
	?>	

	</table>
	</br>
	<h4>
	<center>
		Total Price:&nbsp; <?echo money_format('$%i', $totalPrice);?>
	</center>
	</h4>
	</body>
</html>