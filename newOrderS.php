<!DOCTYPE html>
<html>
<head>
<meta name="generator" content="HTML Tidy for Linux (vers 25 March 2009), see www.w3.org">
<link rel="stylesheet" type="text/css" href="hw2.css">
	<script src="validation.js"></script>
	<script src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
		$("select").change(function(){
				var x = $("#"+$(this).attr("rel"));
	
				if ($(this).val()==""){
					x.val("");
				return;
			}else{
				x.load("AJAX.php?q="+$(this).val(), function(responseTxt){
					x.val(responseTxt);
				});			
			};
			
		});
});
</script>
<title>Piedmont Furnishings Customer</title>
<script src="validation.js"></script>	
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



	<? 
	$db = mysqli_connect('database.hosting.vt.edu', 'bit444408', 'qalshathseshzodg', 'bit444408') or die ("I cannot connect to the database because: ".mysqli_connect_error()); 
	?>
	<?
	$strSQL = "SELECT product_id FROM product";
	$rs = mysqli_query($db, $strSQL);
	?>
	<?
	$strSQL2 = "SELECT status_type FROM orderstatus";
	$rs2 = mysqli_query($db, $strSQL2); 
	?>
	<? 
	$strSQL3 = "SELECT * FROM employee";
	$rs3 = mysqli_query($db, $strSQL3);
	?>
	<?
	$strSQL4= "select cust_id from customer";
	$rs4 = mysqli_query($db, $strSQL4);
	?>
	
	
<br>
<h1>Piedmont Furnishings<br>
New Order Form</h1>
<h3>Please provide following information</h3>
<form name="form1" method="post" action="newOrderS.php" id="form1"  onsubmit= "return required(this)">
<fieldset>
How many items? <input required name="numitem" type="text" size="15"><br><br><br>
<input type="submit" name="submit1" value="Submit" >
<input type="reset" value="Reset"></fieldset>
<br><br>
</form>

		<?try{
			$newID = 101;
			$rndSQL = "Select order_id FROM orderitem WHERE order_id = ".$newID;
			while(mysqli_num_rows(mysqli_query($db, $rndSQL)) > 0){
				echo "<script>console.log($newID)</script>";
				$newID++;
				$rndSQL = "Select order_id FROM orderitem WHERE order_id =". $newID;
			}
			if(!$rndSQL){throw new Exception("Could not get values from cust_id in the database.");}
		}
		catch (Exception $e){
	
			// redirect to a custom error page (PHP or ASP.NET or …)
			header("Location: error.php?msg=" . $e->getMessage() . "&line=" . $e->getLine());
	
		}
		?>
    <?$today = date("F j, Y");?>
    <form name="orderform" method="post" action="OrderReportS.php" >


<?
if(isset($_POST["submit1"])){?>

<form name="form2" method="post" action="OrderReportS.php" id="form2" onsubmit="return form2(this)">
Order ID:  
			<td><label><?=$newID?></label>
			<input type='hidden' name="orderid"  value=<?=$newID?>> <br>
			<br>
Order Date: <input required name="odate" type="date" size="15" value="<?=$today?>"/><br>
<br />
Customer:<select name="customer">
		<? while($row = mysqli_fetch_array($rs4)){ ?>
		<option value="<?= $row[0]?>"><?= $row[0] ?></option>
		<? } ?>
	</select>
<br><br>
Agent: 
	<select name="agentName">
		<? while($row = mysqli_fetch_array($rs3)){ ?>
		<option value="<?= $row[0]?>"><?= $row[1] . ", " . $row[2]?></option>
		<? } ?>
	</select>

	
	<br><br>
	
	<?
	$rows = $_POST["numitem"];
	$cols = 3;

	echo "<table border='1'>";
	echo "<tr>
	<th>Product ID</th>
	<th>Quantity</th>
	<th>Unit Price</th>
	</tr>";
		
	
	for($tr=1;$tr<=$rows;$tr++){

		echo "<tr>";?>
	<td>
	<select rel="price<?= $tr ?>" name="productID<?= $tr ?>" >
		<? while($row = mysqli_fetch_array($rs)){ ?>
		<option value="<?= $row[0]?>"><?= $row[0] ?></option>
		<? } ?>
	</select>
	</td>
	<?mysqli_data_seek($rs, 0); ?>
	<td>
		<input required name="quantity<?= $tr ?>" type="integer" size="15">
	</td>
		<td>
		
		<input required id="price<?= $tr ?>" name="UnitPrice<?= $tr ?>" value= <?$calculate?> type="integer" size="15">
	</td>
	

	<?	echo "</tr>";
	}

	echo "</table>";?>
<br><br>
<input type="hidden" name="itemnum" value="<?= $rows ?>">
<input type="submit" name="submit2" value="Submit"> <input type="reset" value="Reset All" onsubmit = "return form2(this)"></fieldset>
</form>

<?}	?>
<? mysqli_free_result($rs);
	mysqli_free_result($rs2);
	mysqli_close($db);   ?>
	
	
	
</body>
</html>