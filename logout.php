<!DOCTYPE html>

<html lang="en">
	
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="Mentored-Research Compendium" content="Compendium by Mentored-Research, Mentored-Research">
    <meta name="author" content="Sagar anand, Mentored-Research Tech Team, MR Compendium">

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="img/favicon.ico" type="image/x-icon" />

    <title>MR - Compendium logout</title>

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

		p, h1, button {
			font-family: writingText;
		}

        /*for the tablets and all*/
        @media (min-width:768px){
             .work-filter {
	    	    /*margin: 4% 0 0 0%;*/
	    	    margin-top: 10%;
	    	    font-family: regularText;
	        }
        }

        /*for medium screens and desktops*/
        @media (min-width:992px){
             .work-filter {
	    	    /*margin: 4% 0 0 0%;*/
	    	    margin-top: 10%;
	    	    font-family: regularText;
	        }
        }

        /*for large screens*/ 
        @media (min-width:1200px){
             .work-filter {
	    	    /*margin: 4% 0 0 0%;*/
	    	    margin-top: 8%;
	    	    font-family: regularText;
	        }
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

        });
    </script>

    <body id="page-top" class="index">
		
    	<img src="img/aluminiBack.png" style="width: 100%; z-index: -2; position: fixed;" />

		<div id="alertMsg" class="alert alert-warning" role="alert">
		</div>

		<div id="popup" class="alert alert-danger" role="alert">
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
	                    	<a href="#" class="page-scroll">Login</a>
	                    </li>
	                    <li>
	                    	<a href="http://mentored-research.com/Compendium" id="home" class="page-scroll">Home</a>
	                    </li>
	                </ul>
	            </div>

	    	</div>
	    </nav>


	    <div class="container navLinks work-filter" id="navDiv" >
	    	<div class="row">	
				<h1 class="page-header" style="font-size:8em;"> Thank You. </h1>
	        	<p style="font-size: 1.3em;" id="txtError">
		            You have been successfully logged out. Thank You for using MR - Compendium.
		            <br /><br />
		        </p>    			
	    	</div>
	    </div>

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