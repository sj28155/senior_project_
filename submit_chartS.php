<? 
session_start();
$_SESSION["emp_id"] = $_POST["emp_id"];
$_SESSION["category"] = $_POST["category_name"];

if(isset($_POST["pie"])){
   header ('Location: pie_chartS.php');
}elseif(isset($_POST["bar"])){
   header ('Location: bar_chartS.php');
}else{
   header ('Location: column_chartS.php');
}
?>