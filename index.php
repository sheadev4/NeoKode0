<?php
$dbConnection;
class item{
	public function __construct(){
		$this->$pendingCommits=array();
	}
	public function init($properties){
		foreach($properties as $name=>$value){
			$this->$$name=$value;
		}
	}
	public function pull(){

	}
	public function push(){
		
	}
	public function getProperty($property){
		if(isset($this->$$property)){
			if(!empty($this->$pendingCommits[$property])){
				return $pendingCommits[$property];
			}else{
				return $this->$$property;
			}
		}else{
			pull();
			return $this->$$property;
		}
	}
	public function setProperty(){

	}
	/*
	public function init($type, $property, $value){
		$this->$type=$type;
		$this->$properties=$value;
		global $dbConnection;
		if(!isset($dbConnection)){
			$dbConnecton=mysql_connect('localhost', 'sheacme', 'Sac193tbmfigna1506964');
			mysql_select_db('sheacme_database');
		}
		$this->$propertiesCurrent=true;
		$result=mysql_query("SELECT * FROM $type WHERE $property='$value'");
		if(mysql_num_rows($result)>0){
			$this->$properties=mysql_fetch_array($result);
		}else{
			$this->
		}
		
	}
	public function getProperty($property){
		if(!$this->$propertiesCurrent){
			global $dbConnection;
			if(!isset($dbConnection)){
				$dbConnecton=mysql_connect('localhost', 'sheacme', 'Sac193tbmfigna1506964');
				mysql_select_db('sheacme_database');
			}
			$this->$propertiesCurrent=true;
			$this->$properties=mysql_fetch_array(mysql_query("SELECT * FROM $type WHERE $property='$value'"));
		}
		return $this->$properties[$property];
	}
	public function setProperty($property, $value){
		
	}
	*/
}

?>