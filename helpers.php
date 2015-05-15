<?php 

// this is the file for all the helper functions used in compendium

//these are for the PHP Helper files
include 'headers/databaseConn.php';

//this is the function to send the mail to the user who requested the connection, as a confirmation.
function SendRequestInviteMail($to, $toName) {
	$res = "-1";
	$mailBody = "";
	try{

		$subject = "MR - Compendium Invitation Received";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: guide@mentored-research.com" . "\r\n";
		// write the mail body here.
		$mailBody .= "<h1>MR - Compendium Invitation</h1><br />";
		$mailBody .= "Dear " . $toName . "<br />";
		$mailBody .= "Your Invite Code for MR - Compendium Access is: <b>testCoupon</b>. Please go ahead and use this code on <code>http://mentored-research.com/Compendium</code> to activate your Compendium Account.<br />";

		$mailBody .= "<br /><br />Thank You.";
		$mailBody .= "<br />MR - Compendium";
		$mailBody .= "<br /><a href='http://mentored-research.com'>Mentored-Research</a>";

		if(mail($to, $subject, $mailBody, $headers) == true) {
			$res = "1";
		}
		else {
			$res = "-1";	
		}
		return $res;
	}	
	catch(Exception $e) {
		$res = "-1";
		return $res;
	}
}

// this is the function to authenticate the user from Register table.
function AuthenticateUserRegister($email, $pwd) {
	$resp = "-1";
	try {
		$query = "select * from Register where UserEmail='$email'";
		$rs = mysql_query($query);
		if(!$rs) {
			$resp = "-1";
		}
		else {
			if(mysql_num_rows($rs) == "1") {
				$res = mysql_fetch_array($rs);
				if($res["UserPwd"] == $pwd) {
					$resp = "1";
				}
				else {
					$resp = "0";
				}
			}
		}
		return $resp;
	}
	catch(Exception $e) {
		$resp = "-1";
		return $resp;
	}
}

// this is the function to insert and Verify the user in the Register table.
function InsertUserRegister($email, $name, $pwd) {
	$resp = "-1";
	$date = date("Y-m-d H:i:s");

	if($pwd == "") {
		$pwd = generateRandomPassword();
	}

	try {
		$query = "insert into Register(UserName, UserEmail, UserContact, UserPwd, IsVerified, IsPaid, UpdatedOn) values('$name', '$email', '', '$pwd', '0', '0', '$date')";
		$rs = mysql_query($query);
		if(!$rs) {
			$resp = "-1";
		}
		else {
			$resp = "1";
		}
		return $resp;
	}
	catch(Exception $e) {
		$resp = "-1";
		return $resp;
	}
}

// this is the function to verify the user in the Register table.
function VerifyUserRegister($email) {
	$resp = "-1";
	try {
		$query = "update Register set IsVerified='1' where UserEmail='$email' and IsVerified='0'";
		$rs = mysql_query($query);
		if(!$rs) {
			$resp = "-1";
		}
		else {
			$resp = "1";
		}
		return $resp;
	}
	catch(Exception $e) {
		$resp = "-1";
		return $resp;
	}
}

// this is the function to check coupon validity!!
// returns 1 if the coupon is valid. 0 if invalid. -1 on error.
function IsCouponValid($code) {
	$resp = "-1";
	try {
		$query = "select * from Coupons where CouponCode='$code'";
		$rs = mysql_query($query);
		if(!$rs) {
			$resp = "-1";
		}
		else {
			if(mysql_num_rows($rs) == 1) {
				while ($res = mysql_fetch_array($rs)) {
					if($res["IsValid"] == "1") {
						$resp = "1";
					}
					else {
						$resp = "0";
					}
				}
			}   // end of if.
			else {
				$resp = "0";
			}
		}
		return $resp;
	}
	catch(Exception $e) {
		$resp = "-1";
		return $resp;
	}
}

// this is the function to check coupon existence and validity!
// returns 1 if the coupon exists and is valid. 2 if the coupon does not exist. 3 if an invalid coupon exists. -1 on error.
function CheckCouponCode($code) {
	$resp = "-1";
	try {

		if(IsCouponValid($code) == "1") {
			$query = "select * from Coupons where CouponCode='$code'";
			$rs = mysql_query($query);
			if(!$rs) {
				$resp = "-1";
			}
			else {
				if(mysql_num_rows($rs) == 0) {   // coupon does not exists.
					$resp = "2";
				}
				else if(mysql_num_rows($rs) >= 1) { 
					$resp = "1";   // coupon  exists and valid.
				}
				else {
					$resp = "-1";
				}
			}
		}
		else if(IsCouponValid($code) == "0") {
			$resp = "3";
		}
		else {
			$resp = "-1";
		}
		return $resp;
	}
	catch(Exception $e) {
		$resp = "-1";
		return $resp;
	}
}

// this is the function to check if the user is verified or not.
// returns 0 if the user is not verified. 1 if verified. -1 on error.
function CheckUserVerification($email) {
	$resp = "-1";
	try {
		$query = "select * from Register where UserEmail='$email'";
		$rs = mysql_query($query);
		if(!$rs) {
			$resp = "-1";
		}
		else {
			while($res = mysql_fetch_array($rs)) {
				$resp = $res["IsVerified"];
			}
		}
		return $resp;
	}
	catch(Exception $e) {
		$resp = "-1";
		return $resp;
	}
}

// this is the function to check if the user exists in the Register table.
// returns 0 if the user does not exists. returns 1 if the user exists. -1 on Error.
function CheckUserRegister($email) {
	$resp = "-1";   // error
	try {
		$query = "select * from Register where UserEmail='$email'";
		$rs = mysql_query($query);
		if(!$rs) {
			$resp = "-1";
		}
		else {
			if(mysql_num_rows($rs) == 0) {
				$resp = "0";
			}
			else {
				$resp = "1";
			}
		}
		return $resp;
	}	
	catch(Exception $e) {
		$resp = "-1";
		return $resp;
	}
}

// this is the function to check if an email exists in the Users Table.
// returns 1 if the user does not exist. 2 if only one email exists. 3 if more than 1 email exists. -1 on Error.
function CheckEmailUsers($email) {
	$resp = "-1";
	try {
		$query = "select * from Users where Email='$email'";
		$rs = mysql_query($query);
		if(!$rs) {
			$resp = "-1";
		}
		else {
			if(mysql_num_rows($rs) == 0) {
				$resp = "1";
			}
			else if(mysql_num_rows($rs) == 1) {
				$resp = "2";
			}
			else {
				$resp = "3";
			}
		}
		return $resp;
	}
	catch(Exception $e) {
		$resp = "-1";
		return $resp;
	}
}

//this is the function to generate random password for Social media users.
function generateRandomPassword() {
	$password = '';
	$desired_length = rand(8, 12);
	for($length = 0; $length < $desired_length; $length++) {
		$password .= chr(rand(32, 126));
	}
	return $password;
}

// this is the helper function to save the details to the log file.
function WriteToLog($txt) {
	$logFile = fopen("log/log.txt", "a");
	if(!$logFile) {
		die("Cannot write to log.");
	}
	else {
		$date = date("Y-m-d H:i:s");
		fwrite($logFile, $date . " --> " . $txt . "\n");
	}
	fclose($logFile);
}

?>

