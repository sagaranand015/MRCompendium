<?php 

// this is the file for all the AJAX requests that will be made from the client.

//these are for the PHP Helper files
include('headers/databaseConn.php');
include('helpers.php');

if(isset($_GET["no"]) && $_GET["no"] == "1") {
	SendMessage($_GET["name"], $_GET["email"], $_GET["phone"], $_GET["message"]);
}

// this is the function to send the contact message from the user.
function SendMessage($name, $email, $phone, $message) {
	$response = "-1";
	try {
		$date = date("Y-m-d H:i:s");
		$query = "insert into ContactUs(Name, Email, Phone, Message, UpdatedOn) values('$name', '$email', '$phone', '$message', '$date')";
		$rs = mysql_query($query);
		if(!$rs) {
			$response = "-1";
		}
		else {
			$response = "1";
		}
		echo $response;
	}
	catch(Exception $e) {
		$response = "-1";
		echo $response;
	}
}

?>

