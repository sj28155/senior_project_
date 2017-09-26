<? require_once("connect_to_DB.php");  // connect to furniture database
// ###################### retrieve data from database #################
connectDB();  
$sql = "SELECT 1.20 * product_cost FROM product WHERE product_id ='" . $_REQUEST["q"] . "' ";

try{
$result = @mysqli_query($db, $sql) or die("SQL error: " . mysqli_error());  
// ############################################################### 
		if(!$result){throw new Exception("Could not connect to Database.");}
	}
	catch (Exception $e){
		// redirect to a custom error page (PHP or ASP.NET or …)
		header("Location: error.php?msg=" . $e->getMessage() . "&line=" . $e->getLine());
	}
$row = mysqli_fetch_array($result);
print $row[0];
mysqli_close($db);
?>