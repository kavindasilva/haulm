<?php

require_once __DIR__."/../entity/read.php";

/**
	Controller class for Reading data
*/

class ControlRead
{
	public $resObj=null;
	function __construct(){

	}

	public function readData($stID='0')
	{
		# call entity
		//$this->resObj=new Read();//->readTbl(); //working
		if($stID==0 || $stID=="0")
			$this->resObj=(new Read)->readTbl();
		else
			$this->resObj=(new Read)->readSingle($stID);

		//print_r($this->resObj);
		if($this->resObj["result"]=="false"){
			//$this->resObj["message"]=
			echo "No data due to error";
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
}

//new ControlRead();
//new Read();

?>