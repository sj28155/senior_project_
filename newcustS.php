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

<h1> Piedmont Furnishings<br>
New Customer Form</h1>
<br>
<form name = "Form1" form method="post" action="reportNS.php" onsubmit="return validation()">

<fieldset name="fieldset1">
<? 
	$db = mysqli_connect('database.hosting.vt.edu', 'bit444408', 'qalshathseshzodg', 'bit444408') or die ("I cannot connect to the database because: ".mysqli_connect_error()); 
	?>

		<?try{
			$newID = 1;
			$rndSQL = "Select cust_id FROM customer WHERE cust_id = ".$newID;
			while(mysqli_num_rows(mysqli_query($db, $rndSQL)) > 0){
				echo "<script>console.log($newID)</script>";
				$newID++;
				$rndSQL = "Select cust_id FROM customer WHERE cust_id =". $newID;
			}
			if(!$rndSQL){throw new Exception("Could not get values from cust_id in the database.");}
		}
		catch (Exception $e){
	
			// redirect to a custom error page (PHP or ASP.NET or …)
			header("Location: error.php?msg=" . $e->getMessage() . "&line=" . $e->getLine());
	
		}
		?>
	Customer ID:  
			<td><label><?=$newID?></label>
			<input type='hidden' name="custID"  value=<?=$newID?>> <br>
			<br>
	Company Name: &nbsp; <input required type="text" name="CompanyName">
<br>
<br>
	Region: &nbsp; <select name="region">
		<option value="6" selected>International</option>
		<option value="1">NorthEast</option>
		<option value="2">SouthEast</option>
		<option value="3">MidWest</option>
		<option value="4">SouthWest</option>
		<option value="5">NorthWest</option>
	</select>
<br>
<br>


<fieldset name="fieldset2">
	<legend>Contact Information:
	</legend>
		Last Name: &nbsp; <input required type="text" name="LastName"> 
		First Name: &nbsp; <input required type="text" name="FirstName">
<br>
<br>
	Street Address: &nbsp;
		<input required type="text" name="Address">
<br>
<br>
	State: &nbsp; <select name="State">
		<option value="AL" selected>Alabama</option>
		<option value="AK">Alaska</option>
		<option value="AZ">Arizona</option>
		<option value="AR">Arkansas</option>
		<option value="CA">California</option>
		<option value="CO">Colorado</option>
		<option value="CT">Connecticut</option>
		<option value="DE">Delaware</option>
		<option value="DC">District Of Columbia</option>
		<option value="FL">Florida</option>
		<option value="GA">Georgia</option>
		<option value="HI">Hawaii</option>
		<option value="ID">Idaho</option>
		<option value="IL">Illinois</option>
		<option value="IN">Indiana</option>
		<option value="IA">Iowa</option>
		<option value="KS">Kansas</option>
		<option value="KY">Kentucky</option>
		<option value="LA">Louisiana</option>
		<option value="ME">Maine</option>
		<option value="MD">Maryland</option>
		<option value="MA">Massachusetts</option>
		<option value="MI">Michigan</option>
		<option value="MN">Minnesota</option>
		<option value="MS">Mississippi</option>
		<option value="MO">Missouri</option>
		<option value="MT">Montana</option>
		<option value="NE">Nebraska</option>
		<option value="NV">Nevada</option>
		<option value="NH">New Hampshire</option>
		<option value="NJ">New Jersey</option>
		<option value="NM">New Mexico</option>
		<option value="NY">New York</option>
		<option value="NC">North Carolina</option>
		<option value="ND">North Dakota</option>
		<option value="OH">Ohio</option>
		<option value="OK">Oklahoma</option>
		<option value="OR">Oregon</option>
		<option value="PA">Pennsylvania</option>
		<option value="RI">Rhode Island</option>
		<option value="SC">South Carolina</option>
		<option value="SD">South Dakota</option>
		<option value="TN">Tennessee</option>
		<option value="TX">Texas</option>
		<option value="UT">Utah</option>
		<option value="VT">Vermont</option>
		<option value="VA">Virginia</option>
		<option value="WA">Washington</option>
		<option value="WV">West Virginia</option>
		<option value="WI">Wisconsin</option>
		<option value="WY">Wyoming</option>
	</select>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	City: &nbsp;
		<input required type="text" name="City">
&nbsp;&nbsp;
	ZIP: &nbsp; 
		<input required type="text" name="Zipcode">

<br>
<br>
	Phone: &nbsp; 
		<input required type="text" name="Phone">

	Fax: &nbsp; 
		<input required type="text" name="Fax">
		&nbsp;&nbsp;
	Email: &nbsp; 
		<input required type="text" name="Email">
</fieldset>
<br>
<input required type="submit" name="time_submit" value="Submit"> 
<input required type="reset" value="Reset All">

</fieldset>
</form>
</body>
</html>

