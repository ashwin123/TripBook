<?php

session_start();

error_reporting (E_ALL ^ E_NOTICE);
if(!isset($_SESSION['username']))
{
	

	
	redirect("http://localhost/page-login.php",0.0);
	die();
}
else{$uname=$_SESSION['username'];}
function redirect($url, $statusCode = 303)
			{
			header('Location: ' . $url, true, $statusCode);
			die();
		}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reviews</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/icomoon-social.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="css/leaflet.css" />
		
		<!--[if lte IE 8]>
		    <link rel="stylesheet" href="css/leaflet.ie.css" />
		<![endif]-->
		<link rel="stylesheet" href="css/main.css">
	

        <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <!-- Custom CSS -->
    <link href="css/shop-item.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body onload="init()" style="padding:0; margin:0;">

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


						<li>
							<a href="TripDiary.php"><img src="img/service-icon/diary.jpg" alt="Service 1">TripDiary</a>
						</li>

						<li class="active">

							<a href="#"><img src="img/service-icon/chat.png" alt="Service 3">Reviews</a>
						</li>

						
						
					</ul>
				</nav>
			</div>
		</div>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">PLACES</p>
                <div id="place_list" class="list-group">
					<button id="Mysore" class="btn btn-info btn-lg" style="width:200px;height:55px;" onclick="change_place()">MYSORE</button>
				
					<button type="button" id="addbutton" style="margin-top:10px"class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" >Add New</button>
                </div>
            </div>
	 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
		<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Enter Details</h4>
        </div>
        <div class="modal-body">
          <form  action="revplaces.php" method="POST" enctype="multipart/form-data">
            <div  align="center"  style="padding:5px;width:90%">
			
			
               <div class="form-group">
                   <input type="hidden" class="form-control" name="sessionuser"  style="width:400px" required/> 
                        
					<label for="InputName">Enter Place</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="InputName" id="InputName" placeholder="Enter Place Name" style="width:400px" required/>
                        
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
            <div class="col-md-9">

                <div class="thumbnail">
                    <img class="img-responsive" id="img" src="images/Mysore.png" alt="">
                    <div class="caption-full">
                        <h4><a href="#" id="placename">MYSORE</a>
                        </h4>
                        <p id="aboutplace">A must see. Amazingly opulent and dazzling interiors with some quirky points of interest. Definitely worth using the free to foreigners audio tour, as it's excellently put together complete with sound effects! Just make sure you get a fully charged battery pack from the audio guide stall, or else it may suddenly pack up on Number 11 like ours did, when there's 21 items of interest on the guide! Then you're just wandering round looking at incomprehensible Indian things, which isn't as good! As usual, cameras are forbidden and you have to leave them in safe custody while you go round, but that didn't stop hundreds of Indian teenagers on school trips whipping out their smart phones to take selfies inside the palace, so you could sneak the odd photo before being shouted at by one of the guards. Although Sunday is heaving with visitors there, its also the best time to go in the evening, to see the palace lit up from 7.00 - 7.45pm only. With 100,000 lightbulbs, its too costly to extend the time, but is a breathtaking sight while it lasts. Very much enhanced the night we were there by a charmingly tinny brass band playing sprightly Indian tunes in front of the palace.</p>
                        
                        
                    </div>
                </div>

                <div class="well" id="revlist">

                    <div class="text-right">
                        <a class="btn btn-success" id="addrev">Leave a Review</a>
                    </div>
					<div class="text-right" id="writerev" style="display:none">
						<br><textarea id="revtext" name= "revtext" rows=3 cols=110 placeholder="Enter your review here...."></textarea>
							<div class="col-md-12">
								<span class="glyphicon glyphicon-star-empty" id="1" onclick="ratings(event)"></span>
								<span class="glyphicon glyphicon-star-empty" id="2" onclick="ratings(event)"></span>
								<span class="glyphicon glyphicon-star-empty" id="3" onclick="ratings(event)"></span>
								<span class="glyphicon glyphicon-star-empty" id="4" onclick="ratings(event)"></span>
								<span class="glyphicon glyphicon-star-empty" id="5" onclick="ratings(event)"></span>
							</div>
							<div class="text-right">
								<a class="btn btn-success" id="cancrev">cancel</a>
								<a class="btn btn-success" id="postrev">Post</a>
							</div>
					</div>

                    <hr>

                    <div class="row" id="added" style="display:none">
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                           Anonymous
                            <span class="pull-right">0 days ago</span>
                            <p id="txt">This product was great in terms of quality. I would definitely buy another!</p>
                        </div>
                    </div>


                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

  
    <!-- /.container -->


    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
		var revcount = 1;
		var countrate = 0;
		var cityname = "Mysore";
		var descrip="";
		addrev = document.getElementById("addrev");
		addrev.addEventListener("click", createfunc, true);
		function init()
		{
			loadplaces();
			$.ajax({
				type: 'GET',
				url: 'http://localhost/testreview.php',
				dataType: 'json',
				success: function(data){
					for(var i = 0; i < data.length; i++) {
						var obj = data[i];
						if(obj.city=="Mysore")
							reviewLoad(obj.city, obj.uname, obj.revdescp, obj.ratings, obj.timestamp);
							
						}
				},
				error: function(){
					console.log("Failed");
				}
			});
		}
		function loadplaces()
		{
			mysore=document.getElementById("Mysore");
			addbutton=document.getElementById("addbutton");
			place_list=document.getElementById("place_list");
			$.ajax({
				type: 'GET',
				url: 'http://localhost/insertplace.php',
				dataType: 'json',
				success: function(data){
					for(var i = 0; i < data.length; i++) {
						var obj = data[i];
						newplace=mysore.cloneNode(true);
						newplace.setAttribute("id", obj.city);
						newplace.setAttribute("class", obj.city);
						newplace.innerHTML=(obj.city).toUpperCase();
						place_list.insertBefore(newplace, addbutton);
						}
				},
				error: function(){
					console.log("Failed");
				}
			});
		}
		function change_place()
		{
			place_list=document.getElementById("place_list");
			btn=place_list.getElementsByTagName("button");
			for(i=0; i<btn.length-1;i++)
			{
				btn[i].setAttribute("class", "");
			}
			var e = window.event;
			btn=e.target.id;
			cityname = btn;
			btn1=document.getElementById(btn);
			btn1.setAttribute("class","btn btn-info btn-lg");
			img=document.getElementById("img");
			source="/images/"+btn+".png";
			//alert(source);
			img.src=source;
			for(i=1;i<revcount;i++)
			{
				revcnt="rev"+i;
				document.getElementById(revcnt).remove();
			}
			revcount=1;
			$.ajax({
				type: 'GET',
				url: 'http://localhost/insertplace.php',
				dataType: 'json',
				success: function(data){
					for(var i = 0; i < data.length; i++) {
						var obj = data[i];
							if(obj.city==btn)
							{
								console.log(obj.description);
								assignDescription(obj.description);
							}
						}
				},
				error: function(){
					console.log("Failed");
				}
			});
			
			placename = document.getElementById("placename");
			placename.innerHTML=btn.toUpperCase();
			//load these place reviews
			$.ajax({
				type: 'GET',
				url: 'http://localhost/testreview.php',
				dataType: 'json',
				success: function(data){
					for(var i = 0; i < data.length; i++) {
						var obj = data[i];
						if(obj.city==btn)
							reviewLoad(obj.city, obj.uname, obj.revdescp, obj.ratings, obj.timestamp);
							
						}
				},
				error: function(){
					console.log("Failed");
				}
			});
		}
		function assignDescription(data)
		{
			descrip=data;
			aboutplace = document.getElementById("aboutplace");
			aboutplace.innerHTML=descrip;
		}
		function reviewLoad(city, uname, revdescp, ratings, timestamp)
		{
			hr1 = document.createElement("hr");
			added = document.getElementById("added");
			rev = added.cloneNode(true);
			rev.id = "rev"+revcount;
			rev.setAttribute("class","newreview");
			revlist= document.getElementById("revlist");
			ins = document.getElementById(writerev.nextSibling.nextSibling.nextSibling.nextSibling.id);
			para = rev.getElementsByTagName("p");
			para[0].innerHTML = revdescp;
			
			revstars = rev.getElementsByTagName("span");
			for(i=0;i<ratings;i++)
			{
				revstars[i].setAttribute("class","glyphicon glyphicon-star");
			}
			divs = rev.getElementsByTagName("div");
			divs[0].innerHTML = divs[0].innerHTML.replace("Anonymous",uname);
			var d = new Date();
			var n = d.getTime();
			var timeDiff = Math.abs(d.getTime() - timestamp);
			var diffDays = Math.floor(timeDiff / (1000 * 3600 * 24)); 
			revstars[5].innerHTML=revstars[5].innerHTML.replace("0", diffDays);
			revlist.insertBefore(hr1, ins);
			revlist.insertBefore(rev, hr1);
			rev.style.display="block";
			for(i=1;i<=5;i++)
			{
				st = document.getElementById(i.toString());
				st.setAttribute("class","glyphicon glyphicon-star-empty");
			}
			revcount+=1;
		}
		
		function createfunc()
		{
			//alert("going to add a review");
			writerev = document.getElementById("writerev");
			writerev.style.display="block";
			cancrev = document.getElementById("cancrev");
			cancrev.addEventListener("click", cancelrev, true);
			postrev = document.getElementById("postrev");
			postrev.addEventListener("click", postfunc, true);
		}
		
		function cancelrev()
		{
			for(i=1;i<=5;i++)
			{
				st = document.getElementById(i.toString());
				st.setAttribute("class","glyphicon glyphicon-star-empty");
			}
			document.getElementById("revtext").value = "";
			writerev.style.display="none";
			countrate = 0;
		}
		function postfunc()
		{	
			hr1 = document.createElement("hr");
			added = document.getElementById("added");
			rev = added.cloneNode(true);
			rev.id = "rev"+revcount;
			revlist= document.getElementById("revlist");
			ins = document.getElementById(writerev.nextSibling.nextSibling.nextSibling.nextSibling.id);
			para = rev.getElementsByTagName("p");
			para[0].innerHTML = document.getElementById("revtext").value;
			
			revstars = rev.getElementsByTagName("span");
			for(i=0;i<countrate;i++)
			{
				revstars[i].setAttribute("class","glyphicon glyphicon-star");
			}
			divs = rev.getElementsByTagName("div");
			var d = new Date();
			var n = d.getTime();
			usr1 = <?php echo json_encode($_SESSION['username2']);?>;
			//alert(usr1);
			usr=<?php echo "'$uname'"?>;
			divs[0].innerHTML = divs[0].innerHTML.replace("Anonymous",usr1);
			var arr= {datarev: para[0].innerHTML, city: cityname, ratings: countrate, timestamp: n};
			
			$.ajax({
				type: 'POST',
				url: 'http://localhost/revpost.php',
				data: arr,
				success: function(data){
					console.log("Success");
				},
				error: function(){
					console.log("Failed");
				}
			});
			revlist.insertBefore(hr1, ins);
			revlist.insertBefore(rev, hr1);
			rev.style.display="block";
			writerev.style.display="none";
			for(i=1;i<=5;i++)
			{
				st = document.getElementById(i.toString());
				st.setAttribute("class","glyphicon glyphicon-star-empty");
			}
			document.getElementById("revtext").value = "";
			countrate = 0;
			revcount+=1;
		}
		
		function ratings(event)
		{
			for(i=1;i<=5;i++)
			{
				st = document.getElementById(i.toString());
				st.setAttribute("class","glyphicon glyphicon-star-empty");
			}
			countrate = parseInt(event.target.id);
			var cnt = countrate;
			for(;cnt>0;cnt--)
			{
				st = document.getElementById(cnt.toString());
				st.setAttribute("class","glyphicon glyphicon-star");
			}
		}
	</script>


	    <!-- Footer -->
	    <div class="footer">
	    	<div class="container">
		    	<div class="row">

		    		<div class="col-footer col-md-3 col-xs-6">
		    			<h3>Navigate</h3>
		    			<ul class="no-list-style footer-navigate-section">
		    				<li><a href="index.php">Home</a></li>
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
