<?php

session_start();

error_reporting (E_ALL ^ E_NOTICE);
if(isset($_SESSION['username']))
{
    
    //echo "<div style='clear:right;background-color:white; margin:0; padding:0; float:right;margin-bottom:25px;'></div>";
}

else
{
    echo "<script>alert('you must be logged in first')</script>";
    echo "<script type='text/javascript'> window.location.href='index.php'</script>";
    die();
}

?>
<!DOCTYPE html>
<html>
<head>
    <!--script src="js/jquery-1.9.1.min.js"></script-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>ItineraryPlanner</title>
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
    <!-- Javascripts -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!--script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script-->
    <script src="js/bootstrap.min.js"></script>
    <script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
    <script src="js/jquery.fitvids.js"></script>
    <script src="js/jquery.sequence-min.js"></script>
    <script src="js/jquery.bxslider.js"></script>
    <script src="js/main-menu.js"></script>
    <script src="js/template.js"></script>
</head>
<body>
<div class="mainmenu-wrapper">
            <div class="container">
                <div class="menuextras">
                    <div class="extras">
                        <ul>
                            
                            <li><?php echo "<b>Welcome, ".$_SESSION['username2']."</b>"; ?></li>
                            <li>
                            <a href="logout.php">Logout</a></li>

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
<div align="center">


<h3>Search Results for ..<h1 id="placename"></h1> </h3>
</div>
 <div class="section">
            <div class="container" id="maincontainer">


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



<script>
    place='<?php echo $_POST["place"];?>'; console.log(JSON.stringify({"place":place}));
    $( document ).ready(function() {
        $.ajax({
        url: "http://localhost/cgi-bin/saveList.py",
        type: "post",
        data: JSON.stringify({"place":place}),
        dataType: "json",
        success: function(response) {
            //alert(response);
            console.log(response);
            heading = document.getElementById("placename");
            heading.innerHTML = place.toUpperCase();
            container = document.getElementById("maincontainer");
            br = document.createElement("br");
            //$('#heading').innerHTML = place.toUpperCase();
           $.each(response, function(i, v) {
                // Dynamically put the image onto front end
                //console.log(i);
                rowService = document.createElement("div");
                rowService.setAttribute("class","row service-wrapper-row");
                imageNode = document.createElement("div");
                imageNode.setAttribute("class","col-sm-4");
                imageDiv = document.createElement("div");
                imageDiv.setAttribute("class","service-image");
                image = document.createElement("img");
                image.src="img/"+(i+1)+".jpg";
                //image.height="200";
                // /image.style="float:left;";
                imageDiv.appendChild(image);
                imageNode.appendChild(imageDiv);
                rowService.appendChild(imageNode);
                rowService.appendChild(br);
                rowService.appendChild(br);
                contentNode = document.createElement("div");
                contentNode.setAttribute("class","col-sm-8");
                //contentNode.style="float:right;";
                headNode = document.createElement("h3");
                headNode.innerHTML = v.title;
                contentNode.appendChild(headNode);
                para = document.createElement("p");
                para.style="font-size:15px";
                para.innerHTML=v.descr+"<br>";
                contentNode.appendChild(para);
                rowService.appendChild(contentNode);
                container.appendChild(rowService);
            });
        },
        error: function(){
            alert("no response");
        }
    }); 
});
</script>

</body>
</html>