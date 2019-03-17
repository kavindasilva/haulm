<?php

if(count($_GET)==0 && count($_POST)==0){
	echo "
	<table border=1 >
		<tr><td>Read All</td>
			<td>if(isset(\$_GET['read']) && !isset(\$_GET['stID']) && \$_GET['read']=='k1')</td></tr>
		<tr><td>Read All</td>
			<td>if(isset(\$_POST['get']))</td></tr>
		<tr><td>Read Single</td>
			<td>if(isset(\$_GET['read']) && isset(\$_GET['stID']))</td></tr>
		<tr><td>Delete Single</td>
			<td>if(isset(\$_POST['del']))</td></tr>
		<tr><td>Save edit</td>
			<td>if(isset(\$_POST['saveEdit']))</td></tr>
		<tr><td>Save new</td>
			<td>if(isset(\$_POST['saveNew']))</td></tr>	
	</table>";
}

require_once __DIR__."/read.php";
require_once __DIR__."/save.php";
require_once __DIR__."/dele.php";

if(isset($_GET['read']) && !isset($_GET['stID']) && $_GET['read']=="k1"){ // for web2.php testing
//if(isset($_GET['read']) && !isset($_GET['stID']) && $_GET['read']=="k1"){ // original
	$jsonRes= (new ControlRead);
	$jsonRes= (new ControlRead)->readData();
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json");

	//$jsonRes=json_decode($jsonRes, true); print_r($jsonRes);
	$jsonRes["reqType"]="GET";
	$jsonRes["reqtime"]=date("m:d h:i:s");

	header("Content-Type: application/json");
	$jsonRes=json_encode($jsonRes);

	echo($jsonRes); 
}

if(isset($_GET['read']) && isset($_GET['stID'])){
	$jsonRes= (new ControlRead);
	$jsonRes= (new ControlRead)->readData($_GET['stID']);
	header("Content-Type: application/json");

	//$jsonRes=json_decode($jsonRes, true); print_r($jsonRes);
	$jsonRes["reqType"]="GET";
	$jsonRes["reqtime"]=date("m:d h:i:s");

	header("Content-Type: application/json");
	$jsonRes=json_encode($jsonRes);

	echo($jsonRes); 
}

if(isset($_POST['del'])){
	//$jsonRes= (new ControlRead);
	$jsonRes= (new ControlDel)->deleteData($_POST['stID']);
	header("Content-Type: application/json");

	//$jsonRes=json_decode($jsonRes, true); print_r($jsonRes);
	$jsonRes["reqType"]="GET";
	$jsonRes["reqtime"]=date("m:d h:i:s");

	header("Content-Type: application/json");
	$jsonRes=json_encode($jsonRes);

	echo($jsonRes); 
}

if(isset($_POST["saveEdit"])){
	$jsonRes= (new ControlSave)->saveEdit($_POST);
	$jsonRes["reqType"]="POST";
	$jsonRes["reqtime"]=date("m:d h:i:s");
	header("Content-Type: application/json");
	$jsonRes=json_encode($jsonRes);
	echo($jsonRes);
}

if(isset($_POST["saveNew"])){
	$jsonRes= (new ControlSave)->saveNew($_POST);
	$jsonRes["reqType"]="POST";
	$jsonRes["reqtime"]=date("m:d h:i:s");
	header("Content-Type: application/json");
	$jsonRes=json_encode($jsonRes);
	echo($jsonRes);
}

if(isset($_POST["get"])){
	$jsonRes= (new ControlRead)->readData();
	$jsonRes["reqType"]="POST";
	$jsonRes["reqtime"]=date("m:d h:i:s");
	header("Content-Type: application/json");
	$jsonRes=json_encode($jsonRes);
	echo($jsonRes);
}


?>