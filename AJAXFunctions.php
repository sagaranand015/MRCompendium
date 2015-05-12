<?php 

// this is the file for all the AJAX requests that will be made from the client.

//these are for the PHP Helper files
include('headers/databaseConn.php');
include('helpers.php');

if(isset($_GET["no"]) && $_GET["no"] == "1") {
	SendMessage($_GET["name"], $_GET["email"], $_GET["phone"], $_GET["message"]);
}
else if(isset($_GET["no"]) && $_GET["no"] == "2") {   // to check if user exits in the user table.
	CheckUserSignup($_GET["name"], $_GET["email"]);
}
else if(isset($_GET["no"]) && $_GET["no"] == "3") {   // to check if user exits in the Register table.
	CheckUserRegistrationAndVerification($_GET["name"], $_GET["email"]);
}
else if(isset($_GET["no"]) && $_GET["no"] == "4") {   // to check if user exits in the Register table for logging in functionality.
	CheckUserRegistrationAndVerification($_GET["name"], $_GET["email"]);
}
else if(isset($_GET["no"]) && $_GET["no"] == "5") {   // to check if the coupon code exists in the database table or not!
	CheckCoupon($_GET["code"]);
}
else if(isset($_POST["no"]) && $_POST["no"] == "6") {   // to insert/update the userEmail and userName in the Register table.
	UserRegister($_POST["signemail"], $_POST["signname"], $_POST["signpwd"]);
}
else if(isset($_GET["no"]) && $_GET["no"] == "7") {   // for authentication of password from the Resgiter table during login.
	AuthenticateUser($_GET["email"], $_GET["pwd"]);
}
else if(isset($_GET["no"]) && $_GET["no"] == "8") {   // for adding the user to Users table for invite requests.
	AddToInvites($_GET["email"], $_GET["name"], "1");    // 1 is for indicating that the user has requested the invite himself.
}

// this is the function to add the user to Users table for requesting invites.
// returns 1 on all success. 2 on insert success and mail failure. -1 on Error and all failures.
function AddToInvites($email, $name, $isRequest) {
	$response = "-1";
	$date = date("Y-m-d H:i:s");
	$mailBody = "";
	$subject = "MR - Compendium Invitation Received";
	try {
		$query = "insert into Users(Name, Email, IsRequest, UpdatedOn) values('$name', '$email', '$isRequest', '$date')";
		$rs = mysql_query($query);
		if(!$rs) {
			$response = "-1";
		}
		else {
			// write the mail body here.
			$mailBody .= "<h1>MR - Compendium Invitation</h1><br />";
			$mailBody .= "Dear " . $name . "<br />";
			$mailBody .= "Your Invite Code for MR - Compendium Access is: <b>testCoupon</b>. Please go ahead and use this code on <code>http://mentored-research.com/Compendium</code> to activate your Compendium Account.<br />";

			$mailBody .= "<br /><br />Thank You.";
			$mailBody .= "<br />MR - Compendium";
			$mailBody .= "<br /><a href='http://mentored-research.com'>Mentored-Research</a>";

			if(SendRequestInviteMail("guide@mentored-research.com", $email, $subject, $mailBody) == "1") {
				$response = "1";
			}
			else {
				$response = "2";
			}
		}
		echo $response;
	}
	catch(Exception $e) {
		$response = "-1";
		echo $response;
	}
}

// this is the function to authenticate the user from the Register table.
function AuthenticateUser($email, $pwd) {
	$response = "-1";
	try {
		$response = AuthenticateUserRegister($email, $pwd);
		echo $response;
	}
	catch(Exception $e) {
		$response = "-1";
		echo $response;
	}
}

// this is the function to insert/update the user in the register table.
// returns 1 if evrything is successful. returns 2 if user is inserted but cannot be verified. returns 3 if the user cannot be inserted. -1 on error.
function UserRegister($email, $name, $pwd) {
	$response = "-1";
	try {
		if(CheckUserRegister($email) == "1") {   // user exists. Update the IsVerified here.
			if(VerifyUserRegister($email) == "1") {
				$response = "1";
			}
			else {
				$response = "2";
			}
		}
		else if(CheckUserRegister($email) == "0") {   // user does not exists.
			$in = InsertUserRegister($email, $name, $pwd);
			if($in == "1") {
				$ver = VerifyUserRegister($email);
				if($ver == "1") {
					$response = "1";
				}
				else {
					$response = "2";
				}
			}
			else {
				$response = "3";
			}
		}
		else {   // error condition!
			$response = "-1";
		}
		echo $response;
	}
	catch(Exception $e) {
		$response = "-1";
		echo $response;
	}
} 

// this is the function to check coupon existance and coupon validity!
// returns 1 if the coupon exists and is valid. 2 if the coupon does not exist. 3 if an invalid coupon exists. -1 on error.
function CheckCoupon($code) {
	$response = "-1";
	try {
		$response = CheckCouponCode($code);
		echo $response;
	}
	catch(Exception $e) {
		$response = "-1";
		echo $response;
	}
}

// this is the function to check if the user exists in the Register table. and is verified or not
// returns 0 if the user does not exits. -1 if the user is not verified. 1 if verified. -2 on Error.
function CheckUserRegistrationAndVerification($name, $email) {
	$response = "-2";
	try {
		if(CheckUserRegister($email) == "0") {   // user does not exist.
			$response = "0";  // user does not exist.
		}
		else if(CheckUserRegister($email) == "1") {  // user exists.
			if(CheckUserVerification($email) == "0") {  // not verfied user.
				$response = "-1";
			}
			else if(CheckUserVerification($email) == "1") {   // verified user.
				$response = "1";
			}	
			else {   // error.
				$response = "-2";
			}
		}
		else {   // error condition.
			$response = "-2";
		}
		echo $response;
	}
	catch(Exception $e) {
		$response = "-2";
		echo $response;
	}
}

// this is the function to check if the user exisrs in the Users Table. If the user has been invited or not!
function CheckUserSignup($name, $email) {
	$response = "-2";   // -2 on error.
	try {
		$res = CheckEmailUsers($email);
		if($res == "1") {   // the user email does not exists in the Users table.
			$response = "-1";
		}
		else if($res == "2") {   // user exists in the Users table. Only once!
			$response = "1";
		}
		else if($response == "3") {   // user email exists more than once.
			$response = "-3";
		}
		else {
			$response = "-1";
		}
		echo $response;
	}
	catch(Exception $e) {
		$response = "-2";   // -2 on error.
		echo $response;
	}
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

