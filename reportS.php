<!DOCTYPE HTML SYSTEM>
<html>

<meta name="generator" content="HTML Tidy for Linux (vers 25 March 2009), see www.w3.org">
<link rel="stylesheet" type="text/css" href="hw2.css">
<title>Customer Report</title>

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
<h1>Business Information Technology<br>
Customer Report</h1>
<br>
<br>
<br>
<?php
                $cID= $_SESSION['customerID'];
				$cName= $_POST['CompanyName'];
                $rgion= $_POST['region'];
                $LName= $_POST['LastName'];
                $FName= $_POST['FirstName'];
                $StreetAddress= $_POST['Address'];
                $City= $_POST['City'];
                $State= $_POST['state'];
				$zip= $_POST['Zipcode'];
                $Fax= $_POST['Fax'];
                $Email= $_POST['Email'];
                $Phone= $_POST['Phone'];
                

				
                /*if($fax === "") {
                		$fax = "000-000-0000";
                '}*/

				
?>
<? if (Isset($_POST["time_submit"])){?>
<table>

<tr>
<th>Customer ID:</th>
<td><?php print $cID ?></td>
</tr>
<tr>
<th>CompanyName:</th>
<td><?php print $cName ?></td>
</tr>
<tr>
<th>Region:</th>
<td><?php print $rgion ?></td>
</tr>
<tr>
<th>Last Name:</th>
<td><?php print $LName ?></td>
</tr>
<tr>
<th>First Name:</th>
<td><?php print $FName?></td>
</tr>
<tr>
<th>Street Address:</th>
<td><?php print $StreetAddress ?></td>
</tr>
<tr>
<th>State:</th>
<td><?php print $State ?></td>
</tr>
<tr>
<th>Zipcode:</th>
<td><?php print $zip ?></td>
</tr>
<tr>
<th>City:</th>
<td><?php print $City ?></td>
</tr>
<tr>
<th>Phone:</th>
<td><?php print $Phone ?></td>
</tr>
<th>Fax:</th>
<td><?php print $Fax ?></td>
</tr>
<th>Email:</th>
<td><?php if(filter_var($Email, FILTER_VALIDATE_EMAIL)){
echo $Email;}else{
				echo "Invalid Email Format.";} ?></td>
</tr>
</table>
<? } ?>
<?
$db = mysqli_connect('database.hosting.vt.edu', 'bit444408', 'qalshathseshzodg', 'bit444408') or die ("I cannot connect to the database because: ".mysqli_connect_error()); 
		
		if($db ===false) {
				die("error.".mysqli_connect_error());
		}
		$sql = "UPDATE customer SET cust_lname='".$LName."', cust_fname='".$FName."', cust_address='".$StreetAddress."', cust_city='".$City."', cust_state='".$State."'
		, region_id='".$rgion."', cust_phone='".$Phone."', cust_fax='".$Fax."', cust_email='".$Email."' WHERE cust_id='".$cID."'";
		if (mysqli_query($db, $sql)) 
		{
			echo "Customer Edited successfully<br/>";
		}	 
		else 
		{
			echo "Error: " . mysqli_error($db);
	}	
	mysqli_close($db);
	?>
	
	<form method="post" action="editcustS.php">
		<input type="hidden" name="page" value="home"/>
		</br>
		<input type="submit" value="Return"/>
		
	</form>
</body>

</html>