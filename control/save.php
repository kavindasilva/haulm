<?php

require_once __DIR__."/../entity/insert.php";
require_once __DIR__."/../entity/edit.php";

/**
	Controller class for SAVING data
*/

class ControlSave
{
	public $resObj=null;
	function __construct(){

	}

	public function saveEdit($postData)
	{
		# call entity
		//$this->resObj=new Read();//->readTbl(); //working
		if( isset($postData['sID']) && isset($postData['sName']) && isset($postData['sAge']) )
			$this->resObj=(new Edit)->saveEdit($postData);
		else
			$this->resObj["resut"]="false";

		//print_r($this->resObj);
		if($this->resObj["result"]=="false"){
			//$this->resObj["message"]=
			echo "Edit error";
			//return json_encode(value)
		}
		else{

		}
		/*while($row=$this->resObj["sqlRes"]->fetch_array(MYSQLI_ASSOC)){ // working
			print_r($row); //working
		}/**/
		//return json_encode($this->resObj);
		return $this->resObj;

	}


	public function saveNew($postData)
	{
		# call entity
		if( isset($postData['sID']) && isset($postData['sName']) && isset($postData['sAge']) )
			$this->resObj=(new Insert)->insertNew($postData);
		else
			$this->resObj["resut"]="false";

		//print_r($this->resObj);
		if($this->resObj["result"]=="false"){
			//$this->resObj["message"]=
			echo "Insert error";
			//return json_encode(value)
		}
		else{
			$this->resObj["saveNew"]="false";

		}
		/*while($row=$this->resObj["sqlRes"]->fetch_array(MYSQLI_ASSOC)){ // working
			print_r($row); //working
		}/**/
		//return json_encode($this->resObj);
		return $this->resObj;

	}
}

//new ControlRead();
//new Read();

?>