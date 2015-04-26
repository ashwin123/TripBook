<?php
									//$place=$_POST['place'];
									//$days =$_POST['days'];
									//$date1=$_POST['date1'];
									//$date2=$_POST['date2'];
session_start();

error_reporting (E_ALL ^ E_NOTICE);
if(isset($_SESSION['username']))
{
	echo "<p style = 'background-color:white; margin:0; padding:0;'><b>Welcome, ";
	echo $_SESSION['username2'];
	echo "</b>";
	//echo "<div style='clear:right;background-color:white; margin:0; padding:0; float:right;margin-bottom:25px;'></div>";
}


else
{
	// redirecting the user to index.html if he is not logged in as he can use itenary planner when not logge din
	echo "<script>alert('you must be logged in first')</script>";
	echo "<script type='text/javascript'> window.location.href='index.php'</script>";
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
        <title>ITINERARY PLANNER</title>
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
    </head>
	<style>
	
	</style>
	
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        

        <!-- Navigation & Logo-->
        <div class="mainmenu-wrapper">
	        <div class="container">
	        	<div class="menuextras">
					<div class="extras">
						<ul>
							<li>
								<div class="dropdown choose-country">
									<a class="#" data-toggle="dropdown" href="#"><img src="img/flags/in.png" alt="India"> INDIA</a>
									<ul class="dropdown-menu" role="menu">
										
										
										
									</ul>
								</div>
							</li>
			        		<li><a href="logout.php">Logout</a></li>
			        	</ul>
					</div>
		        </div>
		        <nav id="mainmenu" class="mainmenu">
					<ul>
						<li class="logo-wrapper"><a href="home.php"><img src="img/icon2.jpg" alt="Tripbook Icon"></a></li>
						<li class="active">
							<a href="home.php">Home</a>
						</li>
						<li>
							<a href="ItenaryPlanner.php"><img src="img/service-icon/ruler.png" alt="Service 4">Itinerary Planner</a>
						</li>


						<li>
							<a href="TripDiary.php"><img src="img/service-icon/diary.jpg" alt="Service 1">TripDiary</a>
						</li>

						<li>
							<a href="Reviews.php"><img src="img/service-icon/chat.png" alt="Service 3">Reviews</a>
						</li>

						
						
					</ul>
				</nav>
			</div>
		</div>




		<!--<h1>Itenary Planner</h1>-->

 <div>
	        <div>
				<div>
        			<div class="col-sm-4">
        				<div>
        					<img src="img/homepage-slider/road.jpg" alt="Color Schemes">
        				</div>
        			</div>
        			<div class="col-sm-8">
    					<h2><b style="color:#8700B2;font-size:25px">HERE IS YOUR ITINERARY PLAN</h2>
						<form action="itenarypage2.php" method="post">

    					<p style="font-size:17px;color:brown">	
							
						</p>
						<p>
							
						
						</p>
						<p>
							

							</p>
    				</div>
				</div>
				<!--<div class="row service-wrapper-row">
        			<div class="col-sm-4">
        				<div class="service-image">
        					<img src="img/jog.jpg" alt="LESS CSS">
        				</div>
        			</div>
        			<div class="col-sm-8">
    					<h3></h3>
    					<p>
    						
    					</p>
    					<p>
    						
    					</p>
    				</div>
				</div>-->
				
				<div id="div1">
					<div id="div2">
						<div id="div3">
							<!--<img src="img/jog.jpg" >-->
						</div>
					</div>
				</div>
				<div class="row service-wrapper-row">
        			<div class="col-sm-4">
        				<div class="service-image">
        					<!--<img src="img/homepage-slider/hill2.jpg" alt="Responsive">-->
        				</div>
        			</div>
        			<div class="col-sm-8">
    					<h3></h3>
    					<p>
							
    						
							
						</p>
    					<p>
    						
    					</p>
    				</div>
				</div>
				<div class="row service-wrapper-row">
        			<div class="col-sm-4">
        				<div class="service-image">
        					<!--<img src="img/Review.jpg" alt="Flags">-->
        				</div>
        			</div>
        			<div class="col-sm-8">
    					<h3></h3>
    					<p>
						  					
    					</p>
    				</div>
					</form>
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
		    				<li><a href="index.php">Home</a></li>
		    				<li><a href="#">Itinerary Planner</a></li>
		    				<li><a href="ExpenseManager.php">Expense Manager</a></li>
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


	</body>

</html>