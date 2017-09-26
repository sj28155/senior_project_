<? 
function connectDB() {   // ***** Database access *****
global $db;  // makes this variable available outside of just the scope of this function
$db = mysqli_connect('database.hosting.vt.edu', 'bit444408', 'qalshathseshzodg', 'bit444408') or die ("I cannot connect to the database because: ".mysqli_connect_error());   // connect to the database server 
} 
?>
