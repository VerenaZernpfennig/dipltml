<?php
	session_start();
	include("../database/database.class.php");
	include("../templates/sessionHandler.php");

	try{
		$db = new Database();
		$content = json_decode($_POST['Content']);
		$id = register($content->Age,$content->Gender,$content->Videofreq,$content->Naviusage,$content->Navifreq,$content->Navitype);
		
		$_SESSION['personID'] = $id;
		$_SESSION['taskID'] = 1;
	}catch(Exception $e){
		echo ' Message: ' .$e->getMessage();
		$db->getDatabaseData()->rollback();
		$db->closeDBConnection();
	}
?>