<?php

require_once __DIR__."/../entity/del.php";

/**
	Controller class for DELETE data
*/

class ControlDel
{
	public $resObj=null;
	function __construct(){

	}

	public function deleteData($stID='0')
	{
		# call entity
		//$this->resObj=new Read();//->readTbl(); //working
		$this->resObj=(new Del)->delSt($stID);


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