<?php
	/*$place=$_POST['place'];
	$days =$_POST['days'];
	$date1=$_POST['date1'];
	$date2=$_POST['date2'];
*/
	$place= "Mysore";
	$days= "2";
	$date1= "900";
	$date2= "2000";

	$_SESSION['day'] = $days;
	$_SESSION['dateone']=$date1;
	$_SESSION['datetwo']=$date2;
	$_SESSION['placename']=$place;
	//echo $_SESSION['placename'];
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
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
        <script type="text/javascript">
        		place= "<?php echo $_SESSION['placename'];?>";
		        	$(document).ready(function(){
		        		$.ajax({
		        			type: "POST",
		        			url: "http://localhost/cgi-bin/saveList.py",
					        data: JSON.stringify({place:place}),
					        dataType: 'json',
					        success: function(data){
					        	//console.log(data);
					        	tableDiv = document.getElementById("container");
				        		tableDiv.setAttribute("class","table-responsive");
				        		table = document.createElement("table");
				        		table.setAttribute("class","table table-bordered");

				        		thead = document.createElement("thead");
				        		thead.innerHTML="<td>Check</td><td>Place</td><td>Timings</td><td>Price</td><td>Duration</td><td>Priority</td>";
				        		table.appendChild(thead);
				        		tbody = document.createElement("tbody");
					        	$.each(data,function(index,place){

					        		tr = document.createElement("tr");
					        		tr.id = index;
					        		check = document.createElement("td");
					        		//checkDiv = document.createElement("div");
					        		//checkDiv.setAttribute("class","checkbox");
					        		checkbox = document.createElement("input");
					        		checkbox.type = "checkbox";

					        		checkbox.id = "checkbox"+index;
					        		//checkDiv.appendChild(checkbox);
					        		check.appendChild(checkbox);

					        		title = document.createElement("td");
					        		title.id = "title"+index;
					        		title.innerHTML = ""+place.title;
					        		duration = document.createElement("td");
					        		duration.id = "duration"+index;
					        		duration.innerHTML = ""+place.duration;
					        		price = document.createElement("td");
					        		price.id = "price"+index;
					        		price.innerHTML = ""+place.price;

					        		durTD = document.createElement("td");
					        		dur = document.createElement("input");
					        		dur.type = "number";
					        		dur.style.width = "85%";
					        		dur.setAttribute("class","form-control");
					        		dur.id = "priority"+index;
					        		durTD.appendChild(dur);

					        		priorityTD = document.createElement("td");
					        		priority = document.createElement("input");
					        		priority.type = "number";
					        		priority.style.width = "85%";
					        		priority.setAttribute("class","form-control");
					        		priority.id = "priority"+index;
					        		priorityTD.appendChild(priority);

					        		tr.appendChild(check);
					        		tr.appendChild(title);
					        		tr.appendChild(duration);
					        		tr.appendChild(price);
					        		tr.appendChild(priorityTD);
					        		tr.appendChild(durTD);
					        		tbody.appendChild(tr);

					        	});
								
								table.appendChild(tbody);
								table.style.height = "10%";
								table.style.width = "100%";
								tableDiv.appendChild(table);
					        },
					        error: function(xhr, status, error){
					        	console.log(error);
					        }
		        		});
		        	});
        	
        	
        	function generate_file()
        	{
        			rows = document.getElementsByTagName("tr");
        			budget = document.getElementById("numb").value;
        			det = {"place":"<?php echo $_SESSION['placename'];?>",locations:[],"days":"<?php echo $_SESSION['day'];?>",time:[parseInt("<?php echo $_SESSION['dateone'];?>"),parseInt("<?php echo $_SESSION['datetwo'];?>")],"budget":budget};
        			for(i = 0;i < rows.length; i++)
        			{
        				if(rows[i].firstChild.firstChild.checked)
        				{
        					title = rows[i].childNodes[1].innerHTML; //get title
        					console.log(title);
        					timings = rows[i].childNodes[2].innerHTML; //get duration
        					timings = timings.split(' ')[0]+"";
        					timings = timings.split('-');
        					open = "";
        					close = "";
        					//alert(open+" "+close);

        					if(open== "" || close== "" || open== undefined || close== undefined){
        						open= 900;
        						close= 2000;
        					}

        					

        					price = getPrice(rows[i].childNodes[3].innerHTML); //get price
        					duration = parseInt(rows[i].childNodes[4].firstChild.value); //get duration
        					priority = parseInt(rows[i].childNodes[5].firstChild.value); //get priority

        					if(price== ""){
        						price= "1000";
        					}

        					price= parseInt(price);
        					sttime= 0;
        					endtime= 0;
        					//put the required info into json array

        					det.locations.push({
        						"loc" : title,
        						"duration" : duration,
        						"priority" : priority,
        						"cost" : price,
        						"open" : open,
        						"close" : close,
        						"sttime": sttime,
        						"endtime": endtime
        					});
        				}
        			}
        			console.log(det);
        			$.ajax({
	        			type: "POST",
	        			url: "fileWrite.php",
				        data: {"data":det},
				        dataType: "json",
				        success: function(d){
				        	console.log("Success");
				        },
				        error: function(xhr, status, error){
				        	console.log(xhr);
				        	console.log(status);
				        	console.log(error);
				        }
				});

        			window.location.href= "plan.html";
        	
        	}


   			function getPrice(data){
   				var regex= /\d+/gi;
   				var arr= [];
   				while(res= regex.exec(data)){
   					arr.push(parseInt(res[0]));
   				}
   				max=0;
   				for(var i=0; i<arr.length; i++){
   					if(arr[i]>max){
   						max= arr[i];
   					}
   				}
   				return max;
   			}
			
	</script>
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
									
								</div>
							</li>
			        		<li><a href="page-login.html">Login</a></li>
			        	</ul>
					</div>
		        </div>
		         <nav id="mainmenu" class="mainmenu">
					<ul>
						<li class="logo-wrapper"><a href="home.html"><img src="img/icon2.jpg" alt="Tripbook Icon"></a></li>
						<li class="active">
							<a href="home.html">Home</a>
						</li>
						<li>
							<a href="ItenaryPlanner.html"><img src="img/service-icon/ruler.png" alt="Service 4">Itinerary Planner</a>
						</li>


						<li>
							<a href="TripDiary.php"><img src="img/service-icon/diary.jpg" alt="Service 1">TripDiary</a>
						</li>

						<li>
							<a href="Reviews.html"><img src="img/service-icon/chat.png" alt="Service 3">Reviews</a>
						</li>

						
						
					</ul>
				</nav>
			</div>
		</div>
	
		


		<!--<h1>Itenary Planner</h1>-->

 <div>
	        <div>
				<div>
        			<!-- <div class="col-sm-4">
        				<div>
        					<img src="img/homepage-slider/hill3.jpg" alt="Color Schemes">
        				</div>
        			</div> -->
        			<div class="col-sm-8">
    					<h2><b style="color:#330099;font-size:25px">WELCOME TO ITINERARY PLANNER</h2>
						<form action="itenarypage2.php" method="post">

    					<p style="font-size:17px;color:#330099">	
							Hey!!As per you choice,these places are suggestions to in and around of the location you have selected.
						</p>

						<div id="container" class="table-responsive">



						</div>
						<p>
						<!--The values of the checkbox need to be fetched from scraping script-->
							<!--table border="0" style="display:none" id="tableid">
							<tr id="row0">
								<td><input type="checkbox"/></td>
								<td><input type="text"/></td>
							</tr>
							</table-->
							<!--<input type="checkbox" id="id1" name="a" value="a"><b style="color:white;font-size:15px">OptionA<br>
							<input type="checkbox" id="id2" name="b" value="b">OptionB<br>
							<input type="checkbox" id="id3" name="c" value="c">OptionC<br>
							<input type="checkbox" id="id4" name="d" value="d">OptionD<br>-->
						
						</p>
						<p>
						<br>
						<br>
						<label style="font-size:15px;color:#330099">Enter your estimated budget : <input type="number" id="numb" name="numb" class="form-control" /></label>
						</p>

						


						<p>
							<input type="button" id="plan" value="ONE MORE STEP AND YOU ARE READY TO PLAN" style="color:white;background-color:#330099;height:50px; font-size:20px;border-radius:20px" onclick="generate_file()"/>
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
		    				<li><a href="home.html">Home</a></li>
		    				<li><a href="#">Itinerary Planner</a></li>
		    				<li><a href="ExpenseManager.html">Expense Manager</a></li>
		    				<li><a href="TripDiary.html">Trip Diary</a></li>
		    				<li><a href="Reviews.html">Reviews</a></li>
		    				<li><a href="page-faq.html">FAQ</a></li>
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