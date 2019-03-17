
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
	public function readTbl(){
		$resObj= array();
		$sql="SELECT * from haul; ";
		$this->result=$this->conn->query($sql);

		if(!$this->result){
			//echo __CLASS__." : ",__FUNCTION__," error<br/>";
			//$this->errorMsg = ," error<br/>";
			//echo $this->conn->error; // error printing //works
			//$resObj["result"]="false";
			$resObj["error"]["message"]=$this->conn->error;
			$resObj["error"]["function"]=__CLASS__." : ",__FUNCTION__;
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


	/** Read Single Record. Return Data. */
	public function readSingle($stID){
		$resObj= array();
		$sql="SELECT * from haul where stid='$stID'; ";
		$this->result=$this->conn->query($sql);

		if(!$this->result){
			echo __CLASS__." : ",__FUNCTION__," error<br/>";
			echo $this->conn->error; // error printing //works
			$resObj["result"]="false";
			$resObj["error"]["message"]=$this->conn->error;
		}
		else{
			$i=0;
			$resObj["result"]="true";

			while($row=$this->result->fetch_array(MYSQLI_ASSOC)){ // should be only one row
				//print_r($row);
				$resObj["data"][$i]=$row;
				$i++;
			}/**/
		}

		return $resObj;
	}


	/** Insert new data. Return new ID. */
	public function insertNew($newData){
		$resObj= array();
		$sql="INSERT into haul values(null, '".$newData['sName']."', '".$newData['sAge']."'); ";
		$this->result=$this->conn->query($sql);

		if(!$this->result){
			echo __CLASS__." : ",__FUNCTION__," error<br/>";
			echo $this->conn->error; // error printing //works
			$resObj["result"]="false";
			$resObj["error"]["message"]=$this->conn->error;
		}
		else{
			$i=0;
			$resObj["result"]="true";
			$resObj["insert"]="ok";

			$sql="SELECT max(stid) as sid from haul; ";
			$this->result=$this->conn->query($sql);

			//No SQL error handling
			while($row=$this->result->fetch_array(MYSQLI_ASSOC)){ // only one row
				$resObj["id"]= $row["sid"];
				$i++;
			}
			//echo __FUNCTION__;


			/*while($row=$this->result->fetch_array(MYSQLI_ASSOC)){ // working
				//print_r($row);
				$resObj["data"][$i]=$row;
				$i++;
			}/**/
		}

		return $resObj;
	}


	/** Update single record. Returns void. */
	public function saveEdit($editData){
		$resObj= array();
		$sql="UPDATE haul set stname='".$editData['sName']."', stage='".$editData['sAge']."' where stid='".$editData['sID']."'; ";
		$this->result=$this->conn->query($sql);

		if(!$this->result){
			echo __CLASS__." : ",__FUNCTION__," error<br/>";
			echo $this->conn->error; // error printing //works
			$resObj["result"]="false";
			$resObj["error"]["message"]=$this->conn->error;
			//return $resObj;
			//return null;
		}
		else{
			$i=0;
			$resObj["result"]="true";
			$resObj["edit"]="ok";

			/*while($row=$this->result->fetch_array(MYSQLI_ASSOC)){ // working
				//print_r($row);
				$resObj["data"][$i]=$row;
				$i++;
			}/**/
		}

		return $resObj;
	}


	/** Delete single record. Returns void. */
	public function delSt($editData){
		$resObj= array();
		$sql="DELETE from haul where stid='".$editData['sID']."'; ";
		$this->result=$this->conn->query($sql);

		if(!$this->result){
			echo __CLASS__." : ",__FUNCTION__," error<br/>";
			echo $this->conn->error; // error printing //works
			$resObj["result"]="false";
			$resObj["error"]["message"]=$this->conn->error;
			//return $resObj;
			//return null;
		}
		else{
			$i=0;
			$resObj["result"]="true";
			$resObj["del"]="ok";

			/*while($row=$this->result->fetch_array(MYSQLI_ASSOC)){ // working
				//print_r($row);
				$resObj["data"][$i]=$row;
				$i++;
			}/**/
		}

		return $resObj;
	}

}




?>