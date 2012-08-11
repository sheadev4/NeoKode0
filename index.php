<?php

$dbCon;

spl_autoload_register(function($class){
    require_once('includes/' . $class . '.class.php');
});

class object{
	public function exists(){
		global $dbCon;if(empty($dbCon)){$dbCon=mysql_connect('localhost', 'sheacme', 'Sac193tbmfigna1506964');mysql_select_db('sheacme_database');}
		echo "SELECT * FROM ".$this->type." WHERE id='".$this->id."'";
		$result=mysql_query("SELECT * FROM ".$this->type." WHERE id='".$this->id."'");
		if(mysql_num_rows($result)>0){
			return true;
		}else{
			return false;
		}
	}
	public function pull(){
		global $dbCon;if(empty($dbCon)){$dbCon=mysql_connect('localhost', 'sheacme', 'Sac193tbmfigna1506964');mysql_select_db('sheacme_database');}
		$result=mysql_fetch_row(mysql_query("SELECT * FROM ".$this->type." WHERE id='".$this->id."'"));
		foreach($result as $property=>$value){
			$this->$property=$value;
		}
		foreach($this->pending as $property=>$value){
			$this->$property=$value;
		}
	}
	public function push(){
		global $dbCon;if(empty($dbCon)){$dbCon=mysql_connect('localhost', 'sheacme', 'Sac193tbmfigna1506964');mysql_select_db('sheacme_database');}
		$query='UPDATE '.$this->type.' SET';
		if(!empty($this->pending)){
			foreach($this->pending as $property=>$value){
				$query.=" $property='$value'";
			}
		}
		$query.=" WHERE id='".$this->id."'";
		mysql_query($query);
	}
}
class user extends object{
	public $type='user';

}
class page extends object{
	public $type='page';

}

$e=new user();
$e->id='Shea';
echo($e->exists());

?>