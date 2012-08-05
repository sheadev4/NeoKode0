<?php

$dbConnection;
$requestURI = $_SERVER['REQUEST_URI'];
if(strpos('?', $requestURI)){
	$requestURI=explode('?', $requestURI, 2);
	$requestPath=$requestURI[0];
	if(preg_match('/^[a-zA-Z0-9_-]{1,20}$/', $requestPath)===0){
		header('Location: http://sheac.me/errors/malformed-query');
	}
	$queryString=explode('&', $requestURI[1]);
	$supportedActions=array('view');
	if(in_array($queryString[0], $supportedActions)){
		require_once('actions/'.$queryString[0].'.php');
		$action=$queryString[0];
	}else{
		require_once('actions/view.php');
		$action='view';
	}
}else{
	$requestPath=$requestURI;
	if(preg_match('/^[a-zA-Z0-9_\/-]{0,20}$/', $requestURI)===0){
		header('Location: http://sheac.me/errors/malformed-query');
	}
	require_once('actions/view.php');
	$action='view';
}

function dbQuery($query, $maxCacheAge){
	if(file_exists('cache/dbQueries/'.$query) && ( (time()-filemtime('cache/dbQueries/'.$query)) < $maxCacheAge)){
		return unserialize(file_get_contents('cache/dbQueries/'.$query));
	}else{
		global $dbConnection;
		if(!isset($dbConnection)){
			$dbConnection=mysql_connect("localhost","sheacme",$password);
			mysql_select_db("sheacme_neocodephp", $dbConnection);
		}
		if(!$dbConnection){
			header('Location: http://sheac.me/errors/database');
		}
		$result=mysql_query($query);
		file_put_contents('cache/dbQueries/'.$query, serialize($result));
		return $result;
	}
}

?>