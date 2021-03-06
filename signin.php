<?php
//var/www/html/mongo
//connecting with the database
require 'connect.php';

// selecting collection "user" from the database 
$collection = $db->user;

//starting the session of the user
session_start();

//fetching data from form
$name = $_POST['login-username'];
$password = $_POST['login-password'];


// querying the data base whether the record exists for the user  or not
$x = $collection->findOne(array("_id" => $name, "password" => $password));


// if x['_id'] is empty then the user record is not present in the database
if($x['_id'] != '')
{
  $_SESSION['username']=$name;
	$_SESSION['uniqid'] = $x['uniqid'];
  $_SESSION['username2'] = $x['username'];

	// redirecting the user to the loggedin page for the users
	echo "<script type='text/javascript'> window.location.href='index.php'</script>";
	die();

}
?>





<!-- for displaying the modal we are writing this page and then redirecting to login-page again -->
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

	<script> 

		function display_modal_msg()
		{
			document.getElementById("modal-button").click();
			setTimeout(function(){window.location.href='page-login.php';},1500);
			//window.location.href='page-login.php';
		}
		
		//display_modal_msg();
	</script>
    </head>




<body onload='display_modal_msg()'>

		<!--button for modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style="display:none;" id="modal-button">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">OOPS....</h4>
      </div>
      <div class="modal-body">
        Either email id or password you entered is wrong
      </div>
      <!--div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div-->
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

	
