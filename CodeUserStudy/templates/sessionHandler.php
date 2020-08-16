<?php
	function register($age,$gender,$videofreq,$naviusage,$navifreq,$navitype){
		$db=new Database();
		return $db->getPersonID($age,$gender,$videofreq,$naviusage,$navifreq,$navitype);
	}	

	function isRegistered(){
		if(empty($_SESSION['personID'])){
			return false;
		}else{
			return true;
		}
	}

	function logout(){
		session_destroy();
	}
?>