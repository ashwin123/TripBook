<?php
	$city= $_POST['InputName'];
	$description = $_POST['InputMessage'];
	$target_path = $_SERVER['DOCUMENT_ROOT'] . "/images/" . basename($_FILES['InputFile']['name']);
	//try to move the uploaded file
	$ret = move_uploaded_file($_FILES['InputFile']['tmp_name'], $target_path);
	echo $ret;
	rename($target_path , $_SERVER['DOCUMENT_ROOT'] . "/images/" .basename($city.".png"));
	
	$m = new MongoClient();
	$db = $m->tripbook;
	$collection = $db->places;
	$document= array(
      "description" => $description,
      "city" => $city,
      "imgpath" => $target_path,
	);
	$collection -> insert($document);
	header("Location:indexreview.php");
?>