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
Edit Customer Form</h1>
<br>


<? 

$db = mysqli_connect('database.hosting.vt.edu', 'bit444408', 'qalshathseshzodg', 'bit444408') or die ("I cannot connect to the database because: ".mysqli_connect_error()); 
$strSQL1 = "SELECT cust_id FROM customer ORDER BY cust_id ASC";
$rs = mysqli_query($db, $strSQL1); 


?>

<form name="form1" method="post" action="editcustM.php" >
<fieldset name="fieldset1">
	 Customer ID:&nbsp; <select name="custID">
		<? while($row = mysqli_fetch_array($rs)){ ?>
		<option value="<?= $row[0]?>"><?= $row[0] ?></option>
		<? } ?>
	</select>
      <br>
<br>
<input type="submit" name="submit1" value="Submit">
<br>
</form>

<br>
<?
if(isset($_POST["submit1"])){
    $_SESSION["customerID"] = $_POST["custID"];
	$strSQL1 = "SELECT cust_id, cust_fname, cust_lname, cust_address, cust_zip, cust_company, cust_city, cust_email, cust_state, cust_fax, cust_phone, region_name FROM customer, region WHERE customer.region_id = region.region_id AND cust_id=" . $_POST["custID"];
	$rs1 = mysqli_query($db, $strSQL1) or die("Error in SQL statement: " . mysqli_error());  // recordset	
	if($row = mysqli_fetch_array($rs1)){
?>
<form name="form2" method="post" action="reportM.php" onsubmit="return validation()">
<fieldset name="fieldset2">
<br>

<?
$strSQL3 = "SELECT region_name, region_id FROM region ORDER BY region_name ASC";
$rs3 = mysqli_query($db, $strSQL3) or die("Error in SQL statement: ".mysqli_error());

?>

     Company Name: <input type="text" name="CompanyName" value="<?= $row["cust_company"]?>">

	 Region: &nbsp;
 <select name="region">
<? while($row2 = mysqli_fetch_array($rs3)){ ?>
  <? if($row2[1] == $row[9]) {?>
         <option value="<?= $row2[1]?>" selected="selected"><?= $row2[0] ?> </option>
      <? } else { ?>
      <option value="<?= $row2[1]?>"><?= $row2[0] ?> </option>
      <? }} ?>
</select>

		
<br>
<br>
   <legend>Contact Information: 
   </legend>
     Last Name: <input type="text" name="LastName" value="<?= $row["cust_lname"]?>">
     First Name: <input type="text" name="FirstName" value="<?= $row["cust_fname"]?>">
<br>
<br>
     Street Address: &nbsp;
      <input required type="text" name="Address" value="<?= $row["cust_address"]?>">
<br>
<br>
     State: &nbsp;
  <select name="state">
         <option value="<?= $row[8]?>" selected="selected"><?= $row[8] ?> </option>
		<option value="AL" >AL</option>
		<option value="AK">AK</option>
		<option value="AK">AK</option>
		<option value="AR">AR</option>
		<option value="CA">CA</option>
		<option value="CO">CO</option>
		<option value="CT">CT</option>
		<option value="DE">DE</option>
		<option value="DC">DC</option>
		<option value="FL">FL</option>
		<option value="GA">GA</option>
		<option value="HI">HI</option>
		<option value="ID">ID</option>
		<option value="IL">IL</option>
		<option value="IN">IN</option>
		<option value="IA">IA</option>
		<option value="KS">KS</option>
		<option value="KY">KY</option>
		<option value="LA">LA</option>
		<option value="ME">ME</option>
		<option value="MD">MD</option>
		<option value="MA">MA</option>
		<option value="MI">MI</option>
		<option value="MN">MN</option>
		<option value="MS">MS</option>
		<option value="MO">MO</option>
		<option value="MT">MT</option>
		<option value="NE">NE</option>
		<option value="NV">NV</option>
		<option value="NH">NH</option>
		<option value="NJ">NJ</option>
		<option value="NM">NM</option>
		<option value="NY">NY</option>
		<option value="NC">NC</option>
		<option value="ND">ND</option>
		<option value="OH">OH</option>
		<option value="OK">OK</option>
		<option value="OR">OR</option>
		<option value="PA">PA</option>
		<option value="RI">RI</option>
		<option value="SC">SC</option>
		<option value="SD">SD</option>
		<option value="TN">TN</option>
		<option value="TX">TX</option>
		<option value="UT">UT</option>
		<option value="VT">VT</option>
		<option value="VA">VA</option>
		<option value="WA">WA</option>
		<option value="WV">WV</option>
		<option value="WI">WI</option>
		<option value="WY">WY</option>
</select>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	 Zipcode:
         <input required type="text" name="Zipcode" value="<?= $row["cust_zip"]?>">

    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     City: &nbsp;
      <input required type="text" name="City" value="<?= $row["cust_city"]?>">
&nbsp;&nbsp;
<br>
<br>
     Phone: &nbsp; 
      <input required type="text" name="Phone" value="<?= $row["cust_phone"]?>">
		&nbsp;&nbsp;
     Fax: &nbsp; 
      <input required type="text" name="Fax" value="<?= $row["cust_fax"]?>">
      &nbsp;&nbsp;
     Email: &nbsp; 
      <input required type="text" name="Email" value="<?= $row["cust_email"]?>">
	  
	<? } ?>
<? } ?>
</fieldset>

<br>
<input required type="submit" name="time_submit" value="Submit"> <input required type="reset" value="Reset All">

</fieldset>



</form>
</body>
</html>

