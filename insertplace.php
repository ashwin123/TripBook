<?php
	$m = new MongoClient();
   	$db = $m->tripbook;

   	$collection = $db->places;
   	$cursor = $collection->find();
   	// iterate cursor to display title of documents
   	
   	$data= array();

   	foreach ($cursor as $document) {
    	array_push($data, $document);
   	}
	
	$encoded_data = json_encode($data);
	echo $encoded_data;

?>	