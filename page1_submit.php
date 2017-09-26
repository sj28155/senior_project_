<!DOCTYPE html>
<html>
<head><title>Piedmont Furnishings Login</title></head>
<br /><br /><br />
<body>

<? 
	$username = $_POST['user'];
	$password = $_POST['pass'];
	
	$username = stripcslashes($username);
	$password = stripcslashes($password);
	
	

	mysql_connect('database.hosting.vt.edu', 'bit444408', 'qalshathseshzodg', '');
	mysql_select_db("bit444408");
	
	$result = mysql_query("select * from employee where emp_username = '$username'  and emp_pword = '$password'") or die("Failed to query database ".mysql_error());
	$row = mysql_fetch_array($result);
	if ($row['emp_username'] == $username && $row['emp_pword'] == $password ){
		session_Start();
		$_SESSION["name"] = $row['emp_fname'] . " " . $row['emp_lname'];
		$_SESSION["empid"] = $row['emp_id']; 
		if ($row['job_id'] == 1 || $row['job_id'] == 2) {
			header('Location: manager.php');
		}else{
		header('Location: sales.php'); }

	}elseif ($row['emp_username'] !== $username && $row['emp_pword'] !== $password) { ?>
	<center><h2>Wrong Password! Two attempt left.<br />
	<form method="POST" action="page2_submit.php">
	Username: <input type="text" id="user" name="user"><br />
	Password: <input type="password" id="pass" name="pass"><br /><br />
	<input type="submit" name="page2_submit" value="Login" />
	<input type="reset" value="RESET" /><br />
	</form>
	<?php exit; ?>
	<?php }?>
</body>
</html>