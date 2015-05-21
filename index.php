<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="Mentored-Research Compendium" content="Compendium by Mentored-Research, Mentored-Research">
    <meta name="author" content="Sagar anand, Mentored-Research Tech Team, MR Compendium">

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="img/favicon.ico" type="image/x-icon" />

    <title>MR - Compendium</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- for jQuery -->
    <script src="js/jquery-1.7.1.min.js"></script>

    <!-- for my own custom jQuery Scripts -->
    <script src="js/customScripts.js"></script>

    <!-- for the social buttons coming from Bootstrap -->
    <link href="css/bootstrap-social.css" rel="stylesheet">    

    <!-- the latest jQuery CDN -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <style type="text/css">

        @font-face {
            font-family: regularText;
            src: url('fonts/AlegreyaSansSC-Regular.ttf');
        }

        @font-face {
            font-family: boldText;
            src: url('fonts/AlegreyaSansSC-Bold.ttf');
        }

        @font-face {
            font-family: lightText;
            src: url('fonts/AlegreyaSansSC-Light.ttf');
        }

        @font-face {
            font-family: mediumText;
            src: url('fonts/AlegreyaSansSC-Medium.ttf');
        }

        @font-face {
            font-family: writingText;
            src: url('fonts/SEGOEUIL.ttf');
        }

        #alertMsg {
            z-index:999999; 
            margin: 2% 2% 2% 2%;
            font-family: boldText;
            position: fixed;
        }

        #popup {
            z-index:999999; 
            margin: 2% 2% 2% 2%;    
            font-family: boldText;
            position: fixed;
        }

        .modal {
        	position: fixed;
        	overflow: auto;
        }

        #buyCompendium {
        	margin-top: 13%;
        	margin-bottom: 15%;
        }

        #overlay {
        	position:absolute;
		    top:0;
		    left:0;
		    width:100%;
		    height:100%;
		    background-color:#000000;
		    opacity:0.6;
		    background-position: center center;
		    background-repeat: none;
		    -webkit-background-size: cover;
		    -moz-background-size: cover;
		    background-size: cover;
		    -o-background-size: cover;
        }

    </style>

    <script type="text/javascript">

	    // (function() {



	    // })();

    </script>

	<script type="text/javascript">
        
        $(document).ready(function() {

            var alertMsg = $('#alertMsg').fadeOut();
            var popup = $('#popup').fadeOut();    

            $('#btnExitPopup').on('click', function() {
                popup.children('p').remove();
                popup.fadeOut();
                return false;
            });

            // for checking the query string and all.
	    	var qs = getQueryStrings();

	    	if(qs["login"] == "1") {   // show the login modal.
	    		$('#loginModal').modal('show');
	    	}
	    	else if(qs["fb"] == "1") {   // Login modal with instructions for fb login
	    		popup.children('p').remove();
	    		popup.append("<p>Hope you have logged in your Facebook Account. Please go ahead and Login using the button in the below box.</p>").fadeIn();
	    		$('#loginModal').modal('show')
	    	}
	    	else if(qs["fb"] == "2") {   // Signup modal with instructions for fb login
	    		popup.children('p').remove();
	    		popup.append("<p>Hope you have logged in your Facebook Account. Please go ahead and Signup using the button in the below box.</p>").fadeIn();
	    		$('#signupModal').modal('show')
	    	}
	    	else if(qs["pay"] == "1") {   // show the Signup modal along with the instructions.
	    		popup.children('p').remove();
	    		popup.append("<p>Thank You for buying MR - Compendium. Please Signup with the appropriate option and use the coupon code <code>Coupon001</code> to gain access to MR - Compendium. Thank You.</p>").fadeIn();
	    		$('#signupModal').modal('show');		
	    	}
	    	else {   // do nothing here.

	    	}

	    	// this is the function for verifying the invite code [only for the Signup case]
	    	function VerifyInviteCode(code) {

	    		if(code == "") {
					popup.children('p').remove();
					popup.append("<p>Please enter the coupon code for us to activate your Compendium.</p>").fadeIn();
					$('#couponModal').modal('show');
				} 
				// else {					
				// }    // end of else.

				// do all the compendium stuff here.
				// here, firstly check if the coupon code is correct. If yes, (add or update) the Entry in Register table. Otherwise, enter again.
				$('#alertMsg').children('p').remove();
				$('#alertMsg').append("<p>Please wait while we check your Coupon code. Signing you in a minute...</p>").fadeIn();
				$.ajax({
					type: "GET",
					url: "AJAXFunctions.php",
					data: {
						no: "5", code: code
					},
					success: function(response) {
						response = $.trim(response);

						if(response == "1") {   // valid coupon exists.
							codeResp = response;

							var pwd = $('#txtSignupPwd').val();

							// now, insert or update the Register table for the new verified user.
							$.ajax({
								type: "POST",
								url: "AJAXFunctions.php",
								data: {
									no: "6", signemail: getCookie("userEmail"), signname: getCookie("userName"), signpwd: pwd
								},
								success: function(response) {
									response = $.trim(response);

									if(response == "1") {   // everything successful. inserted and verified.
										// alert("Go to dashboard page." + getCookie("userEmail") + " --> " + getCookie("userName"));
										window.location.href = "dashboard.php";
									}
									else if(response == "2") {   // cannot be verified.
										popup.children('p').remove();
										popup.append("<p>Oops! We encountered an error while verifying your coupon and email. Please try again.</p>").fadeIn();	
									}
									else if(response == "3") {   // cannot be inserted.
										popup.children('p').remove();
										popup.append("<p>Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
									}
									else {
										popup.children('p').remove();
										popup.append("<p>2. Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
									}
								},
								error: function(res) {

									console.log(res);

									var response = res.responseText;

									if(response == "1") {   // everything successful. inserted and verified.
										// alert("Go to dashboard page." + getCookie("userEmail") + " --> " + getCookie("userName"));
										window.location.href = "dashboard.php";
									}
									else if(response == "2") {   // cannot be verified.
										popup.children('p').remove();
										popup.append("<p>Oops! We encountered an error while verifying your coupon and email. Please try again.</p>").fadeIn();	
									}
									else if(response == "3") {   // cannot be inserted.
										popup.children('p').remove();
										popup.append("<p>Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
									}
									else {
										popup.children('p').remove();
										popup.append("<p>2. Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
									}

									// popup.children('p').remove();
									// popup.append("<p>1. Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
								}
							});
						}
						else if(response == "2") {   // coupon does not exists.
							popup.children('p').remove();
							popup.append("<p>Oops! The coupon code you entered did not match to anything we have. Please try again.</p>").fadeIn();
						}
						else if(response == "3") {   // coupon is invalid.
							popup.children('p').remove();
							popup.append("<p>Oops! The coupon code you entered has expired. Please try again or request another invite.</p>").fadeIn();	
						}
						else {   // error condition.
							popup.children('p').remove();
							popup.append("<p>Oops! We encountered an error while checking the coupons. Please try again.</p>").fadeIn();
						}
					},
					error: function() {
						popup.children('p').remove();
						popup.append("<p>Oops! We encountered an error while checking the coupons. Please try again.</p>").fadeIn();
					}
				}).done(function() {

					$('#alertMsg').children('p').remove();
					$('#alertMsg').fadeOut();

				});

	    	}  //end of verify function!

             // for the onBoarding of Signup.
	        function onBoardSignupManual(FbEmail, FbName) {

	        	console.log("In on boarding function for manual.");

	        	var registerResp = "";
	        	$('#signupModal').modal('hide');

	        	// firstly, check if the user is already verified or not! In both these cases, the email exists in the Register table.
				$('#alertMsg').children('p').remove();
				$('#alertMsg').append("<p>Signing you up. Please wait for a moment.</p>").fadeIn();
				$.ajax({
					type: "GET",
					url: "AJAXFunctions.php",
					data: {
						no: "3", name: FbName, email: FbEmail
					},
					success: function(response) {
						response = $.trim(response);
						registerResp = response;
					}, 
					error: function() {
						$('#alertMsg').children('p').remove();
						$('#alertMsg').fadeOut();
						$('#popup').children('p').remove();
						$('#popup').append("<p>Oops! We encountered an error signing you up. Please try again.</p>").fadeIn();
					}
				}).done(function() {

					// now, for checking in the Users table.
					if(registerResp == "0") {   //user does not exist in the Register table.
						// here, check if the user exists in the user table. If yes, go to the coupon code page, or else go to the reQuest invite page.
						$.ajax({
							type: "GET",
							url: "AJAXFunctions.php",
							data: {
								no: "2", name: FbName, email: FbEmail
							},
							success: function(response) {
								$('#alertMsg').children('p').remove();
								$('#alertMsg').fadeOut();

								response = $.trim(response);

								if(response == "-1") {   // does not exists in the users table.
									$('#requestInviteModal').modal('show');
									$('.requestSalutation').html("<b>Hey " + getCookie("userName") + "! <br /></b>");
								}
								else if(response == "1") {   // user exists in the Users table.
									//$('#couponModal').modal('show');
									VerifyInviteCode($('#txtCode').val());
								}
								else if(response == "-3") {    // user exists more than once.
									//$('#couponModal').modal('show');	
									VerifyInviteCode($('#txtCode').val());
								}
								else {
									$('#popup').children('p').remove();
									$('#popup').append("<p>Oops! We encountered an error signing you up. Please try again.</p>").fadeIn();	
								}
							},
							error: function() {
								$('#alertMsg').children('p').remove();
								$('#alertMsg').fadeOut();
								$('#popup').children('p').remove();
								$('#popup').append("<p>Oops! We encountered an error signing you up. Please try again.</p>").fadeIn();
							}
						});
					}
					else if(registerResp == "-1") {   // not verified user. In this case, insertion into the Register table wont b done!
						$('#popup').children('p').remove();
						$('#popup').append("<p>Looks like this Email address has already signed up. Please enter the coupon code for account activation. </p>").fadeIn();
						$('#couponModal').modal('show');
					}
					else if(registerResp == "1") {   // verified user.
						// show the user that this email address has already registered.
						$('#popup').children('p').remove();
						$('#popup').append("<p>Looks like this Email address has already signed up. Please Login to continue.</p>").fadeIn();
					}
					else {
						$('#popup').children('p').remove();
						$('#popup').append("<p>Oops! We encountered an error signing you up. Please try again.</p>").fadeIn();
					}

				});

				// hide all the messages finally.
				$('#alertMsg').children('p').remove();
				$('#alertMsg').fadeOut();
				$('#popup').children('p').remove();
				$('#popup').fadeOut();

	        }   // end of onBoardSignup()


	        // function for logging in.
	        function onBoardLoginManual(FbEmail, FbName) {

	        	// set the cookies here.
				setCookie("userEmail", FbEmail, 150);
				setCookie("userName", FbName, 150);

	    		 // now, for logging into the Compendium.
	            $('#alertMsg').children('p').remove();
	            $('#alertMsg').append("<p>Please give us a moment while we log you in...</p>").fadeIn();
	            $.ajax({
	            	type: "GET",
	            	url: "AJAXFunctions.php",
	            	data: {
	            		no: "4", name: FbName, email: FbEmail
	            	},
	            	success: function(response) {
	            		$('#alertMsg').children('p').remove();
						$('#alertMsg').fadeOut();
	            		response = $.trim(response);
	            		if(response == "0") {   // user does not exist in the Register table.
	            			$('#popup').children('p').remove();
	            			$('#popup').append("<p>The Email Address used for login is not signed up yet. Please Signup first.</p>").fadeIn();
	            		}
	            		else if(response == "-1") {   // not verified user.
	            			//alert("Go to the coupons page for verification.");
	            			$('#couponModal').modal('show');
	            		}
	            		else if(response == "1") {   // verified user.
	            			//alert("Go to the dashboard page.");


	            			//authenticate the user here from the register table.
	            			$.ajax({
	            				type: "GET",
	            				url: "AJAXFunctions.php",
	            				data: {
	            					no: "7", email: FbEmail, pwd: $('#txtLoginPwd').val()
	            				},
	            				success: function(response) {

	            					response = $.trim(response);

	            					if(response == "1") {
	            						window.location.href = "dashboard.php";
	            					}
	            					else if(response == "0") {
	            						$('#popup').children('p').remove();
				            			$('#popup').append("<p>Oops! We could not authenticate your request. Please re-check your password and try again.").fadeIn();                				            						
	            					}
	            					else {
	            						$('#popup').children('p').remove();
				            			$('#popup').append("<p>Oops! We encountered an error while authenticating your request. Please try again.").fadeIn();                				            						
	            					}
	            				},
	            				error: function() {
									$('#popup').children('p').remove();
			            			$('#popup').append("<p>Oops! We encountered an error while authenticating your request. Please try again.").fadeIn();                				            					
	            				}
	            			});
	            		}
	            		else {
							$('#popup').children('p').remove();
	            			$('#popup').append("<p>Oops! We encountered an error while processing your request. Please try again.").fadeIn();                			
	            		}
	            	},
	            	error: function() {
	            		$('#alertMsg').children('p').remove();
						$('#alertMsg').fadeOut();
						$('#popup').children('p').remove();
	        			$('#popup').append("<p>Oops! We encountered an error while processing your request. Please try again.").fadeIn();                			
	            	}
	            });
	        }

            // for the send message button on the home page in contact us tab.
            $('#btnSendMessage').on('click', function() {

                var name = $('#txtName').val();
                var email = $('#txtContactEmail').val();
                var phone = $('#txtContactPhone').val();
                var message = $('#txtContactMessage').val();

                if(name == "" || email == "" || phone == "" || message == "")  {
                    popup.children('p').remove();
                    popup.append("<p>Oops! You missed a field to be filled. Please Re-check</p>").fadeIn();
                }
                else if(!isValidEmailAddress(email)) {
                    popup.children('p').remove();
                    popup.append("<p>Oops! Your Email does not seem to be correct. Please Verify.</p>").fadeIn();   
                }
                else {
                    alertMsg.children('p').remove();
                    alertMsg.append("<p>Please wait while we send your message to the MR - Compendium Team</p>").fadeIn();
                    $.ajax({
                        type: "GET",
                        url: "AJAXFunctions.php",
                        data: {
                            no: "1", name: name, email: email, phone: phone, message: message
                        },
                        success: function(response) {
                            alertMsg.children('p').remove();
                            alertMsg.fadeOut();

                            if(response == "-1") {
                                popup.children('p').remove();
                                popup.append("<p>2. Oops! We encountered an error in sending your message. Please try again.</p>").fadeIn();       
                            }
                            else {
                                popup.children('p').remove();
                                popup.append("<p>Successfully sent your message. Thank You.</p>").fadeIn();
                            }
                        },
                        error: function() {
                            alertMsg.children('p').remove();
                            alertMsg.fadeOut();
                            popup.children('p').remove();
                            popup.append("<p>Oops! We encountered an error in sending your message. Please try again. Error in ajax!!</p>").fadeIn();
                        }
                    });
                }   // end of else

                return false;
            });

			// for the manual sign up button.
			$('#btnSignupManual').on('click', function() {

				var name = $('#txtSignupName').val();
				var email = $('#txtSignupEmail').val();
				var pwd = $('#txtSignupPwd').val();

				// set the cookies here.
				setCookie("userEmail", email, 150);
				setCookie("userName", name, 150);

				if(name == "" || email == "" || pwd == "") {
					popup.children('p').remove();
					popup.append("<p>Looks like you missed some input values. Please verify and try again.</p>").fadeIn();
				}
				else if(!isValidEmailAddress(email)) {
					popup.children('p').remove();
					popup.append("<p>The Email Address entered does not appears to be correct. Please verify and try again.</p>").fadeIn();
				}
				else {
					// for manual onboarding thing
					onBoardSignupManual(email, name);
				}
				return false;
			});

			// for the manual Log in button
			$('#btnLoginManual').on('click', function() {

				var email = $('#txtLoginEmail').val();
				var pwd = $('#txtLoginPwd').val();

				// set the cookies here.
				setCookie("userEmail", email, 150);
				setCookie("userName", name, 150);

				// for the onBoardLogin call
				onBoardLoginManual(email, "");

				return false;

			});

			// for the coupon code acceptance
			$('#btnCouponCode').on('click', function() {

				// coupon code value is being taken from textbox in the Signup Modal.
				var code = $('#txtCouponCode').val();
				code = code.trim();

				var codeResp = "";

				if(code == "") {
					popup.children('p').remove();
					popup.append("<p>Please enter the coupon code for us to activate your Compendium.</p>").fadeIn();
				} 
				else {

					// do all the compendium stuff here.
					// here, firstly check if the coupon code is correct. If yes, (add or update) the Entry in Register table. Otherwise, enter again.
					$('#alertMsg').children('p').remove();
					$('#alertMsg').append("<p>Please wait while we check your Coupon code. Signing you in a minute...</p>").fadeIn();
					$.ajax({
						type: "GET",
						url: "AJAXFunctions.php",
						data: {
							no: "5", code: code
						},
						success: function(response) {
							response = $.trim(response);

							if(response == "1") {   // valid coupon exists.
								codeResp = response;

								var pwd = $('#txtSignupPwd').val();

								// now, insert or update the Register table for the new verified user.
								$.ajax({
									type: "POST",
									url: "AJAXFunctions.php",
									data: {
										no: "6", signemail: getCookie("userEmail"), signname: getCookie("userName"), signpwd: pwd
									},
									success: function(response) {
										response = $.trim(response);

										if(response == "1") {   // everything successful. inserted and verified.
											// alert("Go to dashboard page." + getCookie("userEmail") + " --> " + getCookie("userName"));
											window.location.href = "dashboard.php";
										}
										else if(response == "2") {   // cannot be verified.
											popup.children('p').remove();
											popup.append("<p>Oops! We encountered an error while verifying your coupon and email. Please try again.</p>").fadeIn();	
										}
										else if(response == "3") {   // cannot be inserted.
											popup.children('p').remove();
											popup.append("<p>Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
										}
										else {
											popup.children('p').remove();
											popup.append("<p>2. Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
										}
									},
									error: function(res) {

										console.log(res);

										var response = res.responseText;

										if(response == "1") {   // everything successful. inserted and verified.
											// alert("Go to dashboard page." + getCookie("userEmail") + " --> " + getCookie("userName"));
											window.location.href = "dashboard.php";
										}
										else if(response == "2") {   // cannot be verified.
											popup.children('p').remove();
											popup.append("<p>Oops! We encountered an error while verifying your coupon and email. Please try again.</p>").fadeIn();	
										}
										else if(response == "3") {   // cannot be inserted.
											popup.children('p').remove();
											popup.append("<p>Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
										}
										else {
											popup.children('p').remove();
											popup.append("<p>2. Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
										}

										// popup.children('p').remove();
										// popup.append("<p>1. Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
									}
								});
							}
							else if(response == "2") {   // coupon does not exists.
								popup.children('p').remove();
								popup.append("<p>Oops! The coupon code you entered did not match to anything we have. Please try again.</p>").fadeIn();
							}
							else if(response == "3") {   // coupon is invalid.
								popup.children('p').remove();
								popup.append("<p>Oops! The coupon code you entered has expired. Please try again or request another invite.</p>").fadeIn();	
							}
							else {   // error condition.
								popup.children('p').remove();
								popup.append("<p>Oops! We encountered an error while checking the coupons. Please try again.</p>").fadeIn();
							}
						},
						error: function() {
							popup.children('p').remove();
							popup.append("<p>Oops! We encountered an error while checking the coupons. Please try again.</p>").fadeIn();
						}
					}).done(function() {

						$('#alertMsg').children('p').remove();
						$('#alertMsg').fadeOut();

					});

				}    // end of else.
				return false;
			});

			// for the request invite button
			$('#btnRequestInvite').on('click', function() {
				// insert the entry into the Users table and send a mail with the coupon code for the invite.
				if(getCookie("userEmail") == "") {
					popup.children('p').remove();
					popup.append("<p>Oops! We could not process your request because of an internal error. Please try again.</p>").fadeIn();					
				}
				else {

					// for adding the user to the Users table for inviting based on request.
					alertMsg.children('p').remove();
					alertMsg.append("<p>Please white while we register your request for MR - Compendium invite.</p>").fadeIn();

					$.ajax({
						type: "GET",
						url: "AJAXFunctions.php",
						data: {
							no: "8", email: getCookie("userEmail"), name: getCookie("userName"), pwd: $('#txtSignupPwd').val()
						},
						success: function(response) {
							response = $.trim(response);

							alertMsg.children('p').remove();
							alertMsg.fadeOut();

							if(response == "1") {
								popup.children('p').remove();
								popup.append("<p>Your Invite has been registered. Please check your mailbox for the Invite Code.</p>").fadeIn();

								// show the invite code dialog box here and hide the Request invite modal.
								$('#requestInviteModal').modal('hide');
								$('#couponModal').modal('show');
							}
							else if(response == "2") {
								popup.children('p').remove();
								popup.append("<p>Oops! We could not send you the mail containing the Invite Code. Please let us know at <code>tech@mentored-research.com</code> and we'll get back to you in 24 hours.</p>").fadeIn();													
							}
							else {
								popup.children('p').remove();
								popup.append("<p>Oops! We encountered an error while processing your request. Please try again.</p>").fadeIn();													
							}
						},
						error: function() {
							popup.children('p').remove();
							popup.append("<p>Oops! We encountered an error while processing your request. Please try again.</p>").fadeIn();					
						}
					});

				}
				return false;
			});

			// for the privacy policy and terms of use modal.
			$('.quicklinks, ul.quicklinks li a').on('click', function() {

				$('.modal').modal('hide');

				var item = $(this).attr('data-modal');

				if(item == "#privacyPolicyModal") {
					$('#privacyPolicyModal').modal('show');
					//$('.modal-body').focus();
				}
				else if(item == "#termsConditionsModal") {
					$('#termsConditionsModal').modal('show');
					//$('.modal-body').focus();
				}

				return false;
			});

			// for the login and signup functionality!

			// for the get started button.
			$('#btnGetStarted').on('click', function() {
				$('#signupModal').modal('show');
				return false;
			});

			// hide the manual Signup div.
			$('#manualSignupTable').slideUp();

			// wire up the other Signup button
			$('#otherSignup').on('click', function() {
				$('#manualSignupTable').slideToggle();
				return false;
			});

			// to show the login modal on click of btnAlreadyRegistered.
			$('#btnAlreadyRegistered').on('click', function() {
				$('#signupModal').modal('hide');
				$('#loginModal').modal('show');
				return false;
			});

			// for the login button on the navbar 
			$('#btnLogin').on('click', function() {
				$('#signupModal').modal('hide');
				$('#loginModal').modal('show');
				return false;
			})

			//for the buy compendium button
			$('#btnBuyCompendium').on('click', function() {
				window.location.href = "http://mentored-research.com/payment/payment.php?amount=349";
				return false;
			});

        });    // end of ready function.

	</script>

    <!--  this is the script for Javascript SDK for logging into QR using Facebook login!! -->
    <script type="text/javascript">

    	var alertMsg = $('#alertMsg').fadeOut();
        var popup = $('#popup').fadeOut();    

        $('#btnExitPopup').on('click', function() {
            popup.children('p').remove();
            popup.fadeOut();
            return false;
        });

        // this is the function for verifying the invite code [only for the Signup case]
    	function VerifyInviteCodeFacebook(code) {

    		if(code == "") {
				popup.children('p').remove();
				popup.append("<p>Please enter the coupon code for us to activate your Compendium.</p>").fadeIn();
				$('#couponModal').modal('show');
			} 
			// else {					
			// }    // end of else.

			// do all the compendium stuff here.
			// here, firstly check if the coupon code is correct. If yes, (add or update) the Entry in Register table. Otherwise, enter again.
			$('#alertMsg').children('p').remove();
			$('#alertMsg').append("<p>Please wait while we check your Coupon code. Signing you in a minute...</p>").fadeIn();
			$.ajax({
				type: "GET",
				url: "AJAXFunctions.php",
				data: {
					no: "5", code: code
				},
				success: function(response) {
					response = $.trim(response);

					if(response == "1") {   // valid coupon exists.
						codeResp = response;

						var pwd = $('#txtSignupPwd').val();

						// now, insert or update the Register table for the new verified user.
						$.ajax({
							type: "POST",
							url: "AJAXFunctions.php",
							data: {
								no: "6", signemail: getCookie("userEmail"), signname: getCookie("userName"), signpwd: pwd
							},
							success: function(response) {
								response = $.trim(response);

								if(response == "1") {   // everything successful. inserted and verified.
									// alert("Go to dashboard page." + getCookie("userEmail") + " --> " + getCookie("userName"));
									window.location.href = "dashboard.php";
								}
								else if(response == "2") {   // cannot be verified.
									popup.children('p').remove();
									popup.append("<p>Oops! We encountered an error while verifying your coupon and email. Please try again.</p>").fadeIn();	
								}
								else if(response == "3") {   // cannot be inserted.
									popup.children('p').remove();
									popup.append("<p>Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
								}
								else {
									popup.children('p').remove();
									popup.append("<p>2. Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
								}
							},
							error: function(res) {

								console.log(res);

								var response = res.responseText;

								if(response == "1") {   // everything successful. inserted and verified.
									// alert("Go to dashboard page." + getCookie("userEmail") + " --> " + getCookie("userName"));
									window.location.href = "dashboard.php";
								}
								else if(response == "2") {   // cannot be verified.
									popup.children('p').remove();
									popup.append("<p>Oops! We encountered an error while verifying your coupon and email. Please try again.</p>").fadeIn();	
								}
								else if(response == "3") {   // cannot be inserted.
									popup.children('p').remove();
									popup.append("<p>Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
								}
								else {
									popup.children('p').remove();
									popup.append("<p>2. Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
								}

								// popup.children('p').remove();
								// popup.append("<p>1. Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
							}
						});
					}
					else if(response == "2") {   // coupon does not exists.
						popup.children('p').remove();
						popup.append("<p>Oops! The coupon code you entered did not match to anything we have. Please try again.</p>").fadeIn();
					}
					else if(response == "3") {   // coupon is invalid.
						popup.children('p').remove();
						popup.append("<p>Oops! The coupon code you entered has expired. Please try again or request another invite.</p>").fadeIn();	
					}
					else {   // error condition.
						popup.children('p').remove();
						popup.append("<p>Oops! We encountered an error while checking the coupons. Please try again.</p>").fadeIn();
					}
				},
				error: function() {
					popup.children('p').remove();
					popup.append("<p>Oops! We encountered an error while checking the coupons. Please try again.</p>").fadeIn();
				}
			}).done(function() {

				$('#alertMsg').children('p').remove();
				$('#alertMsg').fadeOut();

			});

    	}  //end of verify function for facebook!

        // for the onBoarding of Signup, using Facebook
        function onBoardSignupFacebook(FbEmail, FbName) {

        	console.log("In on boarding function for facebook.");

        	// set the cookies here.
			setCookie("userEmail", FbEmail, 150);
			setCookie("userName", FbName, 150);

        	var registerResp = "";
        	$('#signupModal').modal('hide');

        	// firstly, check if the user is already verified or not! In both these cases, the email exists in the Register table.
			$('#alertMsg').children('p').remove();
			$('#alertMsg').append("<p>Signing you up. Please wait for a moment.</p>").fadeIn();
			$.ajax({
				type: "GET",
				url: "AJAXFunctions.php",
				data: {
					no: "3", name: FbName, email: FbEmail
				},
				success: function(response) {
					response = $.trim(response);
					registerResp = response;
				}, 
				error: function() {
					$('#alertMsg').children('p').remove();
					$('#alertMsg').fadeOut();
					$('#popup').children('p').remove();
					$('#popup').append("<p>Oops! We encountered an error signing you up. Please try again. [Error in AJAX.]</p>").fadeIn();
				}
			}).done(function() {

				// now, for checking in the Users table.
				if(registerResp == "0") {
					// here, check if the user exists in the user table. If yes, go to the coupon code page, or else go to the reQuest invite page.
					$.ajax({
						type: "GET",
						url: "AJAXFunctions.php",
						data: {
							no: "2", name: FbName, email: FbEmail
						},
						success: function(response) {
							$('#alertMsg').children('p').remove();
							$('#alertMsg').fadeOut();

							response = $.trim(response);

							if(response == "-1") {   // does not exists in the users table.
								//alert("Go to the Request Invite page.");
								$('#requestInviteModal').modal('show');
								$('.requestSalutation').html("<b>Hey " + getCookie("userName") + "! <br /></b>");
							}
							else if(response == "1") {   // user exists in the Users table.
								//alert("Go to the Coupon Code page.");
								//$('#couponModal').modal('show');
								VerifyInviteCodeFacebook($('#txtCode').val());
							}
							else if(response == "-3") {
								//alert("User Email exists more than once. ");
								$('#popup').children('p').remove();
								$('#popup').append("<p>Looks like this Email address has already signed up. Please enter the coupon code for account activation. </p>").fadeIn();
								$('#couponModal').modal('show');
							}
							else {
								$('#popup').children('p').remove();
								$('#popup').append("<p>Oops! We encountered an error signing you up. Please try again. Error here.</p>").fadeIn();	
							}
						},
						error: function() {
							$('#alertMsg').children('p').remove();
							$('#alertMsg').fadeOut();
							$('#popup').children('p').remove();
							$('#popup').append("<p>Oops! We encountered an error signing you up. Please try again. [Error in 2nd AJAX.]</p>").fadeIn();
						}
					});
				}
				else if(registerResp == "-1") {   // not verified user.
					//alert("Go to the coupons page.");
					$('#couponModal').modal('show');
				}
				else if(registerResp == "1") {   // verified user. Already signed up.
					$('#popup').children('p').remove();
					$('#popup').append("<p>Looks like this Email address has already signed up and activated. Please Login to continue.</p>").fadeIn();
				}
				else {
					$('#popup').children('p').remove();
					$('#popup').append("<p>Oops! We encountered an error signing you up. Please try again. Error in registerResp.</p>").fadeIn();
				}

			});
        }   // end of onBoardSignup()

        // function for logging in.
        function onBoardLoginFacebook(FbEmail, FbName) {

        	// set the cookies here.
			setCookie("userEmail", FbEmail, 150);
			setCookie("userName", FbName, 150);

    		 // now, for logging into the Compendium.
            $('#alertMsg').children('p').remove();
            $('#alertMsg').append("<p>Please give us a moment while we log you in...</p>").fadeIn();
            $.ajax({
            	type: "GET",
            	url: "AJAXFunctions.php",
            	data: {
            		no: "4", name: FbName, email: FbEmail
            	},
            	success: function(response) {
            		$('#alertMsg').children('p').remove();
					$('#alertMsg').fadeOut();
            		response = $.trim(response);
            		if(response == "0") {   // user does not exist in the Register table.
            			$('#popup').children('p').remove();
            			$('#popup').append("<p>The Email Address used for login is not signed up yet. Please Signup first.</p>").fadeIn();
            		}
            		else if(response == "-1") {   // not verified user.
            			//alert("Go to the coupons page for verification.");
            			$('#couponModal').modal('show');
            		}
            		else if(response == "1") {   // verified user.
            			//alert("Go to the dashboard page.");
            			window.location.href = "dashboard.php";
            		}
            		else {
						$('#popup').children('p').remove();
            			$('#popup').append("<p>Oops! We encountered an error while processing your request. Please try again.").fadeIn();                			
            		}
            	},
            	error: function() {
            		$('#alertMsg').children('p').remove();
					$('#alertMsg').fadeOut();
					$('#popup').children('p').remove();
        			$('#popup').append("<p>Oops! We encountered an error while processing your request. Please try again.").fadeIn();                			
            	}
            });
        }

        // callback thing for logging into Compendium using Facebook.
        function statusChangeCallback(response) {
            if (response.status === 'connected') {
            	console.log("Connected while logging in.");
          		testAPI();
            }
            else if (response.status === 'not_authorized') {   // The person is logged into Facebook, but not your app.
              //alert("Please login into the  MR-QR app.");
              console.log(" not_authorized.");
              $('#popup').children('p').remove();
              $('#popup').append("<p>Please login into the MR - Compendium app to continue.</p>").fadeIn('fast');
            } 
            else {
                console.log("Not logged into fb.");
          		$('#popup').children('p').remove();
          		$('#popup').append("<p>Please login into your facebook account in another tab and then try again.</p>").fadeIn('fast');

          		// open the facebook login window
          		window.open("http://facebook.com", "Login into your Facebook Account");

          		// refresh the page with appropriate message after 8 seconds.
          		setTimeout(function() {
          			window.location.href = "http://mentored-research.com/Compendium?fb=1";
          		}, 8000);
            }
    	}

    	// callback function for Signup thing.
    	function statusChangeCallbackSignup(response) {
    		console.log("In statusChangeCallbackSignup()");
            if (response.status === 'connected') {
            	console.log("Connected.");
          		testAPISignup();
            }
            else if (response.status === 'not_authorized') {   // The person is logged into Facebook, but not your app.
              //alert("Please login into the  MR-QR app.");
              console.log(" not_authorized.");
              popup.children('p').remove();
              popup.append("<p>Please login into the MR - Compendium app to continue.</p>").fadeIn('fast');
            } 
            else {
                //alert("Please login into facebook and the app too!!");
                console.log("Not logged into fb.");
            	$('#popup').children('p').remove();
          		$('#popup').append("<p>Please login into your facebook account in another tab and then try again.</p>").fadeIn('fast');

          		// open the facebook login window
          		window.open("http://facebook.com", "Login into your Facebook Account");

          		// refresh the page with appropriate message after 8 seconds.
          		setTimeout(function() {
          			window.location.href = "http://mentored-research.com/Compendium?fb=2";
          		}, 8000);
            }
    	}

    	// This function is called when someone finishes with the Login
        // Button.  See the onlogin handler attached to it in the sample
        // code below.
        function checkLoginState() { 
        	console.log("I m logging in for MR - Compendium");
            FB.getLoginStatus(function(response) {    
          		statusChangeCallback(response);
            });
        } 

        // for the sign up thing.
        function checkSignupState() { 
        	console.log("I m signing up for MR - Compendium");
            FB.getLoginStatus(function(response) {    
          		statusChangeCallbackSignup(response);
            });
        } 

        window.fbAsyncInit = function() {
            FB.init({
                appId      : '802885419774376',
                cookie     : true,  // enable cookies to allow the server to access 
                                    // the session
                xfbml      : true,  // parse social plugins on this page
                version    : 'v2.1' // use version 2.1
            });

            /*FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });  */
        };

        // Load the SDK asynchronously
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        //this is the function that runs after the signup is successful.
        function testAPI() {

            FB.api('/me', function(response) {
                //alert("Login success: " + response.name + " --> " + response.email + " --> " + response.id  + " --> " + response.birthday + " --> " + response.gender + " --> " + response.link  + " --> " + response.location);
                //alert(response.email + " --> " + response.name);

                var FbEmail = response.email;
                var FbName = response.name;
                //alert("Logging in: " + FbEmail + " --> " + FbName);

                // call to the log in function
                onBoardLoginFacebook(FbEmail, FbName);
               
            });
        }   //this is the end of the testAPI function  for login.

        //this is the function that runs after the signup is successful.
        function testAPISignup() {
        	console.log("In testAPISignup()");
            FB.api('/me', function(response) {
				//alert("Login success: " + response.name + " --> " + response.email + " --> " + response.id  + " --> " + response.birthday + " --> " + response.gender + " --> " + response.link  + " --> " + response.location);
				//alert(response.email + " --> " + response.name);

				var FbEmail = response.email;
				var FbName = response.name;

				//alert("Signing up: " + FbEmail + " --> " + FbName);
               
				// for the on-boarding process of sign up thing!
				onBoardSignupFacebook(FbEmail, FbName);

            });

        }   //this is the end of the testAPI function  for Signup

    </script>

    <!-- this is for the google signin thing -->
    <script src="https://apis.google.com/js/client:platform.js" async defer></script>

    <meta name="google-signin-clientid" content="947100308668-htrbcelkmc6aequlcfcpb8bhlja8bur2.apps.googleusercontent.com" />
    <meta name="google-signin-scope" content="https://www.googleapis.com/auth/plus.login" />
    <meta name="google-signin-scope" content="https://www.googleapis.com/auth/plus.profile.emails.read">
    <meta name="google-signin-requestvisibleactions" content="http://schema.org/AddAction" />
    <meta name="google-signin-cookiepolicy" content="single_host_origin" />
    <script src="https://apis.google.com/js/client:platform.js?onload=render" async defer></script>

    <script type="text/javascript">

        //for the alert boxes
        var alertMsg = $('#alertMsg').hide();
        //for the popup!
        var popup = $('#popup').hide(1);
        //button to hide the popup appearing!
        $('#btnExitPopup').on('click', function () {
            popup.fadeOut();
            return false;
        });

        // this is the function for verifying the invite code [only for the Signup case]
    	function VerifyInviteCodeGoogle(code) {

    		if(code == "") {
				popup.children('p').remove();
				popup.append("<p>Please enter the coupon code for us to activate your Compendium.</p>").fadeIn();
				$('#couponModal').modal('show');
			} 
			// else {					
			// }    // end of else.

			// do all the compendium stuff here.
			// here, firstly check if the coupon code is correct. If yes, (add or update) the Entry in Register table. Otherwise, enter again.
			$('#alertMsg').children('p').remove();
			$('#alertMsg').append("<p>Please wait while we check your Coupon code. Signing you in a minute...</p>").fadeIn();
			$.ajax({
				type: "GET",
				url: "AJAXFunctions.php",
				data: {
					no: "5", code: code
				},
				success: function(response) {
					response = $.trim(response);

					if(response == "1") {   // valid coupon exists.
						codeResp = response;

						var pwd = $('#txtSignupPwd').val();

						// now, insert or update the Register table for the new verified user.
						$.ajax({
							type: "POST",
							url: "AJAXFunctions.php",
							data: {
								no: "6", signemail: getCookie("userEmail"), signname: getCookie("userName"), signpwd: pwd
							},
							success: function(response) {
								response = $.trim(response);

								if(response == "1") {   // everything successful. inserted and verified.
									// alert("Go to dashboard page." + getCookie("userEmail") + " --> " + getCookie("userName"));
									window.location.href = "dashboard.php";
								}
								else if(response == "2") {   // cannot be verified.
									popup.children('p').remove();
									popup.append("<p>Oops! We encountered an error while verifying your coupon and email. Please try again.</p>").fadeIn();	
								}
								else if(response == "3") {   // cannot be inserted.
									popup.children('p').remove();
									popup.append("<p>Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
								}
								else {
									popup.children('p').remove();
									popup.append("<p>2. Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
								}
							},
							error: function(res) {

								console.log(res);

								var response = res.responseText;

								if(response == "1") {   // everything successful. inserted and verified.
									// alert("Go to dashboard page." + getCookie("userEmail") + " --> " + getCookie("userName"));
									window.location.href = "dashboard.php";
								}
								else if(response == "2") {   // cannot be verified.
									popup.children('p').remove();
									popup.append("<p>Oops! We encountered an error while verifying your coupon and email. Please try again.</p>").fadeIn();	
								}
								else if(response == "3") {   // cannot be inserted.
									popup.children('p').remove();
									popup.append("<p>Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
								}
								else {
									popup.children('p').remove();
									popup.append("<p>2. Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
								}

								// popup.children('p').remove();
								// popup.append("<p>1. Oops! We encountered an error while registering this email address. Please try again.</p>").fadeIn();
							}
						});
					}
					else if(response == "2") {   // coupon does not exists.
						popup.children('p').remove();
						popup.append("<p>Oops! The coupon code you entered did not match to anything we have. Please try again.</p>").fadeIn();
					}
					else if(response == "3") {   // coupon is invalid.
						popup.children('p').remove();
						popup.append("<p>Oops! The coupon code you entered has expired. Please try again or request another invite.</p>").fadeIn();	
					}
					else {   // error condition.
						popup.children('p').remove();
						popup.append("<p>Oops! We encountered an error while checking the coupons. Please try again.</p>").fadeIn();
					}
				},
				error: function() {
					popup.children('p').remove();
					popup.append("<p>Oops! We encountered an error while checking the coupons. Please try again.</p>").fadeIn();
				}
			}).done(function() {

				$('#alertMsg').children('p').remove();
				$('#alertMsg').fadeOut();

			});

    	}  //end of verify function for google!

        // for the onBoarding of Signup. [in Google]
        function onBoardSignupGoogle(FbEmail, FbName) {

        	console.log("In on boarding function for Google.");

        	// set the cookies here.
			setCookie("userEmail", FbEmail, 150);
			setCookie("userName", FbName, 150);

        	var registerResp = "";
        	$('#signupModal').modal('hide');

        	// firstly, check if the user is already verified or not! In both these cases, the email exists in the Register table.
			$('#alertMsg').children('p').remove();
			$('#alertMsg').append("<p>Signing you up. Please wait for a moment.</p>").fadeIn();
			$.ajax({
				type: "GET",
				url: "AJAXFunctions.php",
				data: {
					no: "3", name: FbName, email: FbEmail
				},
				success: function(response) {
					response = $.trim(response);
					registerResp = response;
				}, 
				error: function() {
					$('#alertMsg').children('p').remove();
					$('#alertMsg').fadeOut();
					$('#popup').children('p').remove();
					$('#popup').append("<p>Oops! We encountered an error signing you up. Please try again.</p>").fadeIn();
				}
			}).done(function() {

				// now, for checking in the Users table.
				if(registerResp == "0") {
					// here, check if the user exists in the user table. If yes, go to the coupon code page, or else go to the reQuest invite page.
					$.ajax({
						type: "GET",
						url: "AJAXFunctions.php",
						data: {
							no: "2", name: FbName, email: FbEmail
						},
						success: function(response) {
							$('#alertMsg').children('p').remove();
							$('#alertMsg').fadeOut();

							response = $.trim(response);

							if(response == "-1") {   // does not exists in the users table.
								//alert("Go to the Request Invite page.");
								$('#requestInviteModal').modal('show');
								$('.requestSalutation').html("<b>Hey " + getCookie("userName") + "! <br /></b>");
							}
							else if(response == "1") {   // user exists in the Users table.
								//alert("Go to the Coupon Code page.");
								//$('#couponModal').modal('show');
								VerifyInviteCodeGoogle($('#txtCode').val());
							}
							else if(response == "-3") {
								//alert("User Email exists more than once. ");
								//$('#couponModal').modal('show');
								VerifyInviteCodeGoogle($('#txtCode').val());
							}
							else {
								$('#popup').children('p').remove();
								$('#popup').append("<p>Oops! We encountered an error signing you up. Please try again.</p>").fadeIn();	
							}
						},
						error: function() {
							$('#alertMsg').children('p').remove();
							$('#alertMsg').fadeOut();
							$('#popup').children('p').remove();
							$('#popup').append("<p>Oops! We encountered an error signing you up. Please try again.</p>").fadeIn();
						}
					});
				}
				else if(registerResp == "-1") {   // not verified user.
					//alert("Go to the coupons page.");
					$('#popup').children('p').remove();
					$('#popup').append("<p>Looks like this Email address has already signed up. Please enter the coupon code for account activation. </p>").fadeIn();
					$('#couponModal').modal('show');
				}
				else if(registerResp == "1") {   // verified user.
					$('#popup').children('p').remove();
					$('#popup').append("<p>Looks like this Email address has already signed up and activated. Please Login to continue.</p>").fadeIn();
				}
				else {
					$('#popup').children('p').remove();
					$('#popup').append("<p>Oops! We encountered an error signing you up. Please try again.</p>").fadeIn();
				}

			});
        }   // end of onBoardSignup()

        // function for logging in.
        function onBoardLoginGoogle(FbEmail, FbName) {

        	// set the cookies here.
			setCookie("userEmail", FbEmail, 150);
			setCookie("userName", FbName, 150);

    		 // now, for logging into the Compendium.
            $('#alertMsg').children('p').remove();
            $('#alertMsg').append("<p>Please give us a moment while we log you in...</p>").fadeIn();
            $.ajax({
            	type: "GET",
            	url: "AJAXFunctions.php",
            	data: {
            		no: "4", name: FbName, email: FbEmail
            	},
            	success: function(response) {
            		$('#alertMsg').children('p').remove();
					$('#alertMsg').fadeOut();
            		response = $.trim(response);
            		if(response == "0") {   // user does not exist in the Register table.
            			$('#popup').children('p').remove();
            			$('#popup').append("<p>The Email Address used for login is not signed up yet. Please Signup first.</p>").fadeIn();
            		}
            		else if(response == "-1") {   // not verified user.
            			//alert("Go to the coupons page for verification.");
            			$('#couponModal').modal('show');
            		}
            		else if(response == "1") {   // verified user.
            			//alert("Go to the dashboard page.");
            			window.location.href = "dashboard.php";
            		}
            		else {
						$('#popup').children('p').remove();
            			$('#popup').append("<p>Oops! We encountered an error while processing your request. Please try again.").fadeIn();                			
            		}
            	},
            	error: function() {
            		$('#alertMsg').children('p').remove();
					$('#alertMsg').fadeOut();
					$('#popup').children('p').remove();
        			$('#popup').append("<p>Oops! We encountered an error while processing your request. Please try again.").fadeIn();                			
            	}
            });
        }   // end of OnBoardLogin()

        function render() {
            // Additional params including the callback, the rest of the params will
            // come from the page-level configuration.
            var additionalParams = {
                'callback': signinCallback
            };

            // the sign up additional parameters.
            var additionalParamsSignup = {
            	'callback': signupCallback
            };

            // for the login button.
            $('#btnGoogleLogin').on('click', function() {
                gapi.auth.signIn(additionalParams);   // Will use page level configuration
            });

            // for the sign up button.
            $('#btnGoogleSignup').on('click', function() {
                gapi.auth.signIn(additionalParamsSignup);   // Will use page level configuration
            });
        }

        // for the google sign in
        function signinCallback(authResult) {

            if (authResult['status']['signed_in']) {
                var primaryEmail = ""; 
                var name = "";
                gapi.client.load('plus', 'v1', function() {
                    // Request1: obtain logged-in member info
                    var request = gapi.client.plus.people.get({
                        'userId': 'me'
                    });

                    //'actor': {'image': {'url': aInfo.image.url}, 'url': aInfo.url, 'displayName': aInfo.displayName},
                    request.execute(function(aInfo) {
                        // prepare author info array for rendering
                        var authorInfo = [
                            {
                                'id': aInfo.id,
                                'published': '',
                                'url': aInfo.url,
                                'title': 'My page at G+',
                                'object': {'content': ''}
                            }
                        ];

                        for (var i=0; i < aInfo.emails.length; i++) {
                            if (aInfo.emails[i].type === 'account') 
                                primaryEmail = aInfo.emails[i].value;
                            }
                        name = aInfo.displayName;    

                        //for the onBoardLogin Call.
                        onBoardLoginGoogle(primaryEmail, name);

                    });  
                });     //end of the load() function
            }    //end of the if condition!!
            else {
                // Update the app to reflect a signed out user
                // Possible error values:
                //   "user_signed_out" - User is signed-out
                //   "access_denied" - User denied access to your app
                //   "immediate_failed" - Could not automatically log in the user
                if(authResult['error'] === 'access_denied') {
                    $('#popup').children('p').remove();
                    $('#popup').append("<p>Access to the app denied. Please try again.</p>").fadeIn('fast');
                }
                console.log('Sign-in state: ' + authResult['error']);
            }
        }   //end of the signinCallback function!! [Google]

        // for the google sign up
        function signupCallback(authResult) {

            if (authResult['status']['signed_in']) {
                var primaryEmail = ""; 
                var name = "";

                gapi.client.load('plus', 'v1', function() {
                    // Request1: obtain logged-in member info
                    var request = gapi.client.plus.people.get({
                        'userId': 'me'
                    });

                    //'actor': {'image': {'url': aInfo.image.url}, 'url': aInfo.url, 'displayName': aInfo.displayName},
                    request.execute(function(aInfo) {
                        // prepare author info array for rendering
                        var authorInfo = [
                            {
                                'id': aInfo.id,
                                'published': '',
                                'url': aInfo.url,
                                'title': 'My page at G+',
                                'object': {'content': ''}
                            }
                        ];

                        for (var i=0; i < aInfo.emails.length; i++) {
                            if (aInfo.emails[i].type === 'account') 
                                primaryEmail = aInfo.emails[i].value;
                            }
                        name = aInfo.displayName;    

                        onBoardSignupGoogle(primaryEmail, name);

                    });  
                });     //end of the load() function
            }    //end of the if condition!!
            else {
                // Update the app to reflect a signed out user
                // Possible error values:
                //   "user_signed_out" - User is signed-out
                //   "access_denied" - User denied access to your app
                //   "immediate_failed" - Could not automatically log in the user
                if(authResult['error'] === 'access_denied') {
                    $('#popup').children('p').remove();
                    $('#popup').append("<p>Access to the app denied. Please try again.</p>").fadeIn('fast');
                }
                console.log('Sign-in state: ' + authResult['error']);
            }
        }   //end of the signupCallback function!! [Google]

    </script>

    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-58931671-1', 'auto');
	  ga('send', 'pageview');

	</script>

</head>

<body id="page-top" class="index">

    <div id="alertMsg" class="alert alert-warning" role="alert">
    </div>

    <div id="popup" class="alert alert-danger" role="alert">
          <button type="button" class="close" id="btnExitPopup" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">MR - Compendium</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                    	<a class="page-scroll" href="#" id="btnLogin">Login</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <!-- <div id="overlay">		
	</div> -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in" style="font-family: writingText;">In this world where knowledge is power, it is important to be aware of the recent developments around you, be it news on the macroeconomic trends or the latest financial deals. With a crisp summary of the important developments in the past quarter, The Compendium is the go-to resource to move one step closer to success.</div>
                <!-- <div class="intro-heading" style="font-family: writingText;">Your resources, all in one place</div> -->
                <button id="btnGetStarted" class="btn btn-lg btn-primary">
	            	Get Started
	            </button>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">About MR - Compendium</h2>
                    <h3 class="section-subheading text-muted">With a crisp summary of the important developments in the past quarter, The Compendium is the go-to resource to move one step closer to success.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/1.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <!-- <h4>2009-2011</h4> -->
                                    <h4 class="subheading">Gain Access to MR-Compendium</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Gain access to this edition of the Compendium, either by invite or buy the edition</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/2.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <!-- <h4>March 2011</h4> -->
                                    <h4 class="subheading">Stimulate your Visual/Audio Memory</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Read the online documents and/or listen to the crisp audio news, all inside one resource, MR-Compendium</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/3.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <!-- <h4>December 2012</h4> -->
                                    <h4 class="subheading">Update Yourself</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Gain insights on the latest macroeconomic news and financial deals, with supplements from Sector Bites and Startup News</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/4.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <!-- <h4>July 2014</h4> -->
                                    <h4 class="subheading">Arm Yourself for the Interviews</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted"> Increase your general awareness, make use of these resources to prepare for B-school interviews or job interviews</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Services</h2>
                    <h3 class="section-subheading text-muted">This can be the place for all the benefits that one can get, after joining MR - Connect.</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-users fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">On-The-Go Flexibility</h4>
                    <p class="text-muted">Access the audios and the reading material anytime, anywhere</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-flash fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Up-to-Date Material</h4>
                    <p class="text-muted">All the latest happenings of the financial work, in crisp, documented and short news articles and audios</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-file-pdf-o fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Viewable Online Docs</h4>
                    <p class="text-muted">View/Read the financial Docs and news, with just a click</p>
                </div>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                    <h3 class="section-subheading text-muted">Put in a message to the MR - Compendium Team and we'd get back to you in 48 hours</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name *" id="txtName" />
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your Email *" id="txtContactEmail" />
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Your Phone *" id="txtContactPhone" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Your Message *" id="txtContactMessage"></textarea>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button id="btnSendMessage" class="btn btn-xl">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; Mentored-Research 2015</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <!-- <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li> -->
                        <li><a href="https://www.facebook.com/pages/Mentored-Researchs-Equity-Research-Initiative/313860081992430?ref=br_tf" target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="https://www.linkedin.com/company/2217419?trk=tyah&trkInfo=tarId%3A1401993298521%2Ctas%3Amentored%2Cidx%3A1-3-3" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">   <!-- TODO -->
                    <ul class="list-inline quicklinks">
                        <li><a href="#" data-modal="#privacyPolicyModal">Privacy Policy</a>
                        </li>
                        <li><a href="#" data-modal="#termsConditionsModal">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- for the login modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Log in to MR - Compendium</h4>
                </div>
                <div class="modal-body col-lg-6 col-md-6"> 

                    <h3>
                        Social Media Login
                    </h3>

                    <button id="btnFbLogin" class="btn btn-lg btn-block btn-social btn-facebook" style="margin: 8% 0% 2% 0%;" onclick="checkLoginState();">    <!-- onclick="checkLoginState();" -->
                        <i class="fa fa-facebook"></i>
                        Facebook Login
                    </button> 

                    <button id="btnGoogleLogin" class="btn btn-lg btn-block btn-social btn-google" style="margin: 3% 0% 2% 0%;">
                        <i class="fa fa-google"></i>
                        Google Login
                    </button>    

                </div>

                <div class="modal-body col-lg-6 col-md-6" id="manualLogin">

                    <h3>
                        Login here                        
                    </h3>

                    <table class="table">
                        <tr>
                            <td>
                                <input type="email" id="txtLoginEmail" placeholder="Email Address *" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" id="txtLoginPwd" placeholder="Password *" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn btn-lg btn-block btn-primary" id="btnLoginManual">Login to Compendium</button>
                            </td>
                        </tr>
                    </table>

                </div>

                <div class="modal-footer">

                    <div style="float:left;">
                        <a href="#" class="quicklinks" data-modal="#privacyPolicyModal">Privacy Policy &nbsp;&nbsp;&nbsp;&nbsp;</a>
                        <a href="#" class="quicklinks"  data-modal="#termsConditionsModal">Terms of Use</a>
                    </div>

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- for the login modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Sign up for MR - Compendium</h4>
                </div>

                <div class="modal-body col-lg-12 col-md-12">

                	<p class="text-center">
                		<a href="#" id="btnAlreadyRegistered">Already Registered? Login here</a>
                	</p>

                	<div class="col-lg-6 col-md-6" id="socialLogin"> 

	                    <h3>
	                        Sign up MR-Compendium
	                    </h3>

	                    <input type="hidden" class="form-control" id="txtCode" placeholder="Enter Invite Code" />

	                    <button id="btnFbSignup" class="btn btn-lg btn-block btn-social btn-facebook" style="margin: 8% 0% 2% 0%;" onclick="checkSignupState();">
	                        <i class="fa fa-facebook"></i>
	                        Facebook Signup
	                    </button> 

	                    <button id="btnGoogleSignup" class="btn btn-lg btn-block btn-social btn-google" style="margin: 3% 0% 2% 0%;">
	                        <i class="fa fa-google"></i>
	                        Google Signup
	                    </button>

	                    <br />

	                    <p class="text-center">
	                		<a href="#" id="otherSignup">Sign up with another Email Address</a>   
	                	</p>
	                    
						<table class="table" id="manualSignupTable">
	                    	<tr>
	                            <td>
	                                <input type="text" id="txtSignupName" placeholder="Your Name *" class="form-control" />
	                            </td>
	                        </tr>
	                        <tr>
	                            <td>
	                                <input type="email" id="txtSignupEmail" placeholder="Email Address *" class="form-control" />
	                            </td>
	                        </tr>
	                        <tr>
	                            <td>
	                                <input type="password" id="txtSignupPwd" placeholder="Password *" class="form-control" />
	                            </td>
	                        </tr>
	                        <tr>
	                            <td>
	                                <button class="btn btn-lg btn-block btn-primary" id="btnSignupManual">Sign up</button>
	                            </td>
	                        </tr>
	                    </table>

	                </div>

	                <div class="col-lg-6 col-md-6" id="buyCompendium">
						<button id="btnBuyCompendium" class="btn btn-lg btn-primary btn-block">
							Buy Compendium for Rs. 349
						</button>
	                </div>

                </div>

                <div class="modal-footer">

                    <div style="float:left;">
                        <a href="#" class="quicklinks" data-modal="#privacyPolicyModal">Privacy Policy &nbsp;&nbsp;&nbsp;&nbsp;</a>
                        <a href="#" class="quicklinks" data-modal="#termsConditionsModal">Terms of Use</a>
                    </div>
                    
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- for the coupons modal -->
    <div class="modal fade" id="couponModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Activate your Compendium</h4>
                </div>
                <div class="modal-body"> 

                	<br /><br />

	                <table class="table">
                		<tr>
                			<td>
                				<input type="text" id="txtCouponCode" class="form-control" placeholder="Enter Coupon code *" />
                			</td>
                		</tr>
                		<tr>
                			<td>
                				<button class="btn btn-lg btn-block btn-primary" id="btnCouponCode">
                					Activate
                				</button>
                			</td>
                		</tr>
	                </table>

                </div>

                <div class="modal-footer">

                    <div style="float:left;">
                        <a href="#" class="quicklinks" data-modal="#privacyPolicyModal">Privacy Policy &nbsp;&nbsp;&nbsp;&nbsp;</a>
                        <a href="#" class="quicklinks"  data-modal="#termsConditionsModal">Terms of Use</a>
                    </div>
                    
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- for the coupons modal -->
    <div class="modal fade" id="requestInviteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Request Invite for Compendium</h4>
                </div>
                <div class="modal-body"> 

                	<br /><br />

	                <table class="table">
                		<tr>
                			<td>
                				<p style="text-align: justify;">
                					<span class="requestSalutation"></span> It appears to us that this email address of yours has not been invited to access Compendium yet. Please request an invite for trying this free service.
                				</p>
                				<p style="text-align: justify;">
                					In case of any other problems, please feel free to drop in a mail at <code>tech@mentored-research.com</code> and we'd get back to you in 48 hours. 
                				</p>
                				<p style="text-align: justify;">
                					Thank You.
                				</p>
                			</td>
                		</tr>
                		<tr>
                			<td>
                				<button class="btn btn-lg btn-block btn-primary" id="btnRequestInvite">
                					Request Invite
                				</button>
                			</td>
                		</tr>
	                </table>

                </div>

                <div class="modal-footer">

                    <div style="float:left;">
                        <a href="#" class="quicklinks" data-modal="#privacyPolicyModal">Privacy Policy &nbsp;&nbsp;&nbsp;&nbsp;</a>
                        <a href="#" class="quicklinks" data-modal="#termsConditionsModal">Terms of Use</a>
                    </div>
                    
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- these are for the privacy policy and the terms and conditions modals -->
    <div class="modal fade" id="privacyPolicyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">
                Privacy Policy
            </h4>
          </div>
          <div class="modal-body" style="font-family: writingText; font-size:1.2em;">
            <b>This Privacy Policy governs the manner in which Mentored-Research collects, uses, maintains and discloses information collected from users (each, a "User") of the http://www.mentored-research.com website ("Site"). This privacy policy applies to the Site and all products and services offered by Mentored-Research. </b>
              <br /><br />
<b>Personal identification information</b>
              <br />
We may collect personal identification information from Users in a variety of ways, including, but not limited to, when Users visit our site, register on the site, place an order, and in connection with other activities, services, features or resources we make available on our Site. Users may be asked for, as appropriate, name, email address, phone number, credit card information. Users may, however, visit our Site anonymously. We will collect personal identification information from Users only if they voluntarily submit such information to us. Users can always refuse to supply personally identification information, except that it may prevent them from engaging in certain Site related activities.
              <br /><br />
<b>Non-personal identification information</b>
              <br />
We may collect non-personal identification information about Users whenever they interact with our Site. Non-personal identification information may include the browser name, the type of computer and technical information about Users means of connection to our Site, such as the operating system and the Internet service providers utilized and other similar information.
              <br /><br />
<b>Web browser cookies</b>
              <br />
Our Site may use "cookies" to enhance User experience. User's web browser places cookies on their hard drive for record-keeping purposes and sometimes to track information about them. User may choose to set their web browser to refuse cookies, or to alert you when cookies are being sent. If they do so, note that some parts of the Site may not function properly.
              <br /><br />
<b>How we use collected information</b>
              <br />
Mentored-Research may collect and use Users personal information for the following purposes:
              <br />
    <ul>
        <li>
            To improve customer service  <br />
            Information you provide helps us respond to your customer service requests and support needs more efficiently.
        </li>
        <li>
            To personalize user experience  <br />
            We may use information in the aggregate to understand how our Users as a group use the services and resources provided on our Site.
        </li>
        <li>
            To improve our Site <br />
    We may use feedback you provide to improve our products and services.
        </li>
        <li>
            To process payments <br />
    We may use the information Users provide about themselves when placing an order only to provide service to that order. We do not share this information with outside parties except to the extent necessary to provide the service.
        </li>
        <li>
            To send periodic emails  <br />
    We may use the email address to send User information and updates pertaining to their order. It may also be used to respond to their inquiries, questions, and/or other requests.
        </li>
    </ul>
             <br />
<b>How we protect your information</b>
              <br />
We adopt appropriate data collection, storage and processing practices and security measures to protect against unauthorized access, alteration, disclosure or destruction of your personal information, username, password, transaction information and data stored on our Site.
              <br />
Sensitive and private data exchange between the Site and its Users happens over a SSL secured communication channel and is encrypted and protected with digital signatures.
              <br /><br />
<b>Sharing your personal information</b>
              <br />
We do not sell, trade, or rent Users personal identification information to others. We may share generic aggregated demographic information not linked to any personal identification information regarding visitors and users with our business partners, trusted affiliates and advertisers for the purposes outlined above.
              <br /><br />
<b>Changes to this privacy policy</b>
              <br />
Mentored-Research has the discretion to update this privacy policy at any time. When we do, we will post a notification on the main page of our Site and send you an email. We encourage Users to frequently check this page for any changes to stay informed about how we are helping to protect the personal information we collect. You acknowledge and agree that it is your responsibility to review this privacy policy periodically and become aware of modifications.
              <br /><br />
<b>Your acceptance of these terms</b>
              <br />
By using this Site, you signify your acceptance of this policy. If you do not agree to this policy, please do not use our Site. Your continued use of the Site following the posting of changes to this policy will be deemed your acceptance of those changes.
              <br /><br />
<b>Contacting us</b>
              <br />
If you have any questions about this Privacy Policy, the practices of this site, or your dealings with this site, please contact us at: <br />
Mentored-Research  <br />
<code>http://www.mentored-research.com </code><br />
<code>info@mentored-research.com </code><br />
              <br />
This document was last updated on November 26, 2014  <br />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- this is for the terms and conditions modal -->
    <div class="modal fade" id="termsConditionsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="H1">Terms and Conditions</h4>
          </div>
          <div class="modal-body" style="font-family: writingText; font-size:1.2em;">
            <b>TERMS OF SERVICE</b>
              <br /><br />
This website is operated by Mentored-Research. Throughout the site, the terms “we”, “us” and “our” refer to Mentored-Research. Mentored-Research offers this website, including all information, tools and services available from this site to you, the user, conditioned upon your acceptance of all terms, conditions, policies and notices stated here.

              <br /><br />

By visiting our site and/ or purchasing something from us, you engage in our “Service” and agree to be bound by the following terms and conditions (“Terms of Service”, “Terms”), including those additional terms and conditions and policies referenced herein and/or available by hyperlink. These Terms of Service apply  to all users of the site, including without limitation users who are browsers, vendors, customers, merchants, and/ or contributors of content.

              <br /><br />

Please read these Terms of Service carefully before accessing or using our website. By accessing or using any part of the site, you agree to be bound by these Terms of Service. If you do not agree to all the terms and conditions of this agreement, then you may not access the website or use any services. If these Terms of Service are considered an offer, acceptance is expressly limited to these Terms of Service.

              <br /><br />

Any new features or tools which are added to the current store shall also be subject to the Terms of Service. You can review the most current version of the Terms of Service at any time on this page. We reserve the right to update, change or replace any part of these Terms of Service by posting updates and/or changes to our website. It is your responsibility to check this page periodically for changes. Your continued use of or access to the website following the posting of any changes constitutes acceptance of those changes.

              <br /><br />

<b>SECTION 1 - ONLINE STORE TERMS</b>
              <br />
By agreeing to these Terms of Service, you represent that you are at least the age of majority in your state or province of residence, or that you are the age of majority in your state or province of residence and you have given us your consent to allow any of your minor dependents to use this site.
              <br />
You may not use our products for any illegal or unauthorized purpose nor may you, in the use of the Service, violate any laws in your jurisdiction (including but not limited to copyright laws).
              <br />
You must not transmit any worms or viruses or any code of a destructive nature.
              <br />
A breach or violation of any of the Terms will result in an immediate termination of your Services.
              <br /><br />

<b>SECTION 2 - GENERAL CONDITIONS</b>
              <br />
We reserve the right to refuse service to anyone for any reason at any time.
              <br />
You understand that your content (not including credit card information), may be transferred unencrypted and involve (a) transmissions over various networks; and (b) changes to conform and adapt to technical requirements of connecting networks or devices. Credit card information is always encrypted during transfer over networks.
              <br />
You agree not to reproduce, duplicate, copy, sell, resell or exploit any portion of the Service, use of the Service, or access to the Service or any contact on the website through which the service is provided, without express written permission by us.
              <br />
The headings used in this agreement are included for convenience only and will not limit or otherwise affect these Terms.
              <br /><br />

<b>SECTION 3 - ACCURACY, COMPLETENESS AND TIMELINESS OF INFORMATION</b>
              <br />
We are not responsible if information made available on this site is not accurate, complete or current. The material on this site is provided for general information only and should not be relied upon or used as the sole basis for making decisions without consulting primary, more accurate, more complete or more timely sources of information. Any reliance on the material on this site is at your own risk.
              <br />
This site may contain certain historical information. Historical information, necessarily, is not current and is provided for your reference only. We reserve the right to modify the contents of this site at any time, but we have no obligation to update any information on our site. You agree that it is your responsibility to monitor changes to our site.
              <br /><br />


<b>SECTION 4 - MODIFICATIONS TO THE SERVICE AND PRICES</b>
              <br />
Prices for our products are subject to change without notice.
              <br />
We reserve the right at any time to modify or discontinue the Service (or any part or content thereof) without notice at any time.
              <br />
We shall not be liable to you or to any third-party for any modification, price change, suspension or discontinuance of the Service.
              <br /><br />

<b>SECTION 5 - PRODUCTS OR SERVICES (if applicable)</b>
              <br />
Certain products or services may be available exclusively online through the website. These products or services may have limited quantities and are subject to return or exchange only according to our Return Policy.
              <br />
We have made every effort to display as accurately as possible the colors and images of our products that appear at the store. We cannot guarantee that your computer monitor's display of any color will be accurate.
              <br />
We reserve the right, but are not obligated, to limit the sales of our products or Services to any person, geographic region or jurisdiction. We may exercise this right on a case-by-case basis. We reserve the right to limit the quantities of any products or services that we offer. All descriptions of products or product pricing are subject to change at anytime without notice, at the sole discretion of us. We reserve the right to discontinue any product at any time. Any offer for any product or service made on this site is void where prohibited.
              <br />
We do not warrant that the quality of any products, services, information, or other material purchased or obtained by you will meet your expectations, or that any errors in the Service will be corrected.
              <br /><br />

<b>SECTION 6 - ACCURACY OF BILLING AND ACCOUNT INFORMATION</b>
              <br />
We reserve the right to refuse any order you place with us. We may, in our sole discretion, limit or cancel quantities purchased per person, per household or per order. These restrictions may include orders placed by or under the same customer account, the same credit card, and/or orders that use the same billing and/or shipping address. In the event that we make a change to or cancel an order, we may attempt to notify you by contacting the e-mail and/or billing address/phone number provided at the time the order was made. We reserve the right to limit or prohibit orders that, in our sole judgment, appear to be placed by dealers, resellers or distributors.
              <br />
You agree to provide current, complete and accurate purchase and account information for all purchases made at our store. You agree to promptly update your account and other information, including your email address and credit card numbers and expiration dates, so that we can complete your transactions and contact you as needed.
              <br />
For more detail, please review our Returns Policy.
              <br /><br />

<b>SECTION 7 - OPTIONAL TOOLS</b>
              <br />
We may provide you with access to third-party tools over which we neither monitor nor have any control nor input.
              <br />
You acknowledge and agree that we provide access to such tools ”as is” and “as available” without any warranties, representations or conditions of any kind and without any endorsement. We shall have no liability whatsoever arising from or relating to your use of optional third-party tools.
              <br />
Any use by you of optional tools offered through the site is entirely at your own risk and discretion and you should ensure that you are familiar with and approve of the terms on which tools are provided by the relevant third-party provider(s).
              <br />
We may also, in the future, offer new services and/or features through the website (including, the release of new tools and resources). Such new features and/or services shall also be subject to these Terms of Service.
              <br /><br />

<b>SECTION 8 - THIRD-PARTY LINKS</b>
              <br />
Certain content, products and services available via our Service may include materials from third-parties.
              <br />
Third-party links on this site may direct you to third-party websites that are not affiliated with us. We are not responsible for examining or evaluating the content or accuracy and we do not warrant and will not have any liability or responsibility for any third-party materials or websites, or for any other materials, products, or services of third-parties.
              <br />
We are not liable for any harm or damages related to the purchase or use of goods, services, resources, content, or any other transactions made in connection with any third-party websites. Please review carefully the third-party's policies and practices and make sure you understand them before you engage in any transaction. Complaints, claims, concerns, or questions regarding third-party products should be directed to the third-party.
              <br /><br />

<b>SECTION 9 - USER COMMENTS, FEEDBACK AND OTHER SUBMISSIONS</b>
              <br />
If, at our request, you send certain specific submissions (for example contest entries) or without a request from us you send creative ideas, suggestions, proposals, plans, or other materials, whether online, by email, by postal mail, or otherwise (collectively, 'comments'), you agree that we may, at any time, without restriction, edit, copy, publish, distribute, translate and otherwise use in any medium any comments that you forward to us. We are and shall be under no obligation (1) to maintain any comments in confidence; (2) to pay compensation for any comments; or (3) to respond to any comments.
              <br />
We may, but have no obligation to, monitor, edit or remove content that we determine in our sole discretion are unlawful, offensive, threatening, libelous, defamatory, pornographic, obscene or otherwise objectionable or violates any party’s intellectual property or these Terms of Service.
              <br />
You agree that your comments will not violate any right of any third-party, including copyright, trademark, privacy, personality or other personal or proprietary right. You further agree that your comments will not contain libelous or otherwise unlawful, abusive or obscene material, or contain any computer virus or other malware that could in any way affect the operation of the Service or any related website. You may not use a false e-mail address, pretend to be someone other than yourself, or otherwise mislead us or third-parties as to the origin of any comments. You are solely responsible for any comments you make and their accuracy. We take no responsibility and assume no liability for any comments posted by you or any third-party.
              <br /><br />


<b>SECTION 10 - PERSONAL INFORMATION</b>
              <br />
Your submission of personal information through the store is governed by our Privacy Policy. To view our Privacy Policy.

              <br /><br />

<b>SECTION 11 - ERRORS, INACCURACIES AND OMISSIONS</b>
              <br />
Occasionally there may be information on our site or in the Service that contains typographical errors, inaccuracies or omissions that may relate to product descriptions, pricing, promotions, offers, product shipping charges, transit times and availability. We reserve the right to correct any errors, inaccuracies or omissions, and to change or update information or cancel orders if any information in the Service or on any related website is inaccurate at any time without prior notice (including after you have submitted your order).
              <br />
We undertake no obligation to update, amend or clarify information in the Service or on any related website, including without limitation, pricing information, except as required by law. No specified update or refresh date applied in the Service or on any related website, should be taken to indicate that all information in the Service or on any related website has been modified or updated.
              <br /><br />


<b>SECTION 12 - PROHIBITED USES</b>
              <br />
In addition to other prohibitions as set forth in the Terms of Service, you are prohibited from using the site or its content: (a) for any unlawful purpose; (b) to solicit others to perform or participate in any unlawful acts; (c) to violate any international, federal, provincial or state regulations, rules, laws, or local ordinances; (d) to infringe upon or violate our intellectual property rights or the intellectual property rights of others; (e) to harass, abuse, insult, harm, defame, slander, disparage, intimidate, or discriminate based on gender, sexual orientation, religion, ethnicity, race, age, national origin, or disability; (f) to submit false or misleading information; (g) to upload or transmit viruses or any other type of malicious code that will or may be used in any way that will affect the functionality or operation of the Service or of any related website, other websites, or the Internet; (h) to collect or track the personal information of others; (i) to spam, phish, pharm, pretext, spider, crawl, or scrape; (j) for any obscene or immoral purpose; or (k) to interfere with or circumvent the security features of the Service or any related website, other websites, or the Internet. We reserve the right to terminate your use of the Service or any related website for violating any of the prohibited uses.
              <br />
              <br />

<b>SECTION 13 - DISCLAIMER OF WARRANTIES; LIMITATION OF LIABILITY</b>
              <br />
We do not guarantee, represent or warrant that your use of our service will be uninterrupted, timely, secure or error-free.
              <br />
We do not warrant that the results that may be obtained from the use of the service will be accurate or reliable.
              <br />
You agree that from time to time we may remove the service for indefinite periods of time or cancel the service at any time, without notice to you.
              <br />
You expressly agree that your use of, or inability to use, the service is at your sole risk. The service and all products and services delivered to you through the service are (except as expressly stated by us) provided 'as is' and 'as available' for your use, without any representation, warranties or conditions of any kind, either express or implied, including all implied warranties or conditions of merchantability, merchantable quality, fitness for a particular purpose, durability, title, and non-infringement.
              <br />
In no case shall Mentored-Research, our directors, officers, employees, affiliates, agents, contractors, interns, suppliers, service providers or licensors be liable for any injury, loss, claim, or any direct, indirect, incidental, punitive, special, or consequential damages of any kind, including, without limitation lost profits, lost revenue, lost savings, loss of data, replacement costs, or any similar damages, whether based in contract, tort (including negligence), strict liability or otherwise, arising from your use of any of the service or any products procured using the service, or for any other claim related in any way to your use of the service or any product, including, but not limited to, any errors or omissions in any content, or any loss or damage of any kind incurred as a result of the use of the service or any content (or product) posted, transmitted, or otherwise made available via the service, even if advised of their possibility. Because some states or jurisdictions do not allow the exclusion or the limitation of liability for consequential or incidental damages, in such states or jurisdictions, our liability shall be limited to the maximum extent permitted by law.
              <br /><br />


<b>SECTION 14 - INDEMNIFICATION</b>
              <br />
You agree to indemnify, defend and hold harmless Mentored-Research and our parent, subsidiaries, affiliates, partners, officers, directors, agents, contractors, licensors, service providers, subcontractors, suppliers, interns and employees, harmless from any claim or demand, including reasonable attorneys’ fees, made by any third-party due to or arising out of your breach of these Terms of Service or the documents they incorporate by reference, or your violation of any law or the rights of a third-party.
              <br /><br />

<b>SECTION 15 - SEVERABILITY</b>
              <br />
In the event that any provision of these Terms of Service is determined to be unlawful, void or unenforceable, such provision shall nonetheless be enforceable to the fullest extent permitted by applicable law, and the unenforceable portion shall be deemed to be severed from these Terms of Service, such determination shall not affect the validity and enforceability of any other remaining provisions.
              <br /><br />

<b>SECTION 16 - TERMINATION</b>
              <br />

The obligations and liabilities of the parties incurred prior to the termination date shall survive the termination of this agreement for all purposes.
              <br />
These Terms of Service are effective unless and until terminated by either you or us. You may terminate these Terms of Service at any time by notifying us that you no longer wish to use our Services, or when you cease using our site.
              <br />
If in our sole judgment you fail, or we suspect that you have failed, to comply with any term or provision of these Terms of Service, we also may terminate this agreement at any time without notice and you will remain liable for all amounts due up to and including the date of termination; and/or accordingly may deny you access to our Services (or any part thereof).
              <br />
              <br />

<b>SECTION 17 - ENTIRE AGREEMENT</b>
              <br />
The failure of us to exercise or enforce any right or provision of these Terms of Service shall not constitute a waiver of such right or provision.
              <br />
These Terms of Service and any policies or operating rules posted by us on this site or in respect to The Service constitutes the entire agreement and understanding between you and us and govern your use of the Service, superseding any prior or contemporaneous agreements, communications and proposals, whether oral or written, between you and us (including, but not limited to, any prior versions of the Terms of Service).
              <br />
Any ambiguities in the interpretation of these Terms of Service shall not be construed against the drafting party.
              <br /><br />


<b>SECTION 18 - GOVERNING LAW</b>
              <br />
These Terms of Service and any separate agreements whereby we provide you Services shall be governed by and construed in accordance with the laws of BITS-Pilani, Hyderabad Campus Hyderabad Telangana India 500078.
              <br />
              <br />

<b>SECTION 19 - CHANGES TO TERMS OF SERVICE</b>
              <br />
You can review the most current version of the Terms of Service at any time at this page.
              <br />
We reserve the right, at our sole discretion, to update, change or replace any part of these Terms of Service by posting updates and changes to our website. It is your responsibility to check our website periodically for changes. Your continued use of or access to our website or the Service following the posting of any changes to these Terms of Service constitutes acceptance of those changes.
              <br /><br />


<b>SECTION 20 - CONTACT INFORMATION</b>
              <br />
Questions about the Terms of Service should be sent to us at <code>info@mentored-research.com.</code>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery -->
    <!-- <script src="js/jquery.js"></script> -->
    <!-- <script src="js/jquery-1.7.1.min.js"></script> -->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <!-- <script src="js/contact_me.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>

</body>

</html>
