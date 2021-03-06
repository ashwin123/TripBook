<?php

session_start();

error_reporting (E_ALL ^ E_NOTICE);
if(!isset($_SESSION['username']))
{
	

	
	redirect("http://localhost/page-login.php",0.0);
	die();
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
        <title>TripBook</title>
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
							<li><b><?php echo "Welcome, ".$_SESSION['username2'];?></b></li>
			        		<li><a href="logout.php">Logout</a></li>
			        	</ul>
					</div>
		        </div>
		        <nav id="mainmenu" class="mainmenu">
					<ul>
						<li class="logo-wrapper"><a href="index.php"><img src="img/icon2.jpg" alt="Tripbook Icon"></a></li>
						<li class="active">
							<a href="index.php">Home</a>
						</li>
						<li>
							<a href="ItenaryPlanner.php"><img src="img/service-icon/ruler.png" alt="Service 4">Itinerary Planner</a>
						</li>


						<li>
							<a href="TripDiary.php"><img src="img/service-icon/diary.jpg" alt="Service 1">TripDiary</a>
						</li>

						<li>
							<a href="indexreview.php"><img src="img/service-icon/chat.png" alt="Service 3">Reviews</a>
						</li>

						
						
					</ul>
				</nav>

			</div>

		</div>
	


		<div align="right">
			<form action="search.php" method="post">
		<label >

		<input type="text" placeholder="Place Name" name="place" required/>

		
		<button type="submit" class="btn btn-info btn-lg">
        <span class="glyphicon glyphicon-search"></span> Search
         </button>
         </label>
         </form>
         </div>


		

        <!-- Homepage Slider -->
        <div class="homepage-slider">
        	<div id="sequence">
				<ul class="sequence-canvas">
					<!-- Slide 1 -->
					<li class="bg4">
						<!-- Slide Title -->
						<h2 class="title">MYSORE</h2>
						<!-- Slide Text -->
						<h3 class="subtitle" >A past that’s made of kings, queens, conquests, rich patrons, extravagant durbars and pearled hallways must be hard to get over.</h3>
						<!-- Slide Image -->
						<img class="slide-img" src="img/homepage-slider/Mysore_palace.jpg" alt="Slide 1" />
					</li>
					<!-- End Slide 1 -->
					<!-- Slide 2 -->
					<li class="bg10">
						<!-- Slide Title -->
						<h2 class="title">JOG FALLS</h2>
						<!-- Slide Text -->
						<h3 class="subtitle">Bear witness to nature's headlong tumble as the Sharavati River makes a spectacular drop of 253m in four distinct cascades.</h3>
						<!-- Slide Image -->
						<img class="slide-img" src="img/homepage-slider/jog_falls.jpg" alt="Slide 2" />
					</li>
					<!-- End Slide 2 -->
					<!-- Slide 3 -->
					<li class="bg7">
						<!-- Slide Title -->
						<h2 class="title">KUDREMUKH</h2>
						<!-- Slide Text -->
						<h3 class="subtitle">Wonderland of lush green forests interspersed with rivers, grassy slopes, captivating cascades, rare orchids, caves, ruins and traces of old civilisations amaze you as you trek your way through it.</h3>
						<!-- Slide Image -->
						<img class="slide-img" src="img/homepage-slider/kudremukh.jpg" alt="Slide 3" />
					</li>
					<!-- End Slide 3 -->
					<!-- Slide 4 -->
					<li class="bg3">
						<!-- Slide Title -->
						<h2 class="title">BADAMI</h2>
						<!-- Slide Text -->
						<h3 class="subtitle">Sandstone hills that flank the placid water of the Agastya Lake paint a stark picture of earthy reds, muddy greens and stone browns set against a sky of acrylic blue.</h3>
						<!-- Slide Image -->
						<img class="slide-img" src="img/homepage-slider/badami.jpg" alt="Slide 4" />
					</li>
					<!-- End Slide 4 -->
					<!-- Slide 5 -->
					<li class="bg5">
						<!-- Slide Title -->
						<h2 class="title">BANDIPUR</h2>
						<!-- Slide Text -->
						<h3 class="subtitle">Go wild and see just how therapeutic it can be...!</h3>
						<!-- Slide Image -->
						<img class="slide-img" src="img/homepage-slider/wild_bandipur.jpg" alt="Slide 5" />
					</li>
					<!-- End Slide 5 -->
				
				    <!--Slide 6-->
				    <li class="bg6">
						<!-- Slide Title -->
						<h2 class="title">Chikmagalur</h2>
						<!-- Slide Text -->
						<h3 class="subtitle">Chikmagalur has played host to an event, thanks to which, countless Indians wake up to brighter mornings. </h3>
						<!-- Slide Image -->
						<img class="slide-img" src="img/homepage-slider/chikmagalur.jpg" alt="Slide 6" />
					</li>
					<!-- End Slide 6 -->


					 <!--Slide 7-->
				    <li class="bg8">
						<!-- Slide Title -->
						<h2 class="title">Gokarna</h2>
						<!-- Slide Text -->
						<h3 class="subtitle">Open beaches, undiscovered coves, epiphanic sunsets, jagged cliffs, quaint temples and an evasive culture..! </h3>
						<!-- Slide Image -->
						<img class="slide-img" src="img/homepage-slider/gokarna.jpg" alt="Slide 6" />
					</li>
					<!-- End Slide 7 -->


					


				</ul>


				
				<div class="sequence-pagination-wrapper">
					<ul class="sequence-pagination">
						<li>1</li>
						<li>2</li>
						<li>3</li>
						<li>4</li>
						<li>5</li>
						<li>6</li>
						<li>7</li>
					</ul>
				</div>
			</div>
        </div>
        <!-- End Homepage Slider -->

		<!-- Press Coverage -->
        <div class="section">
	    	<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-6">
						<div class="in-press press-mashable" >
							<a href="#" style="text-decoration: none;">Badami.The locale of its famous cave temples, made up of two giant sandstone hills that flank the placid water of the Agastya Lake paint a stark picture of earthy reds, muddy greens and stone browns set against a sky of acrylic blue - burning an impression into the canvas of your mind. One that you aren't likely to forget in a hurry.</a>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="in-press press-mashable">
							<a href="#" >Bandipur.Trade those concrete jungles for a fresh breath of green. Put a pause on the rat race and ride an elephant instead. Take a break from bearding the lion in his corner office and go looking for tigers. The Bandipur Wildlife Sanctuary puts life back into perspective. Or rather it puts the perspective back into life</a>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="in-press press-techcrunch">
							<a href="#">Mysore is yet to, and perhaps will never, get over its past. A past that’s made of kings, queens, conquests, rich patrons, extravagant durbars and pearled hallways must be hard to get over. The streets in Mysore are old and a good part of history can be traced by following their winding paths. The city that gets its name from Mahishasura, the troublemaker demon who was slain by the Goddess Chamundeshwari: whose temple atop the Chamundi Hill watches all over the city has played host to the reign of a long line of Wadiyars, Tipu Sultan and the British.</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Press Coverage -->

		<!-- Services -->
        <div class="section">
	        <div class="container">
	        	<div class="row">
					
	        		<div class="col-md-3 col-sm-9">
	        			<div class="service-wrapper">
		        			<img src="img/service-icon/ruler.png" alt="Service 4">
		        			<h3>Itinerary Planner</h3>
		        			<p>Plan your travel before hand with list of places to visit..!</p>
		        			<a href="ItenaryPlanner.php" class="btn">Open</a>
		        		</div>
	        		</div>
	        		<div class="col-md-3 col-sm-9">
	        			<div class="service-wrapper">
		        			<img src="img/service-icon/diary.jpg" alt="Service 1">
		        			<h3>  Trip Diary</h3>
		        			<p>Maintain a diary of your trip experience..!</p>
		        			<a href="TripDiary.php" class="btn">Open</a>
		        		</div>
	        		</div>
	        		
	        		
	        		<div class="col-md-3 col-sm-9">
	        			<div class="service-wrapper">
		        			<img src="img/service-icon/chat.png" alt="Service 3">
		        			<h3>Write Reviews</h3>
		        			<p>Write and share your experience through reviews..!</p>
		        			<a href="indexreview.php" class="btn" >Open</a>
		        		</div>
	        		</div>
					
					<div class="col-md-3 col-sm-9">
	        			<div class="service-wrapper">
		        			<img src="img/service-icon/android_app.png" alt="Service 2">
		        			<h3>Android App</h3>
		        			<p>Android app provides services with google maps integrated..!</p>
		        			<a href="#" class="btn">Read more</a>
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
		    				<li><a href="ItenaryPlanner.php">Itinerary Planner</a></li>
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