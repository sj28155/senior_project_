<!DOCTYPE html>
<html>
<head>
<meta name="generator" content="HTML Tidy for Linux (vers 25 March 2009), see www.w3.org">
<link rel="stylesheet" type="text/css" href="hw2.css">
	<script src="validation.js"></script>
	<script src="jquery.js"></script>
<script type="text/javascript">
function form2(form)
	{
		var quantity = document.getElementsByName("quantity")[0].value;
		var uc = document.getElementsByName("UnitPrice")[0].value;
		
		if(isNaN(quantity) || quantity ==""){
		alert("put quantity") 
			return false;
		}
		if(isNaN(uc) || uc ==""){
		alert("put unit price") 
			return false;

	}
	}
	
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
</head>

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


   <? 
$db = mysqli_connect('database.hosting.vt.edu', 'bit444408', 'qalshathseshzodg', 'bit444408') or die ("I cannot connect to the database because: ".mysqli_connect_error()); 
?>
   <?
   $strSQL = "SELECT product_id, product_name FROM product";
   $rs = mysqli_query($db, $strSQL);
   ?>

   <?
   $strSQL4 = "SELECT order_id, status_id, order_date FROM salesorder";
   $rs4 = mysqli_query($db, $strSQL4); 
   ?>

   
<br>
<h1>Piedmont Furnishings<br>
Edit Order Form</h1>
<form name="form1" method="post" action="editOrderM.php" id="form1" >
<fieldset>
<h3>Please provide following information</h3>
<br>
Which order are you going to edit? 
<select name="orderID">
      <? while($row = mysqli_fetch_array($rs4)){ ?>
      <option value="<?= $row[0]?>"><?= $row[0] ?></option>
      <? } ?>
   </select><br><br><br>
<input type="submit" name="submit1" value="Submit">
<input type="reset" value="Reset"></fieldset>
<br><br>
</form>


<?
if(isset($_POST["submit1"])){?>

<form name="form2" method="post" action="EditOrderReportM.php" id="form2" onsubmit= "return form2(this)">
	<? $_SESSION["orderID"] = $_POST["orderID"]; ?>
   <?
   $strSQL2 = "SELECT * FROM salesorder WHERE order_id=" . $_SESSION["orderID"];
   $rs2 = mysqli_query($db, $strSQL2); 
   ?>

   <?
   $strSQL3 = "SELECT item_quantity, item_unitprice, item_linenum, product_id FROM orderitem Where order_id =". $_SESSION["orderID"];
   $rs3 = mysqli_query($db, $strSQL3);
   ?>
   

   <?
   $strSQL5 = "SELECT count(*) FROM orderitem WHERE order_id=" . $_SESSION["orderID"];
   $rs5 = mysqli_query($db, $strSQL5); 
   ?>   
   
   <?
   $strSQL6 = "SELECT order_date, cust_id FROM salesorder WHERE order_id=" . $_SESSION["orderID"];
   $rs6 = mysqli_query($db, $strSQL6); 
   ?>   
   <?
   $strSQL7 = "SELECT status_id, status_type FROM orderstatus";
   $rs7 = mysqli_query($db, $strSQL7); 
   ?>   
   <?
   $strSQL8 = "SELECT * FROM employee";
   $rs8 = mysqli_query($db, $strSQL8); 
   ?>   
   
   
   

   
   <? while($row6 = mysqli_fetch_array($rs6)){ ?>
   Order Date: <input type= "text" name="odate" value="<?= $row6[0] ?>" size="15">
   <br>
 
	Customer ID: <input required name="customer" value="<?= $row6[1] ?>" type="text" size="1"><br>
   
      <? } ?>

	  
	Agent: <select name="agentName">
      <? while($row8 = mysqli_fetch_array($rs8)){ ?>
	  <? if($row[3] == $row8[0]) {?>
         <option value="<?= $row8[0]?>" selected="selected"><?= $row8[0] . ": " . $row8[1] . ", " . $row8[2]?> </option>
		<? } else { ?>
         <option value="<?= $row8[0]?>"><?= $row8[0] . ": " . $row8[1] . ", " . $row8[2]?> </option>
	  <? }} ?>
   </select><br>

	Order Status: <select name="orderStatus">
      <? while($row7 = mysqli_fetch_array($rs7)){ ?>
	  <? if($row[4] == $row7[0]) {?>
         <option value="<?= $row7[0]?>" selected="selected"><?= $row7[0] . ": " . $row7[1]?> </option>
	  <? } else { ?>
      <option value="<?= $row7[0]?>"><?= $row7[0] . ": " . $row7[1] ?> </option>
	  <? }} ?>
   </select>
      
   <br>
<br>
   <table border='1'>
   <tr>
   <th>Order ID</th>
   <th>Product Name</th>
   <th>Quantity</th>
   <th>Unit Price</th>
   <th>Item Line Number</th>
   </tr>
   
   <? while($row = mysqli_fetch_array($rs5)){ ?>
   <? $num = $row[0]; ?>
   <? for($i=1;$i<=$num;$i++){ ?>
   <tr>
   <td>
   <? print $_SESSION["orderID"]; ?>
      <? $row = mysqli_fetch_array($rs3) ?>
   </td>
   <td>
   <select rel="price<?= $i ?>" name="productID<?= $i ?>">
      <? while($row1 = mysqli_fetch_array($rs)){ ?>
      <? if($row1[0] == $row[3]) {?>
         <option value="<?= $row1[0] ?>" selected="selected"><?= $row1[0] . ": " . $row1[1] ?> </option>
      <? } else { ?>
      <option value="<?= $row1[0] ?>"><?= $row1[0] . ": " . $row1[1] ?> </option>
      <? }} ?>
   </select>
   </td>
   <?mysqli_data_seek($rs, 0); ?>
   <td>
   <input required type= "text" name="quantity<?= $i ?>" value="<?= $row[0]?>" size="1">
   </td>
   <td>
   <input required id="price<?= $i ?>" type= "text" name="unitprice<?= $i ?>" value="<?= $row[1]?>" size="15">
   </td>
   <td>
   <input required type= "text" name="itemlinenum<?= $i ?>" value="<?= $row[2]?>" size="1">
   </td>
   </tr>
   <? } ?>
   <? } ?>   

   </table>

   
   
<br><br>
<input type="submit" name="submit2" value="Submit" onsubmit= "return form2(this)">
<input type="reset" value="Reset All">

<?  ?>
</form>
<?} ?>



<? mysqli_free_result($rs);
   mysqli_free_result($rs4);
   mysqli_close($db);   ?>
</body>
</html>