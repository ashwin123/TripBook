		<?php
			/*
		FILENAME:tripdiary.php
		LOCATION:localhost/se/tripdiary.php
		
		
		
			*/
		
		/////MONGO CONNECTIONS
	$db="tripbook";
	$collection="tripdiary";
	$sessionuser="sessionuser";
	$title="title";
	$exp="exp";
	$filepath="filepath";
	$datetrip="datetrip";
	$imagepath="tripdiary/TripDiary/";
	$m = new MongoClient();
	
   // select a database
   $db = $m->$db;
   $collection = $db->$collection;
   
   session_start();
   if(!isset($_SESSION['username'])){
	   echo "<script>alert('You must be logged in first')</script>";
	   redirect("http://localhost/page-login.php",0.0);
	   
   }	

   
   $sessionuserval=$_SESSION['username'];

			
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
	<style>
	hr { 
	color:#ffffff;
   
    border-width: 5px;
}
.thumbnail {
    word-wrap: break-word;  
}
	</style>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>TripDiary</title>
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
		function delconfirm()
		{
		return confirm("Are you sure you want to delete this content?");
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
			
	        	<div class="menuextras">
					<div class="extras">
						
						<ul>
							<li>

							<?php echo "<b>Welcome, ".$_SESSION['username2']."</b>"; ?>
							</li>
							
			        		<li><a href="logout.php">Logout</a></li>
			        	</ul>
					</div>
		        </div>
		        <nav id="mainmenu" class="mainmenu">
					<ul>
						<li class="logo-wrapper"><a href="index.php"><img src="img/icon2.jpg" alt="Tripbook Icon"></a></li>
						<li >
							<a href="index.php">Home</a>
						</li>
						<li>
							<a href="ItenaryPlanner.php"><img src="img/service-icon/ruler.png" alt="Service 4">Itinerary Planner</a>
						</li>


						<li class="active">
							<a href="TripDiary.php"><img src="img/service-icon/diary.jpg" alt="Service 1">TripDiary</a>
						</li>

						<li>
							<a href="indexreview.php"><img src="img/service-icon/chat.png" alt="Service 3">Reviews</a>
						</li>


						
						
					</ul>
				</nav>
			</div>
		</div>



	

<!-- Tripdiary  - START -->

			<div class="container" align="center">
			
			<div class="row">
<!--<h1 class="main_title"><?php //echo $title; ?></h1>-->
        <p></p>
		<button type="button" class="btn btn-info btn-lg" style="background-color:#007FFF;" data-toggle="modal" data-target="#myModal" >Add New<img src="img/add.png" style="margin-left:0.5em"></button>
        
		
		<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
		<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Enter Details</h4>
        </div>
        <div class="modal-body">
          <form  action="tripdiary/savetripdiary.php" method="POST" enctype="multipart/form-data">
            <div  align="center"  style="padding:5px;width:90%">
			
			
               <div class="form-group">
                   <input type="hidden" class="form-control" name="sessionuser"  style="width:400px" value=<?php echo $sessionuserval;?> required/>
                        
					<label for="InputName">Enter Place</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="InputName" id="InputName" placeholder="Enter Place Name" style="width:400px" required>
                        
                    </div>
					
                </div>
               
             
                <div class="form-group">
                    <label for="InputMessage">Your Experience</label>
                    <div class="input-group">
                        <textarea name="InputMessage" style="width:400px" id="InputMessage" class="form-control" placeholder="Whats your Experience!" rows="5" required></textarea>
                     
                    </div>
                </div>
				
				<!--File Upload-->
				<div class="form-group">
                    <label for="InputMessage">Choose File</label>
                    <div class="input-group">
				
                        <input type="file" style="width:400px" value="Upload file" name="InputFile" id="InputFile" class="btn btn-default btn-file" required
						style="padding: 10px;-webkit-border-radius:5px;-moz-border-radius: 5px;border: 1px dashed #BBB; text-align: center;background-color: #DDD;cursor:pointer;"></textarea>
						<br>
						<input type="submit" style="padding:10px;width:100px;background-color:#3EB489" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
                 
					  </div>
						
						 
                </div>
			</div>	

                
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
		</div>
		</div>
		<h1><hr></h1>
		 <?php
				$query = array($sessionuser =>$sessionuserval);
				$cursor = $collection->find($query);
				
				// iterate cursor to display title of documents
			foreach ($cursor as $document) {
	  
                ?>
				
               
				<div class="col-md-4">
                    <div style="cursor: default;text-decoration:none; box-shadow:0  0 15px #888888;" class="thumbnail">
                        
						<h3 style="text-align:center;color:#808080; border-bottom 0.5px solid #3EB489; " ><?php echo $document[$title]; ?></h3>
                        <hr>
						<img class="img-responsive" style="border:2px solid #808080" src="<?php echo $document[$filepath]; ?>">
						
						<h4 id="hide"><?php 
						
						$string =strip_tags($document[$exp]);
						$stringorig=$string ;
						if (strlen($string) > 200) {

						// truncate string
						$stringCut = substr($string, 0, 200);
						
						// make sure it ends in a word so assassinate doesn't become ass...
						$string = substr($stringCut, 0, strrpos($stringCut, ' '))."...<hr>"; 
						$myidnohash =strip_tags($document[$datetrip]);
						$myid ='#'.strip_tags($document[$datetrip]);
						echo $string;
						echo "
						<form action='tripdiary/deltrip.php' method='POST'>
						
	<input type='hidden' name='del' value='$document[_id]'/>
	<input type='hidden' name='img' value=$document[$filepath]/>
	<button type='submit' style='margin-left:0.5em;float:left;border:0px;background-color :transparent;'><img src='img/del.png' style='margin-left:0.5em;width: 30px;
    height: 30px;
    background: #E6E7ED;
    -moz-border-radius: 20px;
    -webkit-border-radius: 20px;' onclick='return delconfirm();'>
	
	</button>
	</form>
	"
	;
						echo "<button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target=$myid>Full Story</button>";
						echo "<div class='modal fade' id=$myidnohash role='dialog'>
    <div class='modal-dialog'>
    
      <!-- Modal content-->
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
         
		  <h3 class='modal-title' id='myModalLabel'>$document[$title]</h3>
        </div>
        <div class='modal-body'>
          $stringorig
		  
        </div>
		<hr>
		<img class='img-responsive' style='border:2px solid #808080'src=$document[$filepath]>
        <div class='modal-footer'>
		 <h5>$document[$datetrip]</h5>
	
          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
        </div>
      </div>
						";}
						else{
							echo $stringorig;
								echo "	<form action='tripdiary/deltrip.php' method='POST'>
						<button type='submit' style='margin-left:0.5em;float:left;border:0px;background-color :transparent;'><img src='img/del.png' style='margin-left:0.5em;width: 30px;
    height: 30px;
    background: #E6E7ED;
    -moz-border-radius: 20px;
    -webkit-border-radius: 20px;'
	onclick='return delconfirm();'
	>
	
	</button>
	<input type='hidden' name='del' value='$document[_id]'/>
	<input type='hidden' name='img' value=$document[$filepath]/>
	</form>";
						}
						 ?></h4>
						<h5><?php echo $document[$datetrip]; ?></h5>
                    </div>
					</div>
               
                <?php
                } // end foreach
                ?>
    
	
				
			
			
			
        


<hr>
</div><!-- content -->
			
			
				
			</div>




























 <div class="footer">
	    	<div class="container">
		    	<div class="row">

		    		<div class="col-footer col-md-3 col-xs-6">
		    			<h3>Navigate</h3>
		    			<ul class="no-list-style footer-navigate-section">
		    				<li><a href="index.php">Home</a></li>
		    				<li><a href="ItenaryPlanner.php">Itenary Planner</a></li>
		    				<li><a href="#">Trip Diary</a></li>
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