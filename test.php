<?php 

	$command = escapeshellcmd('python plan2.py');
	$output = shell_exec($command);

	$output= explode("\n", $output);

	$myfile= fopen("testing.data", "w");
	fwrite($myfile, json_encode($output));

	$plan = json_decode(file_get_contents('temp1')); 
	$newplan = json_decode(file_get_contents('temp2'));

	$cost= $output[0];
	$newcost= $output[1];
	$extraplaces= $output[2];


	header('Content-Type: application/json');

	$obj= array('plan'=> $plan, 'newplan'=> $newplan, 'cost'=> $cost, 'newcost'=> $newcost, 'extraplaces'=> $extraplaces);

	echo json_encode($obj);
?>