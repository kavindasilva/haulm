<?php

require_once __DIR__."/read.php";
require_once __DIR__."/save.php";
require_once __DIR__."/dele.php";

if(isset($_GET['read']) && !isset($_GET['stID'])){
	$jsonRes= (new ControlRead);
	$jsonRes= (new ControlRead)->readData();
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