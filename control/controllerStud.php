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
		if( isset($this->resObj["error"]) && !isset($this->resObj["data"]) ){
			//echo "No data due to error";
			$this->resObj["result"]=false;
		}
		elseif( !isset($this->resObj["error"]) && isset($this->resObj["data"]) ){
			$this->resObj["result"]=true;
			$this->resObj["numRows"]=count($this->resObj["data"]);
		}
		elseif ( !isset($this->resObj["error"]) && !isset($this->resObj["data"]) ) {
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
		if( $this->readData($postData['sID'])["result"] === "empty" ){
			$this->resObj["result"]=false;
			$this->resObj["error"]["msg"]="Student ID not found";
			$this->resObj["error"]["studID"]=$postData['sID'];
		}
		else{
			if( isset($postData['sID']) && isset($postData['sName']) && isset($postData['sAge']) )
				$this->resObj=(new Stud)->saveEdit($postData);
			else{
				$this->resObj["result"]="false";
				$this->resObj["error"]="missing values";
				$this->resObj["requestData"]["post"]=$postData;
			}

			//print_r($this->resObj);
			if( isset($this->resObj["error"]) ){
				$this->resObj["result"]=false;
			}
			elseif( isset($this->resObj["edit"]) ) {
				$this->resObj["result"]=true;
			}
		}

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
		if( isset($this->resObj["error"]["insert"]) ){
			$this->resObj["result"]=false;
		}
		elseif( isset($this->resObj["error"]["newID"]) && !isset($this->resObj["error"]["insert"]) ){
			$this->resObj["result"]=false;
		}
		else{
			$this->resObj["result"]=true;
		}
		return $this->resObj;
	}


	public function deleteData($stID='0')
	{
		//echo $this->readData($stID)["result"]; //working
		if( $this->readData($stID)["result"] === "empty" ){
			$this->resObj["result"]=false;
			$this->resObj["error"]["msg"]="Student ID not found";
			$this->resObj["error"]["studID"]=$stID;
		}
		else{
			$this->resObj=(new Stud)->delSt($stID);

			if( isset($this->resObj["error"]) ){
				$this->resObj["result"]=false;
			}
			elseif( $this->resObj["del"] ){
				$this->resObj["result"]=true;
			}	
		}


		return $this->resObj;
	}

}



?>