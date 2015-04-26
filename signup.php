<?php

require 'PHPMailer/PHPMailerAutoload.php';
require 'connect.php';
//echo "hello";

$to = $_POST['register-username'];
$pass = $_POST['register-password'];
$username = ucfirst($_POST['register-username2']);
//echo $username;

$collection = $db->user;

$x = $collection->findOne(array("_id" => $to));
$y = $collection->findone(array("username" => $username));
//echo $y['username'];

//checking whether the user exists or not
if(!(isset($x['_id']) || isset($y['username'])))
{	
	//if(!($y['username']=="")){
		// insert the data of the new user in the database
		session_start();
	    
	    $uniqid = uniqid();

	    $collection->insert(array("_id"=>$to,"password"=>$pass,"uniqid"=>$uniqid,"username"=>$username));

		$body  =  "Hey Hi,<br> Thanks for registering with us<br> -----------------------------</br>
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
		$Mail->Subject     = 'Trip book signup';
		$Mail->ContentType = 'text/html; charset=utf-8\r\n';
		$Mail->From        = 'tripbook2@gmail.com'; //Your email adress (Gmail overwrites it anyway)
		$Mail->FromName    = 'Trip book';
		$Mail->WordWrap    = 900; // RFC 2822 Compliant for Max 998 characters per line

		$Mail->addAddress($to); // To
		$Mail->isHTML( TRUE );
		$Mail->Body    =  $body;
		$Mail->AltBody = 'This is a registration mail';
		//$_SESSION['user1'] = $row;
				if(!$Mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $Mail->ErrorInfo;
		    exit;
		    }
		$Mail->SmtpClose();
		echo '<script>alert("message sent , check your mail")</script>';
		$_SESSION['uniqid'] = $uniqid;
		$_SESSION['username'] = $to;
		$_SESSION['username2'] = $username;
		echo '<script>window.location.href="index.php"</script>';
		die();
	//}
}

else if (isset($x['_id']))
{
	echo '<script>alert("email-id already exists");</script>';
	echo '<script>window.location.href="page-register.php"</script>';
}
else
{
	echo '<script>alert("user name is already taken");</script>';
	echo '<script>window.location.href="page-register.php"</script>';
}
?>