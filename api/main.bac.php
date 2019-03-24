

<?php

require_once __DIR__."/../control/controllerStud.php";

//header("Access-Control-Allow-Origin: http://127.0.0.1:4200");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization');

if( isset($_GET["all"]) ){
	echo json_encode( (new ControlStud)->readData() );
}
elseif( isset($_GET["single"]) ){
	echo json_encode( (new ControlStud)->readData($_GET["single"]) );
}
elseif( isset($_POST["add"]) ){
	echo json_encode( (new ControlStud)->create($_POST) );
}
elseif( isset($_POST["save"]) ){
	echo json_encode( (new ControlStud)->update($_POST) );
}
elseif( isset($_POST["del"]) ){
	echo json_encode( (new ControlStud)->deleteData($_POST["del"]) );
}
else{
	$getData=$_GET;
	$postData=$_POST;
	echo json_encode( 
		array( 
			"result"=> null , 
			"msg"=>"invalid request", 
			"requestData"=>array(
				"get"=>$getData,
				"post"=>$postData
			) 
		) 
	);
}


//function ss

 ?>

