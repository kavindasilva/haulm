
<?php

require_once __DIR__."/entity.php";
/**
	DB access modal class
*/


class Stud extends Entity
{
	public $result=null;
	//private $errorMsg=null; // available from parent

	function __construct()
	{
		parent::__construct();
	}

	/** Read All data. Return Data. */
	public function readAll(){
		$resObj= array();
		//$sql="SELECT * from haual; ";
		$sql="SELECT * from haul; ";
		$this->result=$this->conn->query($sql);

		if(!$this->result){
			//echo __CLASS__." : ",__FUNCTION__," error<br/>";
			//$this->errorMsg = ," error<br/>";
			//echo $this->conn->error; // error printing //works
			//$resObj["result"]="false";
			$resObj["error"]["message"]=$this->conn->error;
			$resObj["error"]["function"]=__CLASS__." : ".__FUNCTION__;
			$resObj["error"]["insert"]["query"]=$sql;
		}
		else{
			$i=0;
			//$resObj["result"]="true";
			/*while($row=$this->result->fetch_array(MYSQLI_ASSOC)){ // working
				print_r($row);
			}*/
			while($row=$this->result->fetch_array(MYSQLI_ASSOC)){ // working
				//print_r($row);
				$resObj["data"][$i]=$row;
				$i++;
			}/**/
		}

		return $resObj;
	}


	/** Read Single Record. Return JSON. */
	public function readSingle($stID){
		$resObj= array();
		$sql="SELECT * from haul where stid='$stID'; ";
		$this->result=$this->conn->query($sql);

		if(!$this->result){
			$resObj["error"]["message"]=$this->conn->error;
			$resObj["error"]["function"]=__CLASS__." : ".__FUNCTION__;
			$resObj["error"]["query"]=$sql;
		}
		/*elseif( mysqli_num_rows( $this->result != 0 ) ){
			$this->resObj["numRows"]=mysqli_num_rows( $this->result);
			while($row=$this->result->fetch_array(MYSQLI_ASSOC)){ 
				//print_r($row);
				$resObj["data"][]=$row;
			}
		}*/
		else{
			while($row=$this->result->fetch_array(MYSQLI_ASSOC)){ // working
				//print_r($row);
				$resObj["data"][]=$row;
			}
		}

		return $resObj;
	}


	/** Insert new data. Return JSON. */
	public function insertNew($newData){
		$resObj= array();
		$sql="INSERT into haul values(null, '".$newData['sName']."', '".$newData['sAge']."'); ";
		$this->result=$this->conn->query($sql);

		if(!$this->result){
			$resObj["error"]["insert"]["message"]=$this->conn->error;
			$resObj["error"]["insert"]["message2"]="Error inserting new row";
			$resObj["error"]["insert"]["function"]=__CLASS__." : ".__FUNCTION__;
			$resObj["error"]["insert"]["query"]=$sql;
		}
		else{
			$i=0;
			$resObj["status"]["insert"]="ok";

			$sql="SELECT max(stid) as sid from haul; ";
			$this->result=$this->conn->query($sql);
			if(!$this->result){
				$resObj["error"]["newID"]["message"]=$this->conn->error;
				$resObj["error"]["newID"]["message2"]="Error getting inserted row ID";
				$resObj["error"]["newID"]["function"]=__CLASS__." : ".__FUNCTION__;
				$resObj["error"]["newID"]["query"]=$sql;
			}
			else{
				while($row=$this->result->fetch_array(MYSQLI_ASSOC)){ // only one row
					$resObj["status"]["newID"]= $row["sid"];
				}
			}

		}

		return $resObj;
	}


	/** Update single record. Returns JSON. */
	public function saveEdit($editData){
		$resObj= array();
		$sql="UPDATE haul set stname='".$editData['sName']."', stage='".$editData['sAge']."' where stid='".$editData['sID']."'; ";
		$this->result=$this->conn->query($sql);

		if(!$this->result){
			$resObj["error"]["message"]=$this->conn->error;
			$resObj["error"]["function"]=__CLASS__." : ".__FUNCTION__;
			$resObj["error"]["query"]=$sql;
		}
		else{
			$resObj["edit"]["status"]="ok";
		}

		return $resObj;
	}


	/** Delete single record. Returns JSON. */
	public function delSt($studID){
		$resObj= array();
		$sql="DELETE from haul where stid='".$studID."'; ";
		$this->result=$this->conn->query($sql);

		if(!$this->result){
			$resObj["error"]["message"]=$this->conn->error;
			$resObj["error"]["function"]=__CLASS__." : ".__FUNCTION__;
			$resObj["error"]["query"]=$sql;
		}
		else{
			$resObj["del"]["status"]="ok";
			$resObj["del"]["id"]=$studID;
		}

		return $resObj;
	}

}




?>