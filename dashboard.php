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

            	alert(selector);

            	

            	return false;
            });

    	});	

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

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel" >
				<a class="thumbnail macro">
					<img src="img/macroeconomic/dummy.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Caption 1
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel">
				<a class="thumbnail macro">
					<img src="img/macroeconomic/dummy.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Caption 1
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel">
				<a class="thumbnail macro">
					<img src="img/macroeconomic/dummy.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Caption 1
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel">
				<a class="thumbnail macro">
					<img src="img/macroeconomic/dummy.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3 class="centered">
							Caption 1
						</h3>
					</div>
				</a>
			</div>
		</div>

		<div class="row divsMain" id="financialDiv"> 

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel">
				<a class="thumbnail financial">
					<img src="img/financial/dummy.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Caption 1
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel">
				<a class="thumbnail financial">
					<img src="img/financial/dummy.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Caption 1
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel">
				<a class="thumbnail financial">
					<img src="img/financial/dummy.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Caption 1
						</h3>
					</div>
				</a>
			</div>

		</div>   <!-- end of financial deals -->

		<div class="row divsMain" id="sectorDiv"> 

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel">
				<a class="thumbnail sector">
					<img src="img/financial/dummy.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Caption 1
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel">
				<a class="thumbnail sector">
					<img src="img/financial/dummy.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Caption 1
						</h3>
					</div>
				</a>
			</div>

		</div>   <!-- end of sector bites deals -->

		<div class="row divsMain" id="startupDiv"> 

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel">
				<a class="thumbnail startup">
					<img src="img/financial/dummy.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Caption 1
						</h3>
					</div>
				</a>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 thumbPanel">
				<a class="thumbnail startup">
					<img src="img/financial/dummy.jpg" class="thumbnailImage" />
					<div class="caption">
						<h3>
							Caption 1
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
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

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