<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="hw2.css">
<title>Piedmont Furnishing [Sales Agent]</title>

</head>
<? session_start();?>
<h5><?print "Hello, " . $_SESSION["name"];?></h5>
<body>


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


<h1>Piedmont Furnishing</h1>
<h2>The website is created for employees to add new customer informations or to edit from the exisitng informations.</br>
Each users require to have specific username and password so they can enter as a Manager or a Sales Agent.</br>
Managers will have access to edit exisitng information, but Sales Agent will have access to read only.</h2>
<br><br><br>


<center>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="hw2.css">

<style>
.mySlides {display:none;}
</style>

<div class="w3-content w3-section" style="max-width:700px">
  <img class="mySlides" src="pic1.jpg" style="width:100%">
  <img class="mySlides" src="pic2.jpg" style="width:100%">
  <img class="mySlides" src="pic3.jpg" style="width:100%">
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 3000);
}
</script>
</br></br>
<h3> Group 8 / TuTh 12:30pm </h3>
<h4> Abby Park, Soojin Jee, Wooyoung Cheon, Hyungbin Ko, Hyerin Song </h4>




</center>
</body>

</html>


