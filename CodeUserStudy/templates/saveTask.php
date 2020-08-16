<?php
	session_start();
	include("../database/database.class.php");
	include("../templates/sessionHandler.php");

	try{
		$db = new Database();
		$content = json_decode($_POST['Content']);
		//Task 4 richtige - 4 falsche 
		if ($content->TaskType == '1'){
			$db->saveTask1($content->TaskNr,$content->Corr1, $content->Corr2, $content->Corr3,$_SESSION['personID']);
			//überprüfen ob richtige Antwort => in Tabelle correctanswers speichern
			$correctNr = $db->checkCorrectAnswer1($content->TaskNr,$_SESSION['personID']);
			echo $correctNr;
		}
		//Straßenverlauf
		else if ($content->TaskType == '2'){
			$db->saveTask2($content->TaskNr,$content->DefStreet, $_SESSION['personID']);
			//überprüfen ob richtige Antwort => in Tabelle correctanswers speichern
			$correctNr = $db->checkCorrectAnswer2($content->TaskNr,$_SESSION['personID']);
			echo $correctNr;
		}
		//3 Varianten - nur eine auswählen
		else if ($content->TaskType == '3'){
			$db->saveTask3($content->TaskNr,$content->Var1, $content->Var2, $content->Var3, $content->Var4, $_SESSION['personID']);
			//überprüfen ob richtige Antwort => in Tabelle correctanswers speichern
			$correctNr = $db->checkCorrectAnswer3($content->TaskNr,$_SESSION['personID']);
			echo $correctNr;
		}		
		//4 Variante - nur Feedback aus Auswertung speichern
		else if ($content->TaskType == '4'){
			$db->updatePerson($content->Feedback,$_SESSION['personID']);
		}
	}catch(Exception $e){
		echo ' Message: ' .$e->getMessage();
		$db->getDatabaseData()->rollback();
		$db->closeDBConnection();
	}
?>