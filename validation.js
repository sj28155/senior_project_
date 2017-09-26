
function validation() {
	var company = document.getElementsByName("CompanyName")[0].value;
	var lname = document.getElementsByName("LastName")[0].value;
	var fname = document.getElementsByName("FirstName")[0].value;
	var address = document.getElementsByName("Address")[0].value;
	var city = document.getElementsByName("City")[0].value;
	var state = document.getElementsByName("State")[0].value;
	var zip = document.getElementsByName("Zipcode")[0].value;
	var phone = document.getElementsByName("Phone")[0].value;
	var fax = document.getElementsByName("Fax")[0].value;
	var email = document.getElementsByName("Email")[0].value;
	
	if(company == null || company== ""){
		alert("Company Name is missing");
		return false;
	}  
	
	if(lname == null || lname== ""){
		alert("Last Name is missing");
		return false;
	}
	if(fname == null ||fname== ""){
		alert("First Name is missing");
		return false;
	}
	if(address == null || address== ""){
		alert("Address is missing");
		return false;
	}
	if(city == null || city== ""){
		alert("City is missing");
		return false;
	}
	if(zip == null || zip== "" ){
		alert("Zip code is missing");
		return false;
	}
	if(isNaN(zip)) {
		alert(" Must be in numbers");
		return false;
	}
	if(phone == null || phone== ""){
		alert("Phone number is missing");
		return false;
	}
	if(isNaN(phone)){
		alert("Phone number must be in numbers");
		return false;
	}
	if(fax === null || fax== ""){
		alert("Fax number is missing");
		return false;
	}
	if(isNaN(fax)) {
		alert("Fax number must be in numbers");
		return false;
	}
	if(email === null || email== ""){
		alert("Email address is missing");
		return false;
	}
}  

	//customer ID check limitaiton
	//region and state listbox check
	//other data type format (not necesary thru javascript)
