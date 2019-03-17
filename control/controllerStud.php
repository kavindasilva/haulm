<?php

require_once __DIR__."/../entity/stud.php";

/**
	Controller class for Student operations
*/

class ControlStud
{
	public $resObj=null;
	function __construct()
	{
	}

	public function readData($stID='0')
	{
		if($stID==0 || $stID=="0")
			$this->resObj=(new Stud)->readAll();
		else
			$this->resObj=(new Stud)->readSingle($stID);

		//print_r($this->resObj);
		if( $this->resObj["error"] && !$this->resObj["data"] ){
			//echo "No data due to error";
			$this->resObj["result"]=false;
		}
		elseif( !$this->resObj["error"] && $this->resObj["data"] ){
			$this->resObj["result"]=true;
			$this->resObj["numRows"]=count($this->resObj["data"]);
		}
		elseif ( !$this->resObj["error"] && !$this->resObj["data"] ) {
			$this->resObj["result"]="empty";
			$this->resObj["numRows"]=0;
		}
		/*while($row=$this->resObj["sqlRes"]->fetch_array(MYSQLI_ASSOC)){ // working
			print_r($row); //working
		}/**/
		//return json_encode($this->resObj);
		return $this->resObj;
	}


	public function update($postData)
	{
		# call entity
		//$this->resObj=new Read();//->readTbl(); //working
		if( isset($postData['sID']) && isset($postData['sName']) && isset($postData['sAge']) )
			$this->resObj=(new Edit)->saveEdit($postData);
		else
			$this->resObj["result"]="false";

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


	public function create($postData)
	{
		# call entity
		if( isset($postData['sName']) && isset($postData['sAge']) )
			$this->resObj=(new Stud)->insertNew($postData);
		else{
			$this->resObj["result"]="false";
			$this->resObj["error"]="missing values";
			//$this->resObj["requestData"]["get"]
			$this->resObj["requestData"]["post"]=$postData;
		}

		# After getting result object
		//print_r($this->resObj);
		if( $this->resObj["error"]["insert"] ){
			$this->resObj["result"]=false;
		}
		elseif( $this->resObj["error"]["newID"] && !$this->resObj["error"]["insert"] ){
			$this->resObj["result"]=false;
		}
		else{
			$this->resObj["result"]=true;
		}
		return $this->resObj;
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



?>