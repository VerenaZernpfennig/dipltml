<?php
	$db = new Database();

	$numcorrAns = $db->getNumCorrectAnswers($_SESSION['personID']);
	$numtask1 = $db->getNumCorrTask1($_SESSION['personID']);
	$numtask2 = $db->getNumCorrTask2($_SESSION['personID']);
	$numtask3 = $db->getNumCorrTask3($_SESSION['personID']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Nutzerstudie TML</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">

    <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
</head>

<body>	
  <!-- start with personal infos -->
  <div class="container center_div">
	<form id="first-page" name="first-page" method='post'>
		<h1 align="center">Gratulation!</h1>
		<div class="alert alert-success" role="alert">		
			<b>Ingesamt richtige Antworten: <?php echo $numcorrAns ?> / 18</b> </br></br>
			Namen auf Strecke erkennen: <?php echo $numtask1 ?> / 6 </br></br>
			Strecke merken: <?php echo $numtask2 ?> / 6 </br></br>
			Reihenfolge merken: <?php echo $numtask3 ?> / 6 </br></br>
			
		
			<div class="form-group">
			    <label for="feedbackText">Bitte hinterlassen Sie noch ein Feedback (max. 250 Zeichen)</label>
			    <textarea class="form-control" id="feedbackText" rows="6" maxlength="250"></textarea>
			</div>
			<h3>Vielen Dank für Ihre Teilnahme! </h3></br>
			Bitte beenden Sie die Nutzerstudie über den Button "Nutzerstudie abschliessen"!
		</div>		
	

		<div class='col-sm-2'></div>
        <div class="error"></div>
        <div class='col-sm-2'></div> 
		<button type="button" class="btn btn-primary" name="register" id ="register" onClick="closeApp()">Nutzerstudie abschließen</button>
	</form>
  </div>
</body>

</html>
