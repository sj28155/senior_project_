<? // ###################### retrieve data from database #################
$db = mysqli_connect('localhost', 'student', 'student', 'furnish') or die ("I cannot connect to the database because: " . mysqli_error());
$sql = "SELECT DISTINCT Customer.cust_id as id, CONCAT(cust_fname, \" \" , cust_lname) AS name FROM Customer, SalesOrder WHERE Customer.cust_id = SalesOrder.cust_id AND SalesOrder.emp_id = " . $_REQUEST["q"] . " ORDER BY id";
$result = mysqli_query($db, $sql) or die("SQL error: " . $sql . " " . mysqli_error());  
// ###############################################################
while($row = mysqli_fetch_array($result)){
print "<option value =\"" . $row[0] . "\">" . $row[1] . "</option>\n";
};
mysqli_close($db);
?>  
