

<?php

require_once __DIR__."/../control/controllerStud.php";


header("Content-Type: application/json");

if( isset($_GET["all"]) ){
	echo json_encode( (new ControlStud)->readData() );
}
elseif( isset($_GET["single"]) ){
	echo json_encode( (new ControlStud)->readData($_GET["single"]) );
}
elseif( isset($_POST["add"]) ){
	echo json_encode( (new ControlStud)->create($_POST) );
}
elseif( isset($_POST["save"]) ){}
elseif( isset($_["del"]) ){}
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

