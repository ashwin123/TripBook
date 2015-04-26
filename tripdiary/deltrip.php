	<?php
	// Saving data from form in text file in JSON format
	$db="tripbook";
	$collection="tripdiary";
	$title="title";
	$exp="exp";
	$filepath="filepath";
	$datetrip="datetrip";
	$imagepath="tripdiary/TripDiary/";
	$pathdel = $_SERVER['DOCUMENT_ROOT'].'/tripdiary/TripDiary/'; //PATH FOR DELETING IMAGE
	$m = new MongoClient();
	echo "Connection to database successfully";
   // select a database
	$db = $m->$db;
	echo "Database mydb selected";
	$collection = $db->$collection;
	echo "Collection selected succsessfully";
		try{
			if(isset($_POST['del'])&&isset($_POST['img']))							
				{
									
		
					$qry = array("_id"=>new MongoID($_POST['del']));
					$collection->remove($qry);
	
					$array = explode("/",$_POST['img']);
	
					unlink($pathdel.$array[6]);
	
					
					echo "\nDocuments deleted successfully";
					redirect("http://localhost/TripDiary.php",0.0);
	
   
	}
		else{
		
			echo "Not coming";
			}
		}
	catch(MongoException $mongoException){
        print $mongoException;
        exit;
    }
	function redirect($url, $statusCode = 303)
			{
			header('Location: ' . $url, true, $statusCode);
			die();
		}
	?>