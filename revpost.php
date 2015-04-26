<?php
   $m = new MongoClient();
   $db = $m->tripbook;

   $collection = $db->reviews;
	
	//starting the session of the user
	session_start();
	$uname= $_SESSION['username'];
	
	$data= $_POST['datarev'];
	$city= $_POST['city'];
	$ratings= $_POST['ratings'];
	$timestamp = $_POST['timestamp'];
   $document= array(
      "revdescp" => $data,
      "city" => $city,
      "uname" => $uname,
      "ratings" => $ratings,
	  "timestamp" => $timestamp
   );

   $collection -> insert($document);
?>	