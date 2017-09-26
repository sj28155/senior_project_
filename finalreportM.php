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
<?  require_once("connect_to_DB.php");
$outputFile = "testFile_Manager" . date("m-d-Y") . ".html";  // Dynamically names the new file
// Opens a file with this name to which to write the HTML on the server
$fh = fopen($outputFile, 'w') or die("can't open file");  // 'w' writes over any old data and creates a new file if the file doesn't already exist
// You can format the final output by including appropriate \n and \t characters in the text string
// Breaking the string you are building into pieces can also be helpful for keeping track of it....
$strOut = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
// append the next set of tags and text onto the existing string
$strOut .= "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";  
$strOut .= "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n\t<head>\n\t\t<title>Dynamic HTML example</title>\n\t</head>\n";
$strOut .= "\t<body>";
// ** Get data from the database and load it into an HTML table, within the string you are building **
try{
connectDB();
$salesOrder = "SELECT order_id, cust_id, emp_id, order_date, status_id FROM salesorder";
$result = @mysqli_query($db, $salesOrder) or die("Error in SQL error: " . mysqli_error());  // create the appropriate recordset
$orderSQL = "SELECT item_quantity, product_id, item_unitprice FROM orderitem";
$rt = @mysqli_query($db, $orderSQL)  or die("Error in SQL statement: " . mysqli_error());
  
} catch (Exception $e){
	// redirect to a custom error page (PHP or ASP.NET or …)
	header("Location: error.php?msg=" . $e->getMessage() . "&line=" . $e->getLine());
}
$strOut .= "\n\t\t<table>";
$strOut .= "\n\t\t\t<tr><td>" . "Order ID" . "</td><td>" . "Customer ID" . "</td><td>" . "Employee ID" . "</td><td>" . "Order Date" . "</td><td>" . "Status ID" . "</td></tr>";
while($row = mysqli_fetch_array($result)){  // retrieve each row of the recordset in turn
$strOut .= "\n\t\t\t<tr><td>" . $row["order_id"] . "</td><td>" . $row["cust_id"] . "</td><td>" . $row["emp_id"] . "</td><td>" . $row["order_date"] . "</td><td>" . $row["status_id"] . "</td></tr>";
}
$strOut .= "\n\t\t</table>";
$strOut .= "\n\t\t<table>";
$strOut .= "\n\t\t\t<tr><td>" . "Item Quantity" . "</td><td>" . "Product ID" . "</td><td>" . "Item Price" . "</td><td>" . "</td></tr>";
while($row = mysqli_fetch_array($rt)){  // retrieve each row of the recordset in turn
$strOut .= "\n\t\t\t<tr><td>" . $row["item_quantity"] . "</td><td>" . $row["product_id"] . "</td><td>" . $row["item_unitprice"] . "</td></tr>";
}
$strOut .= "\n\t\t</table>";
mysqli_close($db);  // Always close the database connection
//***************************************************************************
$strOut .= "\n\t</body>\n</html>";
fwrite($fh, $strOut);  // Write the text string to the dynamically-named text file on the server
fclose($fh);  // Close the connection to the text file
$dir = dirname($_SERVER['PHP_SELF']);
if($dir=="\\"){$dir="";}; // addresses file path issue if file is in root directory
$address = "http://" . $_SERVER["HTTP_HOST"] . $dir . "/" . $outputFile;
print "Success! Your file is available at: <a href=\"" . $address . "\">" . $address . "</a>";
?>
<? 
$db = mysqli_connect('database.hosting.vt.edu', 'bit444408', 'qalshathseshzodg', 'bit444408') or die ("I cannot connect to the database because: ".mysqli_connect_error()); 
$strSQL1 = "SELECT emp_id FROM employee WHERE job_id = 4 ORDER BY emp_id ASC";
$rs = mysqli_query($db, $strSQL1);  // recordset

$strSQL2 = "SELECT category_name FROM category";
$rs1 = mysqli_query($db, $strSQL2);  // recordset
?>

<form name="form1" method="post" action="submit_chartM.php">

<br>
Select Employee ID: 
<select name="emp_id">
      <? while($row = mysqli_fetch_array($rs)){ ?>
      <option value="<?= $row[0]?>"><?= $row[0] ?></option>
      <? } ?>
   </select>
   <br><br><br>
   Select Category: 
   <select name="category_name">
      <? while($row = mysqli_fetch_array($rs1)){ ?>
      <option value="<?= $row[0]?>"><?= $row[0] ?></option>
      <? } ?>
   </select><br><br><br>
<input type="submit" name="pie" value="Pie Chart">
<input type="submit" name="bar" value="Bar Chart">
<input type="submit" name="column" value="Column Chart">
<br><br>
</form>
</body>
</html>







