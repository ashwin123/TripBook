<?php

	//header('Content-type: text/html');

	//$data= json_decode($_POST['place']);
	$dat = $_POST['data'];
	//echo "<h2>$data</h2>";

	$data= array(
		"place"=> $dat['place'],
		"locations"=> $dat['locations']
	);

	$decdata= json_encode($data);

	/*$data= array(
		"days"=> "2",
		"time"=> "[900, 2000]",
		"budget"=> 200
	);
*/
	/*$d1= array(
			"place" => ($data=> $place),
			"locations" => ($data => $locations)
		);

	$d1= json_encode($d1);
*/
	$myfile = fopen("data.txt", "w");
	fwrite($myfile, $decdata. "\n");

	fwrite($myfile, $dat['days']. "\n");
	fwrite($myfile, json_encode($dat['time']). "\n");
	fwrite($myfile, $dat['budget']);
	//fwrite($myfile, $decdata);
	//fwrite($myfile, gettype($d1));
	/*fwrite($myfile, $decdata['days']);
	fwrite($myfile, $decdata['time']);
	fwrite($myfile, $decdata['budget']);*/
	fclose($myfile);

	//file_put_contents('data.txt', $decdata);

	//header('Location: plan.html');

?>