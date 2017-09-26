<? 
// In an actual application, you would typically format this page to be consistent with
//        the design of your site

print "Error message: " . $_GET["msg"];
if(isset($_GET["line"])){
	print " - line number: " . $_GET["line"]; 
}
?>
