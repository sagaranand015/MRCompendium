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

    <!-- animation thing -->
    <link rel="stylesheet" href="css/animate.css">

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

        .work-filter ul li {
		    display: inline-block;
		}

		.work-filter ul li a {
		  color: #000;
		  display: block;
		  font-size: 1.4em;
		  font-weight: 700;
		  padding: 5px 17px;
		  border-radius: 6px;
		  text-transform: capitalize;
		  font-family: writingText;
		}

		.work-filter ul li a:hover,
		.work-filter ul li a.active {
		  background-color: #428bca;
		  font-family: writingText;
		  border-radius: 6px;
		  color: #fff;
		  padding: 5px 17px;
		}

		.contentDiv {
			margin-top: 3%;
		}

		/*for the smallest phones*/ 
        @media (max-width:767px){
            .work-filter {
	    	    /*margin: 2% 0 0 0%;*/
	    	    margin-top: 15%;
	    	    font-family: regularText;
	        }
        }   

        /*for the tablets and all*/
        @media (min-width:768px){
             .work-filter {
	    	    /*margin: 4% 0 0 0%;*/
	    	    margin-top: 12%;
	    	    font-family: regularText;
	        }
        }

        /*for medium screens and desktops*/
        @media (min-width:992px){
             .work-filter {
	    	    /*margin: 4% 0 0 0%;*/
	    	    margin-top: 12%;
	    	    font-family: regularText;
	        }
        }

        /*for large screens*/ 
        @media (min-width:1200px){
             .work-filter {
	    	    /*margin: 4% 0 0 0%;*/
	    	    margin-top: 10%;
	    	    font-family: regularText;
	        }
        }
    
        .thumbnailImage {
        	margin-top: 3%;
        	width: 200px;
        	height: 200px;
        	border-radius: 50%;
        }

        .thumbnail h3 {
        	text-align: center;
        }

        footer {
        	background: rgb(233, 233, 233);
        }

        .contentDiv {
        	margin-bottom: 5%;
        }

        ul.quicklinks li a {
        	color: #000;
        }

        .thumbnail {
        	cursor: pointer;
        }

        h3 {
        	font-family: writingText;
        }

        .modal {
        	position: fixed;
        	overflow: auto;
        }

        .modalImg {
        	width: 100%;
        	height: 100%;
        }

    </style>

    <script type="text/javascript">

    	$(document).ready(function() {

            var alertMsg = $('#alertMsg').fadeOut();
            var popup = $('#popup').fadeOut();    

            $('#btnExitPopup').on('click', function() {
                popup.children('p').remove();
                popup.fadeOut();
                return false;
            });

            var contentModal = $('#contentModal');
            var contentModalTitle = $('#contentModalTitle');
            var contentModalBody = $('#contentModalBody');

            var macroeconomicDiv = $('#macroeconomicDiv');
            var financialDiv = $('#financialDiv').hide();
            var sectorDiv = $('#sectorDiv').hide();
            var startupDiv = $('#startupDiv').hide();

            var q = getQueryStrings();

            // for the welcome text.
            var name = getCookie("userName");
            if(name == "") {
            	$('.welcomeText').html("Welcome!");
            }
            else {
        		$('.welcomeText').html("Welcome, " + name + "!");
            }

            // this is for showing the correct content div on click of the nav links.
            $('a.filter').on('click', function() {
            	var selector = $(this).attr('data-filter');

            	if($(this).hasClass('active')) {

            	}
            	else {
            		if(selector == "macroeconomic") {
	            		changeActiveState(this);
	            		showDiv(macroeconomicDiv);
	            	}
	            	else if(selector == "financial") {
	            		changeActiveState(this);
	            		showDiv(financialDiv);
	            	}
	            	else if(selector == "sector") {
	            		changeActiveState(this);
	            		showDiv(sectorDiv);
	            	}
	            	else if(selector == "startups") {
	            		changeActiveState(this);
	            		showDiv(startupDiv);
	            	}
	            	else {
	            		popup.children('p').remove();
	            		popup.append("<p>Oops! We encountered an error during this operation. Please try again.</p>").fadeIn();
	            	}
            	}
            	return false;
            });

            // for the logout functionality
            $('#logout').on('click', function() {
            	setCookie("userEmail", "", 1);
            	setCookie("userName", "", 1);
            	window.location.href = "logout.php";
            	return false;
            });

            // for clicking on each of the thumnail panels.
            $('.thumbPanel').on('click', function() {
            	var selector = "";
            	var panels = $('a.filter');

            	$.each(panels, function() {
            		if($(this).hasClass('active')) {
            			selector = $(this).attr('data-filter');
            		}
            	});

            	// clear the content Modal here.
            	contentModalTitle.html("");
            	contentModalBody.html("");

            	if(selector == "macroeconomic") {

            		if($(this).attr('data-item') == "australia") {   // for the australia macroEconomic news.
            			contentModalTitle.html("MacroEconomic News - Australia");
            			contentModalBody.html("<img class='modalImg' src='content/macroeconomic/australia/1.jpg' alt='1' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/macroeconomic/australia/2.jpg' alt='2' />"  + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/macroeconomic/australia/3.jpg' alt='3' />"  + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "china") {   // for the chine macroEconomic news.
            			contentModalTitle.html("MacroEconomic News - China");
            			contentModalBody.html("<img class='modalImg' src='content/macroeconomic/china/1.jpg' alt='1' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/macroeconomic/china/2.jpg' alt='2' />"  + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "crudeOil") {   // for the Crude Oil macroEconomic news.
            			contentModalTitle.html("MacroEconomic News - Crude Oil");
            			contentModalBody.html("<img class='modalImg' src='content/macroeconomic/crudeOil/1.jpg' alt='1' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/macroeconomic/crudeOil/2.jpg' alt='2' />"  + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "germany") {   // for the Germany macroEconomic news.
            			contentModalTitle.html("MacroEconomic News - Germany");
            			contentModalBody.html("<img class='modalImg' src='content/macroeconomic/germany/1.jpg' alt='1' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/macroeconomic/germany/2.jpg' alt='2' />"  + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "gold") {   // for the Gold macroEconomic news.
            			contentModalTitle.html("MacroEconomic News - Gold");
            			contentModalBody.html("<img class='modalImg' src='content/macroeconomic/gold/1.jpg' alt='1' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/macroeconomic/gold/2.jpg' alt='2' />"  + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "india") {   // for the India macroEconomic news.
            			contentModalTitle.html("MacroEconomic News - India");
            			contentModalBody.html("<img class='modalImg' src='content/macroeconomic/india/1.jpg' alt='1' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/macroeconomic/india/2.jpg' alt='2' />"  + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "singapore") {   // for the Singapore macroEconomic news.
            			contentModalTitle.html("MacroEconomic News - Singapore");
            			contentModalBody.html("<img class='modalImg' src='content/macroeconomic/singapore/1.jpg' alt='1' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/macroeconomic/singapore/2.jpg' alt='2' />"  + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "usa") {   // for the USA macroEconomic news.
            			contentModalTitle.html("MacroEconomic News - USA");
            			contentModalBody.html("<img class='modalImg' src='content/macroeconomic/usa/1.jpg' alt='1' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/macroeconomic/usa/2.jpg' alt='2' />"  + "<br />");
            			contentModal.modal('show');
            		}
            		else {
            			popup.children('p').remove();
	            		popup.append("<p>Oops! We encountered an error during this operation. Please try again.</p>").fadeIn();
            		}
            	}
            	else if(selector == "financial") {

            		if($(this).attr('data-item') == "MA") {   // for the Mergers and Acquisitions financial Deals
            			contentModalTitle.html("Financial Deals - Mergers and Acquisitions");
            			contentModalBody.html("<img class='modalImg' src='content/financial/ma/1.jpg' alt='1' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/financial/ma/2.jpg' alt='2' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/financial/ma/3.jpg' alt='3' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/financial/ma/4.jpg' alt='4' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/financial/ma/5.jpg' alt='5' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/financial/ma/6.jpg' alt='6' />" + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "PE") {   // for the Private Equity financial Deals
            			contentModalTitle.html("Financial Deals - Private Equity Deals");
            			contentModalBody.html("<img class='modalImg' src='content/financial/pe/1.jpg' alt='1' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/financial/pe/2.jpg' alt='2' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/financial/pe/3.jpg' alt='3' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/financial/pe/4.jpg' alt='4' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/financial/pe/5.jpg' alt='5' />" + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "VC") {   // for the Private Equity financial Deals
            			contentModalTitle.html("Financial Deals - Venture Capital Deals");
            			contentModalBody.html("<img class='modalImg' src='content/financial/vc/1.jpg' alt='1' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/financial/vc/2.jpg' alt='2' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/financial/vc/3.jpg' alt='3' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/financial/vc/4.jpg' alt='4' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/financial/vc/5.jpg' alt='5' />" + "<br />");
            			contentModal.modal('show');
            		}
            		else {
            			popup.children('p').remove();
	            		popup.append("<p>Oops! We encountered an error during this operation. Please try again.</p>").fadeIn();
            		}
            	}
            	else if(selector == "sector") {
            		
            		if($(this).attr('data-item') == "food") {
            			contentModalTitle.html("Sector Bites - Food Startups");
            			contentModalBody.html("<img class='modalImg' src='content/sector/food/1.jpg' alt='1' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/sector/food/2.jpg' alt='2' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/sector/food/3.jpg' alt='3' />" + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "health") {
            			contentModalTitle.html("Sector Bites - Health Startups");
            			contentModalBody.html("<img class='modalImg' src='content/sector/health/1.jpg' alt='1' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/sector/health/2.jpg' alt='2' />" + "<br />");
            			contentModalBody.append("<img class='modalImg' src='content/sector/health/3.jpg' alt='3' />" + "<br />");
            			contentModal.modal('show');
            		}
            		else {
            			popup.children('p').remove();
	            		popup.append("<p>Oops! We encountered an error during this operation. Please try again.</p>").fadeIn();
            		}

            	}
            	else if(selector == "startups") {
            		
            		if($(this).attr('data-item') == "9GAG") {
            			contentModalTitle.html("Startups - 9GAG");
            			contentModalBody.html("<img class='modalImg' src='content/startups/9GAG.jpg' alt='1' />" + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "BOOKMYSHOW") {
            			contentModalTitle.html("Startups - BOOK MY SHOW");
            			contentModalBody.html("<img class='modalImg' src='content/startups/BOOKMYSHOW.jpg' alt='1' />" + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "EVENTBRITE") {
            			contentModalTitle.html("Startups - EVENT BRITE");
            			contentModalBody.html("<img class='modalImg' src='content/startups/EVENTBRITE.jpg' alt='1' />" + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "FRESHDESK") {
            			contentModalTitle.html("Startups - FRESH DESK");
            			contentModalBody.html("<img class='modalImg' src='content/startups/FRESHDESK.jpg' alt='1' />" + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "GOIBIBO") {
            			contentModalTitle.html("Startups - GOIBIBO");
            			contentModalBody.html("<img class='modalImg' src='content/startups/GOIBIBO.jpg' alt='1' />" + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "MYNTRA") {
            			contentModalTitle.html("Startups - MYNTRA");
            			contentModalBody.html("<img class='modalImg' src='content/startups/MYNTRA.jpg' alt='1' />" + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "QUORA") {
            			contentModalTitle.html("Startups - QUORA");
            			contentModalBody.html("<img class='modalImg' src='content/startups/QUORA.jpg' alt='1' />" + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "SPACEX") {
            			contentModalTitle.html("Startups - SPACE X");
            			contentModalBody.html("<img class='modalImg' src='content/startups/SPACEX.jpg' alt='1' />" + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "TESLA") {
            			contentModalTitle.html("Startups - TESLA MOTORS");
            			contentModalBody.html("<img class='modalImg' src='content/startups/TESLA.jpg' alt='1' />" + "<br />");
            			contentModal.modal('show');
            		}
            		else if($(this).attr('data-item') == "ZOMATO") {
            			contentModalTitle.html("Startups - ZOMATO");
            			contentModalBody.html("<img class='modalImg' src='content/startups/ZOMATO.jpg' alt='1' />" + "<br />");
            			contentModal.modal('show');
            		}
            		else {
            			popup.children('p').remove();
	            		popup.append("<p>Oops! We encountered an error during this operation. Please try again.</p>").fadeIn();	
            		}

            	}
            	else {
            		popup.children('p').remove();
            		popup.append("<p>Oops! We encountered an internal error while processing your request. Please try again.</p>");
            	}

            	return false;
            });

            // for the privacy policy and terms of use modal.
            $('ul.quicklinks li a').on('click', function() {
				$('.modal').modal('hide');
				var item = $(this).attr('data-modal');

				if(item == "#privacyPolicyModal") {
					$('#privacyPolicyModal').modal('show');
				}
				else if(item == "#termsConditionsModal") {
					$('#termsConditionsModal').modal('show');
				}
				return false;
			});

    	});	

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

	<img src="img/aluminiBack.png" style="width: 100%; z-index: -2; position: fixed;" />

    <div id="alertMsg" class="alert alert-warning" role="alert">
    </div>

    <div id="popup" class="alert alert-danger" role="alert">
          <button type="button" class="close" id="btnExitPopup" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-shrink" id="navigationDiv">
    	<div class="container">

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
                    	<a href="#" id="logout">Logout</a>
                    </li>
                </ul>
            </div>

    	</div>
    </nav>

    <!-- for the pill buttons on the top -->
    <div class="container navLinks" id="navDiv" >
    	<div class="row">

			<div class="work-filter wow fadeInRight animated" data-wow-duration="500ms">

			<h1 class="page-header welcomeText" style="font-family: writingText;">
					
		    	</h1>

				<ul class="text-center">
					<!-- <li><a href="#" data-filter="all" class="active filter">All</a></li> -->
					<li><a href="javascript:;" data-filter="macroeconomic" class="active filter">MacroEconomic Insights</a></li>
					<li><a href="javascript:;" data-filter="financial" class="filter">Financial Deals</a></li>
					<li><a href="javascript:;" data-filter="sector" class="filter">Sector Bites</a></li>
					<li><a href="javascript:;" data-filter="startups" class="filter">Startups</a></li>
				</ul>
			</div>

    	</div>
    </div>

    <!-- for the main content after the pills -->
    <div class="container contentDiv wow fadeInRight animated" id="contentContainer">

		<div class="row divsMain" id="macroeconomicDiv">

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="india">
				<a class="thumbnail macro">
					<img src="img/macroeconomic/india.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							India
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="australia">
				<a class="thumbnail macro">
					<img src="img/macroeconomic/australia.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Australia
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="germany" >
				<a class="thumbnail macro">
					<img src="img/macroeconomic/germany.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Germany
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="china">
				<a class="thumbnail macro">
					<img src="img/macroeconomic/china.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							China
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="singapore">
				<a class="thumbnail macro">
					<img src="img/macroeconomic/singapore.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Singapore
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="usa">
				<a class="thumbnail macro">
					<img src="img/macroeconomic/usa.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							USA
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="crudeOil">
				<a class="thumbnail macro">
					<img src="img/macroeconomic/crude.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Crude Oil
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="gold">
				<a class="thumbnail macro">
					<img src="img/macroeconomic/gold.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Gold
						</h3>
					</div>
				</a>
			</div>
		</div>

		<div class="row divsMain" id="financialDiv"> 

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="MA">
				<a class="thumbnail financial">
					<img src="img/financial/1.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Mergers & Acquisitions
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="PE">
				<a class="thumbnail financial">
					<img src="img/financial/2.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Private Equity Deals
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="VC">
				<a class="thumbnail financial">
					<img src="img/financial/3.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Venture Capitals
						</h3>
					</div>
				</a>
			</div>

		</div>   <!-- end of financial deals -->

		<div class="row divsMain" id="sectorDiv"> 

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="food">
				<a class="thumbnail sector">
					<img src="img/sector/1.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Food Startups
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="health">
				<a class="thumbnail sector">
					<img src="img/sector/2.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Health Startups
						</h3>
					</div>
				</a>
			</div>

		</div>   <!-- end of sector bites deals -->

		<div class="row divsMain" id="startupDiv"> 

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="9GAG">
				<a class="thumbnail startup">
					<img src="img/startups/9gag.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							9GAG - modified.
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="BOOKMYSHOW">
				<a class="thumbnail startup">
					<img src="img/startups/bookmyshow.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							BOOK MY SHOW
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="EVENTBRITE">
				<a class="thumbnail startup">
					<img src="img/startups/eventbrite.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							EVENT BRITE
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="FRESHDESK">
				<a class="thumbnail startup">
					<img src="img/startups/freshdesk.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							FRESH DESK
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="GOIBIBO">
				<a class="thumbnail startup">
					<img src="img/startups/goibibo.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							GOIBIBO
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="MYNTRA">
				<a class="thumbnail startup">
					<img src="img/startups/myntra.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							MYNTRA
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="QUORA">
				<a class="thumbnail startup">
					<img src="img/startups/quora.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							QUORA
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="SPACEX">
				<a class="thumbnail startup">
					<img src="img/startups/spaceX.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							SPACE X
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="TESLA">
				<a class="thumbnail startup">
					<img src="img/startups/tesla.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							TESLA MOTORS
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" data-item="ZOMATO">
				<a class="thumbnail startup">
					<img src="img/startups/zomato.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							ZOMATO
						</h3>
					</div>
				</a>
			</div>

		</div>   <!-- end of Startups deals -->

    </div>    <!-- end of main content div, contentContainer -->

    <!-- for the footer here -->
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

    <!-- this is for the content modal. The data in this modal loads from jQuery -->
     <!-- this is for the terms and conditions modal -->
    <div class="modal fade" id="contentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" oncontextmenu="return false">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="contentModalTitle"></h4>
          </div>
          <div class="modal-body" id="contentModalBody" style="font-family: writingText; font-size:1.2em;">


          </div>
          <div class="modal-footer">
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

	<!-- jquery easing -->
    <script src="js/wow.min.js"></script>
	<script>
		var wow = new WOW ({
			boxClass:     'wow',      // animated element css class (default is wow)
			animateClass: 'animated', // animation css class (default is animated)
			offset:       120,          // distance to the element when triggering the animation (default is 0)
			mobile:       false,       // trigger animations on mobile devices (default is true)
			live:         true        // act on asynchronously loaded content (default is true)
		  }
		);
		wow.init();
	</script> 

	<!-- the latest jQuery CDN -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script> -->

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>


</body>

</html>