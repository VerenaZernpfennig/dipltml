<?php
session_start();
include("database/database.class.php");
include("templates/sessionHandler.php");
include("models/task1.class.php");
include("models/task3.class.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nutzerstudie TML</title>
	<script type="text/javascript" src="js/myJS.js"></script>
	<?php
		if(isset($_GET['action']) && !empty($_GET['action'])){
			switch($_GET['action']){
				case 'logout': 
					logout();			
	 				include("templates/finalpage.php");
					break;
			}
		}
	?>
</head>
<body>
	<div class="container-fluid">
 		<?php
 			if(!isRegistered() && !isset($_GET['action'])){
 				$taskid = '0';
 				include("templates/navigation.php");
 				include("templates/startpage.php");
 			}else{
	 			if(isset($_GET['section']) && !empty($_GET['section'])){
	 				switch ($_GET['section']) {	 
	 					//Tutorials - Task1
	 					case 'form0':
	 						$taskid = $_GET['taskid'];	 			
	 						include("templates/navigation.php");			
	 						include("templates/firstStep1.php");
	 						break;
	 					//Tutorials - Task1 Aufgabe
	 					case 'form0Ex':	
	 						$taskid = $_GET['taskid']; 						
	 						include("templates/navigation.php");
	 						include("templates/firstStep1Ex.php");
	 						break;
	 					//Tutorials - Task2
	 					case 'form00':
	 						$taskid = $_GET['taskid'];	 			
	 						include("templates/navigation.php");			
	 						include("templates/firstStep2.php");
	 						break;
	 					//Tutorials - Task1 Aufgabe
	 					case 'form00Ex':	
	 						$taskid = $_GET['taskid']; 						
	 						include("templates/navigation.php");
	 						include("templates/firstStep2Ex.php");
	 						break;
	 					//Tutorials - Task1
	 					case 'form000':
	 						$taskid = $_GET['taskid'];	 			
	 						include("templates/navigation.php");			
	 						include("templates/firstStep3.php");
	 						break;
	 					//Tutorials - Task1 Aufgabe
	 					case 'form000Ex':	
	 						$taskid = $_GET['taskid']; 						
	 						include("templates/navigation.php");
	 						include("templates/firstStep3Ex.php");
	 						break;
	 					//Name auf Strecke mit/ohne Zoom
	 					case 'form1':
	 						$taskid = $_GET['taskid'];	 			
	 						include("templates/navigation.php");			
	 						include("templates/secondStep1.php");
	 						break;
	 					//Name auf Strecke mit/ohne Zoom 
	 					case 'form1Ex':	
	 						$taskid = $_GET['taskid']; 						
	 						include("templates/navigation.php");
	 						include("templates/secondStep1Ex.php");
	 						break;
	 					//Strecke merken mit/ohne Zoom
	 					case 'form2':
	 						$taskid = $_GET['taskid'];	 			
	 						include("templates/navigation.php");			
	 						include("templates/thirdStep1.php");
	 						break;
	 					//Strecke merken mit/ohne Zoom
	 					case 'form2Ex':	
	 						$taskid = $_GET['taskid']; 						
	 						include("templates/navigation.php");
	 						include("templates/thirdStep1Ex.php");
	 						break;
	 					//Reihenfolge merken mit/ohne Zoom
	 					case 'form3':
	 						$taskid = $_GET['taskid'];	 			
	 						include("templates/navigation.php");			
	 						include("templates/fourthStep1.php");
	 						break;
	 					//Reihenfolge merken mit/ohne Zoom
	 					case 'form3Ex':	
	 						$taskid = $_GET['taskid']; 						
	 						include("templates/navigation.php");
	 						include("templates/fourthStep1Ex.php");
	 						break;
	 					//Abschluss + Auswertung
	 					case 'form4':	
	 						$taskid = $_GET['taskid'];		
	 						include("templates/navigation.php");			
	 						include("templates/endpage.php");
	 						break;	
	 					//Pause
	 					case 'form5':	
	 						$taskid = $_GET['taskid'];			
	 						include("templates/navigation.php");			
	 						include("templates/breakpage.php");
	 						break;	

	 				}
	 			}else if (!isset($_GET['action'])){
	 				$taskid = '0';
	 				include("templates/navigation.php");
	 				include("templates/startpage.php");
	 			}
 			}
 			?>
	</div>
</body>
</html>
