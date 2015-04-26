<?php
		session_start();
		if(isset($_SESSION['username'])){
		redirect("http://localhost/index.php",0.0);
	   
		}	

			
			function redirect($url, $statusCode = 303)
			{
			header('Location: ' . $url, true, $statusCode);
			die();
		}
	
			?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Register</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/icomoon-social.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="css/leaflet.css" />
		<!--[if lte IE 8]>
		    <link rel="stylesheet" href="css/leaflet.ie.css" />
		<![endif]-->
		<link rel="stylesheet" href="css/main.css">

        <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script>
        function check_password()
        {
        	// checking whether the password length are equal or not

        	var pass = document.getElementById("register-password").value;
        	var pass1 = document.getElementById("register-password2").value;
        	//alert(pass);
        	if(pass != pass1)
        	{
        		document.getElementById("display_error").innerHTML = "passwords don't match";
        		return false;
        	}
        }
        </script>
    </head>
 <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        

        <!-- Navigation & Logo-->
        <div class="mainmenu-wrapper">
	        <div class="container">
	        <br>
		        <nav id="mainmenu" class="mainmenu">
					<ul>
						<li class="logo-wrapper"><a href=""><img src="img/icon2.jpg" alt="Tripbook Icon"></a></li>
						
					
						
					</ul>
				</nav>
			</div>
		</div>


        <!-- Page Title -->
		<div class="section section-breadcrumbs" style="background-color:#007FFF">
			<div class="container">
				<div class="row">
					<div class="col-md-10" >
						<h1>Register</h1>
					</div>
				</div>
			</div>
		</div>
        <div class="section">
	    	<div class="container">
				<div class="row">
					<div class="col-sm-5">
						<div class="basic-login">
							<form role="form" method="post" action="signup.php" onsubmit="return check_password()">
								<div class="form-group">
		        				 	<label for="register-username"><i class="icon-user"></i> <b>Email</b></label>
									<input class="form-control" id="register-username" name="register-username" 
									type="email" placeholder="" required>
								</div>
								<div class="form-group">
		        				 	<label for="register-username2"><i class="icon-user"></i> <b>User Name</b></label>
									<input class="form-control" id="register-username2" name="register-username2" 
									type="text" placeholder="" required>
								</div>
								<div class="form-group">
		        				 	<label for="register-password"><i class="icon-lock"></i> <b>Password</b></label>
									<input class="form-control" id="register-password" name="register-password" type="password" placeholder="" pattern=".{6,}" title="minimum length of 6 charecters" required>
								</div>
								<div class="form-group">
		        				 	<label for="register-password2"><i class="icon-lock"></i> <b>Re-enter Password</b></label>
									<input class="form-control" id="register-password2" name="register-password2" 
									type="password" placeholder="" pattern=".{6,}" title="minimum length of 6 charecters" required>
								</div>
								<div class="form-group">
									<button type="submit" class="btn pull-right" >Register</button>
									<div class="clearfix"></div><div id="display_error" style="color:red;"></div>
								</div>

								<div class="clearfix"></div>
									<div class="not-member">
							<h3>Have an Account? <a href="page-login.php">Login</a></h3>
					
						</div>
							</form>
						</div>
					</div>
				<div class="col-sm-7 social-login" style="width:50%">
					
							
		    			<h3><a "demo.html" >Take a Tour</a></h3>
		    			<div class="portfolio-item">
							<div class="portfolio-image" >
								<a href="demo.html"><img src="img/takedemo.JPG" width="450" height="200" alt="Project Name"/><img src="img/takeademo.png"sclass="img-responsivealt"="Project Name"></a>
							</div>
						</div>
		    		
						
						
					</div>
				</div>
			</div>
		</div>

	    <!-- Footer -->
	    <div class="footer">
	    	<div class="container">
		    	<div class="row">

		    		<div class="col-footer col-md-3 col-xs-6">
		    			<h3>Navigate</h3>
		    			<ul class="no-list-style footer-navigate-section">
		    				<li><a href="#">Home</a></li>
		    				<li><a href="ItineraryPlanner.php">Itinerary Planner</a></li>
		    				<li><a href="TripDiary.php">Trip Diary</a></li>
		    				<li><a href="indexreview.php">Reviews</a></li>
		    				
		    			</ul>
		    		</div>
		    		
		    		<div class="col-footer col-md-4 col-xs-6">
		    			<h3>Contacts</h3>
		    			<p class="contact-us-details">
	        				<b>Address:</b> Pesit,BSK stage 3,Bangalore,Karnataka,India<br/>
	        				<b>Phone:</b> +91 1234567890<br/>
	        				<b>Email:</b> <a href="mailto:getintoutch@pes.edu">getintoutch@pes.edu</a>
	        			</p>
		    		</div>
		    		<div class="col-footer col-md-2 col-xs-6">
		    			<h3>Stay Connected</h3>
		    			<ul class="footer-stay-connected no-list-style">
		    				<li><a href="#" class="facebook"></a></li>
		    				<li><a href="#" class="twitter"></a></li>
		    				<li><a href="#" class="googleplus"></a></li>
		    			</ul>
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="footer-copyright">&copy; 2015 TripBook. All rights reserved.</div>
		    		</div>
		    	</div>
		    </div>
	    </div>

        <!-- Javascripts -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="js/bootstrap.min.js"></script>
        <script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
        <script src="js/jquery.fitvids.js"></script>
        <script src="js/jquery.sequence-min.js"></script>
        <script src="js/jquery.bxslider.js"></script>
        <script src="js/main-menu.js"></script>
        <script src="js/template.js"></script>

    </body>
</html>