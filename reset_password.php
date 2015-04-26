<?php

require 'PHPMailer/PHPMailerAutoload.php';
require 'connect.php';

$to = $_POST['restore_email'];
$collection = $db->user;

$x = $collection->findOne(array("_id" => $to));

//checking whether the user exists or not
if($x['_id'])
{	
	    
		function generateRandomString($length = 10) 
		{
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) 
		    {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
		}
	
		$uniqid = $x['uniqid'];
		$pass=generateRandomString();
		
	    //$collection->insert(array("_id"=>$to,"password"=>$pass,"uniqid"=>$uniqid));
	    $collection->update(array("_id"=>$to), array('$set'=>array("_id"=>$to,"password"=>$pass,"uniqid"=>$uniqid)));

		$body  =  "Hey Hi,<br>Login using this new password<br> -----------------------------</br>
				<p>Your Password :".$pass."</p><br><p>Please do not reply to this mail</p>";//."</p><a href='http://localhost/login.php?id=md5checksumvalue()'> ";



		$Mail = new PHPMailer();
		$Mail->IsSMTP(); // Use SMTP
		$Mail->Host        = "smtp.gmail.com"; // Sets SMTP server for gmail
		$Mail->SMTPDebug   = 0; // 2 to enable SMTP debug information
		$Mail->SMTPAuth    = TRUE; // enable SMTP authentication
		$Mail->SMTPSecure  = "tls"; //Secure conection
		$Mail->Port        = 587; // set the SMTP port to gmail's port
		$Mail->Username    = 'tripbook2'; // gmail account username
		$Mail->Password    = 'tripbookse'; // gmail account password
		$Mail->Priority    = 1; // Highest priority - Email priority (1 = High, 3 = Normal, 5 =   low)
		$Mail->CharSet     = 'UTF-8';
		$Mail->Encoding    = '8bit';
		$Mail->Subject     = 'Trip book password change';
		$Mail->ContentType = 'text/html; charset=utf-8\r\n';
		$Mail->From        = 'tripbook2@gmail.com'; //Your email adress (Gmail overwrites it anyway)
		$Mail->FromName    = 'Trip book';
		$Mail->WordWrap    = 900; // RFC 2822 Compliant for Max 998 characters per line

		$Mail->addAddress($to); // To
		$Mail->isHTML( TRUE );
		$Mail->Body    =  $body;
		$Mail->AltBody = 'This is a new password mail requested by you';
		//$_SESSION['user1'] = $row;
				if(!$Mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $Mail->ErrorInfo;
		    exit;
		    }
		$Mail->SmtpClose();
		echo '<script>alert("message sent , check your mail")</script>';
		echo '<script>window.location.href="page-login.php"</script>';
		
		die();
}
//echo 'hello' ;
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
			setTimeout(function(){window.location.href='page-password-reset.html';},1500);
			//window.location.href='page-login.html';
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
        Email does not exists , please register first
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
